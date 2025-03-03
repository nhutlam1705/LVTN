<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Voucher;
class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'name' => $product->name_product,
                'quantity' => 1,
                'saleprice' => $product->saleprice,
                'sale' => $product->sale,
                'image' => $product->image_product,
                'price' => $product->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function showCart(Request $request)
    {
        $cart = session()->get('cart', []);
        // dd($cart);

        // Kiểm tra nếu có dữ liệu được gửi để cập nhật số lượng
        if ($request->has('id') && $request->has('quantity')) {
            $id = $request->input('id');
            $quantity = $request->input('quantity');

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;

                // Đảm bảo số lượng không nhỏ hơn 1
                if ($cart[$id]['quantity'] < 1) {
                    $cart[$id]['quantity'] = 1;
                }

                // Cập nhật lại session giỏ hàng
                session()->put('cart', $cart);

                // Tính lại tổng tiền ngay khi thay đổi số lượng
                return response()->json([
                    'status' => 'success',
                    'cart' => $cart,
                    'total' => $this->calculateTotal($cart),
                    'original' => $this->calculateOriginal($cart)
                ]);
            }
        }

        // Tính tổng tiền nếu không thay đổi số lượng
        $total = $this->calculateTotal($cart);
        $original = $this->calculateOriginal($cart);

    return view('pages.Cart.Cart', compact('cart', 'total', 'original'));
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            if ($item['sale'] > 0) {
                $total += ($item['saleprice'] - ($item['saleprice'] * $item['sale'] / 100)) * $item['quantity'];
            } else {
                $total += $item['saleprice'] * $item['quantity'];
            }
        }
        return $total;
    }

    private function calculateOriginal($cart)
    {
        $original = 0;
        foreach ($cart as $item) {
            $original += $item['price'] * $item['quantity'];
        }
        return $original;
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm có trong giỏ hàng không
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }

        public function checkout(Request $request)
    {
        $cartItems = session()->get('cart'); // Lấy thông tin giỏ hàng từ session
        return view('pages/Payment/Payment', compact('cartItems'));
    }

    public function applyVoucher(Request $request)
        {   
            $request->validate([
                'voucher_code' => 'required|string|exists:vouchers,code',
            ]);

            $voucher = Voucher::where('code', $request->voucher_code)->first();

            if (!$voucher || !$voucher->isValid()) {
                return back()->withErrors(['voucher_code' => 'Voucher không hợp lệ hoặc đã hết hạn.']);
            }

            // Lấy giỏ hàng từ session
            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return back()->withErrors(['voucher_code' => 'Giỏ hàng của bạn đang trống.']);
            }

            // Tính tổng tiền trước khi áp dụng voucher
            $totalBeforeDiscount = $this->calculateTotal($cart);

            // Tính giảm giá
            $discount = $voucher->type === 'percent'
                ? ($totalBeforeDiscount * $voucher->value / 100)
                : $voucher->value;

            // Tổng tiền sau khi áp dụng giảm giá
            $totalAfterDiscount = max(0, $totalBeforeDiscount - $discount);

            // Cập nhật lại session
            session()->put('cart_total', $totalAfterDiscount);
            session()->put('discount', $discount);

            // Giảm số lần sử dụng của voucher
            $voucher->decrement('usage_limit');

            return redirect()->back()->with('success', "Áp dụng voucher thành công! Giảm giá: " . number_format($discount) . " VND.");
        }
}