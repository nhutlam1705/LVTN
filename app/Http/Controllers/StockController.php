<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::all();
        $stock = StockMovement::orderBy('created_at', 'desc') // Sắp xếp theo thời gian mới nhất
        ->get()
        ->groupBy('product_id')
        ->map(function ($group) {
            return $group->first(); // Lấy bản ghi mới nhất
        });
        return view('admin.StockManager.Stock', compact('products','stock'));
    }

    // Nhập kho
    public function storeIn(Request $request, $id)
    {
        $request->validate([
            'quantity_stock' => 'required|integer|min:1',
            'price_stock' => 'required|integer|min:1',
            'saleprice_stock' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        // Lưu lịch sử nhập kho
        StockMovement::create([
            'product_id' => $product->id,
            'type' => 'in',
            'quantity_stock' => $request->quantity_stock,
            'price_stock' => $request->price_stock,
            'saleprice_stock' => $request->saleprice_stock,
        ]);

        return back()->with('success', 'Nhập kho thành công!');
    }

    // Xuất kho
    public function storeOut(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $movement = StockMovement::where('product_id', $id)
            ->where('type', 'in') // Chỉ lấy bản ghi nhập kho
            ->latest()
            ->first();

        if (!$movement) {
            return back()->withErrors('Không tìm thấy dữ liệu nhập kho cho sản phẩm này.');
        }
        $request->validate([
            'quantity_stock' => 'required|integer|min:1|max:' . $movement->quantity_stock,
        ]);
       
        $product->quantity += $request->quantity_stock;
        $product->price = $movement->price_stock;
        $product->saleprice = $movement->saleprice_stock;
        $product->save();

        $movement->quantity_stock -=$request->quantity_stock;
        $movement->save();

        // Lưu lịch sử xuất kho
        StockMovement::create([
            'product_id' => $product->id,
            'type' => 'out',
            'quantity_stock' => $request->quantity_stock,
            'price_stock' => $movement->price_stock,
            'saleprice_stock' => $movement->saleprice_stock,
        ]);

        return back()->with('success', 'Xuất kho thành công!');
    }
}
