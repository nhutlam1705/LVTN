<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class OrderController extends Controller
{
    // public function showOrder($id)
    // {
    //     // Lấy đơn hàng theo ID
    //     $order = Order::findOrFail($id);
    //     $orders = Order::with('product_id')->get();

    //     // Kiểm tra quyền truy cập (nếu cần)
    //     // if ($order->user_id !== Auth::id()) {
    //     //     return redirect()->route('home')->withErrors('Bạn không có quyền truy cập đơn hàng này.');
    //     // }

    //     return view('pages.Order.ShowOrder', compact('order','orders'));
    // }
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        // $orders = Order::with('product')->get();
        $order = OrderItem::with('product')->get();
        return view('admin.OrderManager.ShowOrder', compact('orders','order'));
    }

    public function update($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'Đã thanh toán',
        ]);
        return redirect()->route('orders.show')->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }
    public function updatecheck($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'check' => '',
        ]);
        return redirect()->route('orders.show')->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }


    public function index2()
    {
        // Lấy tất cả đơn hàng của người dùng đã đăng nhập
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('pages.Order.ShowOrder', compact('orders'));
    }

    public function showOrderDetail($orderId)
    {
        // Lấy chi tiết đơn hàng và các sản phẩm liên quan
        $order = Order::with('orderItems.product')->where('id', $orderId)->first();

        if (!$order) {
            return redirect()->route('pages.Order.ShowOrder')->with('error', 'Đơn hàng không tồn tại');
        }

        return view('pages.Order.ShowOrder', compact('order', 'orders')); // Trả lại cả đơn hàng chi tiết và danh sách đơn hàng
    }
    
}
