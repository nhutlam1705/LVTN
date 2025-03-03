<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserProfileController extends Controller
{
    public function showProfile()
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();
    
        // Lấy tất cả đơn hàng của người dùng đó
        $orders = Order::where('user_id', $user->id)->orderBy('id', 'desc')->get();
    
        return view('user.profile', compact('user', 'orders'));
    }
}
