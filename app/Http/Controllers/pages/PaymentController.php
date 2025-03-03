<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function showCart()
    {
        $cartItems = session()->get('cart', []);
        return view('cart', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        return redirect()->route('payment.info');
    }

    public function showPaymentInfo()
    {
        // Lấy thông tin người dùng và đơn hàng
        $userInfo = Auth::user();
        $cartItems = session()->get('cart', []);
        $total = 0;
        foreach ($cartItems as $item) {
            if ($item['sale'] > 0) {
                $total += ($item['saleprice'] - ($item['saleprice'] * $item['sale'] / 100)) * $item['quantity'];
            } else {
                $total += $item['saleprice'] * $item['quantity'];
            }
        }
        return view('pages.Payment.Payment', compact('userInfo', 'cartItems','total'));
    }
    
    public function StripePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $cartItems = session()->get('cart', []);
        
        try {
            // Đảm bảo các khóa của mảng line_items là liên tiếp
            $lineItems = array_map(function ($item) {
                return [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['name'],
                            // 'image' => $item['image'],
                        ],
                        'unit_amount' => (int) round($item['saleprice'] / 25.16496 * 100),
                    ],
                    'quantity' => $item['quantity'],
                ];
            }, $cartItems);
    
            // Sử dụng array_values() để đảm bảo các khóa là liên tiếp
            $lineItems = array_values($lineItems);
    
            // Tạo phiên thanh toán với Stripe
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ]);
    
            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function VNPayPayment(Request $request)
    {
        $cartItems = session()->get('cart', []);

        // Tính tổng tiền hàng
        $totalAmount = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['saleprice'] * $item['quantity']); // Nhân giá với số lượng
        }, 0);

        // Định nghĩa các tham số cho VNPay
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay/success";
        $vnp_TmnCode = "W8M8IH03";
        $vnp_HashSecret = "THTEWUVD70E5CQ6Z1DYJXNYHALX4CXGC";
        
        $vnp_TxnRef = Str::random(8); 
        $vnp_OrderInfo ='Thanh toán hóa đơn VNPay';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount =  $totalAmount * 100;
        $vnp_Locale ='vn';
        $vnp_BankCode ='NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }

    public function vnpaySuccess(Request $request)
    {
        // Log::info('VNPay Callback:', $request->all()); 
        // ĐÁNH DẤU - PHẦN SỬA: Lấy thông tin chữ ký bảo mật từ VNPay
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET'); // Khóa bí mật từ môi trường

        // Loại bỏ các trường không cần thiết và sắp xếp theo thứ tự từ điển
        $inputData = $request->except('vnp_SecureHash', 'vnp_SecureHashType');
        ksort($inputData); // Sắp xếp dữ liệu theo thứ tự từ điển

        // Tạo chữ ký từ dữ liệu trả về
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            // ĐÁNH DẤU - PHẦN SỬA: Kiểm tra trạng thái thanh toán
            if ($request->get('vnp_ResponseCode') === '00') {
                // Lưu thông tin thanh toán vào cơ sở dữ liệu
                $cartItems = session()->get('cart', []);
                $userInfo = Auth::user();
                $totalAmount = array_reduce($cartItems, function ($carry, $item) {
                    return $carry + ($item['saleprice'] * $item['quantity']);
                }, 0);
                $totalOriginal = array_reduce($cartItems, function ($carry, $item) {
                    return $carry + ($item['price'] * $item['quantity']); 
                }, 0);

                // Tạo đơn hàng
                // DB::transaction(function () use ($userInfo, $cartItems, $totalAmount) {
                //     $order = new Order();
                //     $order->name = $userInfo->name;
                //     $order->email = $userInfo->email;
                //     $order->address = $userInfo->address;
                //     $order->phone = $userInfo->phone;
                //     $order->total_amount = $totalAmount;
                //     $order->payment_method = 'VNPay';
                //     $order->status = 'Đã thanh toán';
                //     $order->save();

                //     foreach ($cartItems as $item) {
                //         DB::table('order_details')->insert([
                //             'order_id' => $order->id,
                //             'product_id' => $item['product_id'],
                //             'quantity' => $item['quantity'],
                //             'price' => $item['price'],
                //             'created_at' => now(),
                //             'updated_at' => now(),
                //         ]);
                //     }
                // });

                foreach ($cartItems as $item) {
                    $order = new Order();
                    $order->name = $userInfo->name;
                    $order->email = $userInfo->email;
                    $order->address = $userInfo->address;
                    $order->phone = $userInfo->phone;
                    $order->total_amount = $totalAmount;
                    $order->total_original = $totalOriginal;
                    $order->product_id = $item['product_id'];
                    $order->product_quantity = $item['quantity'];
                    $order->payment_method = 'VNPay';
                    $order->status = 'Đã thanh toán';
                    $order->check = 'new';
                    $order->save();
                }
                Session::forget('cart');
                Session::flash('success', 'Thanh toán thành công!'); // Hiển thị thông báo thành công
                return redirect()->route('cart.show'); // Chuyển hướng đến trang giỏ hàng
            } else {
                return back()->withErrors(['error' => 'Thanh toán không thành công!']);
            }
        } else {
            return back()->withErrors(['error' => 'Lỗi xác thực chữ ký!']);
        }
    }
    // ĐÁNH DẤU - PHẦN SỬA: Xử lý chữ ký bảo mật
    // $vnp_SecureHash = $request->get('vnp_SecureHash');
    // $vnp_HashSecret = env('VNPAY_HASH_SECRET'); // Lấy khóa bí mật từ biến môi trường

    // // Loại bỏ các trường không cần thiết và sắp xếp theo thứ tự từ điển
    // $inputData = $request->except('vnp_SecureHash', 'vnp_SecureHashType');
    // ksort($inputData);

    // // Xây dựng chuỗi để tạo chữ ký
    // $hashData = urldecode(http_build_query($inputData));
    // $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        
    // $userInfo = Auth::user();
    // $cartItems = session()->get('cart', []);
    // $totalAmount = array_reduce($cartItems, function ($carry, $item) {
    //     return $carry + ($item['price'] * $item['quantity']); // Nhân giá với số lượng
    // }, 0);
    // $totalOriginal = array_reduce($cartItems, function ($carry, $item) {
    //     return $carry + ($item['price'] * $item['quantity']); 
    // }, 0);
    // if ($secureHash === $vnp_SecureHash) {
    //     foreach ($cartItems as $item) {
    //         $order = new Order();
    //         $order->name = $userInfo->name;
    //         $order->email = $userInfo->email;
    //         $order->address = $userInfo->address;
    //         $order->phone = $userInfo->phone;
    //         $order->total_amount = $totalAmount;
    //         $order->total_original = $totalOriginal;
    //         $order->product_id = $item['product_id'];
    //         $order->product_quantity = $item['quantity'];
    //         $order->payment_method = 'VNPay';
    //         $order->status = 'Đã thanh toán';
    //         $order->check = 'new';
    //         $order->save();
    //     }
    //     Session::forget('cart');
    //     Session::flash('success', 'Thanh toán thành công!'); // Hiển thị thông báo thành công
    //     return redirect()->route('cart.show'); // Chuyển hướng đến trang giỏ hàng
    // } else {
    //     return back()->withErrors(['error' => 'Thanh toán không thành công!']); // Thông báo lỗi nếu chữ ký không khớp
    // }
    // }


    public function CodPayment(Request $request)
    {
        $userInfo = Auth::user();
        $cartItems = session()->get('cart', []);

        // Tính tổng tiền hàng
        $totalAmount = array_reduce($cartItems, function ($carry, $item) {
            if ($item['sale'] > 0) {
                return $carry + (($item['saleprice'] - ($item['saleprice'] * $item['sale'] / 100))* $item['quantity']);
            } else {
                return $carry + ($item['saleprice'] * $item['quantity']);
            }
        }, 0);
        $totalOriginal = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']); 
        }, 0);

        $discount = session('discount', 0);
        $total = session('cart_total', 0);
   
        DB::transaction(function () use ($userInfo, $cartItems, $totalAmount, $totalOriginal, $discount) {
            // Tạo bản ghi trong bảng `orders`
            $order = new Order();
            $order->name = $userInfo->name;
            $order->email = $userInfo->email;
            $order->address = $userInfo->address;
            $order->phone = $userInfo->phone;
            $order->total_amount = $totalAmount - $discount;
            $order->total_original = $totalOriginal;
            $order->payment_method = 'Thanh toán khi nhận hàng';
            $order->status = 'Chưa thanh toán';
            $order->check = 'new';
            $order->save();
            // Tạo bản ghi chi tiết sản phẩm trong bảng `order_details`
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['saleprice'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                // Cập nhật số lượng sản phẩm trong bảng `products`
                $product = DB::table('products')->where('id', $item['product_id'])->first();
                if ($product) {
                    $newStock = $product->quantity - $item['quantity'];
                    if ($newStock < 0) {
                        throw new \Exception("Số lượng sản phẩm không đủ trong kho: {$product->name}");
                    }
                    DB::table('products')->where('id', $item['product_id'])->update(['quantity' => $newStock]);
                }
            }
        });
        Session::forget('cart');
        Session::forget('discount');
        Session::forget('cart_total');
        return redirect()->route('payment.success');
    }

    public function paymentSuccess()
    {
        $userInfo = Auth::user();
        $cartItems = Session::get('cart', []);
        // dd($cartItems);

        // Tính tổng tiền hàng
        $totalAmount = array_reduce($cartItems, function ($carry, $item) {
            if ($item['sale'] > 0) {
                return $carry + (($item['saleprice'] - ($item['saleprice'] * $item['sale'] / 100))* $item['quantity']);
            } else {
                return $carry + ($item['saleprice'] * $item['quantity']);
            }
        }, 0);
        $totalOriginal = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']); 
        }, 0);

        $discount = session('discount', 0);
        $total = session('cart_total', 0);
        DB::transaction(function () use ($userInfo, $cartItems, $totalAmount, $totalOriginal, $discount ) {
            // Tạo bản ghi trong bảng `orders`
            $order = new Order();
            $order->name = $userInfo->name;
            $order->email = $userInfo->email;
            $order->address = $userInfo->address;
            $order->phone = $userInfo->phone;
            $order->total_amount = $totalAmount - $discount ;
            $order->total_original = $totalOriginal;
            $order->payment_method = 'Stripe';
            $order->status = 'Đã thanh toán';
            $order->check = 'new';
            $order->save();
            // Tạo bản ghi chi tiết sản phẩm trong bảng `order_details`
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['saleprice'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                // Cập nhật số lượng sản phẩm trong bảng `products`
                $product = DB::table('products')->where('id', $item['product_id'])->first();
                if ($product) {
                    $newStock = $product->quantity - $item['quantity'];
                    if ($newStock < 0) {
                        throw new \Exception("Số lượng sản phẩm không đủ trong kho: {$product->name}");
                    }
                    DB::table('products')->where('id', $item['product_id'])->update(['quantity' => $newStock]);
                }
            }
        });
        Session::forget('cart');
        Session::forget('discount');
        Session::forget('cart_total');
        Session::flash('success', 'Thanh toán thành công!');
        return view('pages.Checkout.CheckoutSusscess'); 
    }

    public function paymentCancel()
    {
        return redirect()->route('cart.show')->withErrors(['error' => 'Thanh toán đã bị hủy.']);
    }

}
