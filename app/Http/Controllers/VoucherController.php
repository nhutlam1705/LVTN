<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class VoucherController extends Controller
{
    public function create()
    {
        return view('admin.VoucherManager.CreateVoucher');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code',
            'value' => 'required|numeric|min:0',
            'type' => 'required|in:percent,fixed',
            'start_date' => 'required|date',
            'description_voucher'=> 'required|string',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'required|integer|min:1',
        ]);

        Voucher::create($request->all());

        return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully');
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.VoucherManager.EditVoucher', compact('voucher'));
    }
    
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:discounts,code,' . $voucher->id,
            'value' => 'required|numeric|min:0',
            'type' => 'required|in:percent,fixed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $voucher->update($request->all());
        return redirect()->route('admin.VoucherManager.ShowVoucher')->with('success', 'Voucher được cập nhật thành công!');
    }
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.VoucherManager.ShowVoucher', compact('vouchers'));
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher đã bị xóa!');
    }
}
