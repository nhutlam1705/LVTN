<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // $accounts = Account::all();
        return view('admin.AccountManager.ShowAccount', compact('users'));
    }

    // Hiển thị form tạo tài khoản user mới
    public function create()
    {
        $accounts = Account::all();
        return view('admin.AccountManager.CreateAccount',compact('accounts'));
    }

    // Lưu user mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|boolean',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'account' => 'nullable|exists:accounts,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo mới user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->account_id = $request->input('account');

        // Lưu ảnh nếu có
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        // Mã hóa mật khẩu và lưu user
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('AccountManager.ShowAccount')->with('success', 'Tài khoản đã được tạo thành công');
    }

    // Hiển thị form chỉnh sửa tài khoản user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $accounts = Account::all();
        return view('admin.AccountManager.EditAccount', compact('user','accounts'));
    }

    // Cập nhật tài khoản user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable',
            'email' => 'nullable|email',
            'password' => 'nullable|min:8',
            'account_id' => 'nullable|exists:accounts,id', 
            'address' => 'nullable',
            'phone' => 'nullable',
            'role' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = User::findOrFail($id);
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path('images/' . $user->image))) {
                unlink(public_path('images/' . $user->image));
            }
    
            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->account_id = $request->account_id;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role = $request->input('role'); 
    
        $user->save();
    
        return redirect()->route('AccountManager.ShowAccount')->with('success', 'Cập nhật người dùng thành công.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('AccountManager.ShowAccount')->with('success', 'Tài khoản đã được xóa thành công');
    }
}
