<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     // Hiển thị form đăng ký
     public function showRegisterForm()
     {
         return view('pages.Login.Register');
     }
 
     // Xử lý đăng ký
     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8|confirmed',
         ]);
 
         User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'role' => 0,
             'account_id' => '5',
         ]);
 
         return redirect()->route('login')->with('success', 'Tài khoản đã được tạo. Vui lòng đăng nhập.');
     }
 
     // Hiển thị form đăng nhập
     public function showLoginForm()
     {
         return view('pages.Login.Login');
     }
 
     // Xử lý đăng nhập
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
 
         if (Auth::attempt($request->only('email', 'password'))) {
             return redirect()->route('home');
         }
 
         return back()->with('error', 'Email hoặc mật khẩu không đúng.');
     }
 
     // Xử lý đăng xuất
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->forget('cart');
         return redirect()->route('login')->with('success', 'Đã đăng xuất.');
     }
}
