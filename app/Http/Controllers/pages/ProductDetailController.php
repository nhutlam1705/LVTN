<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductDetailcontroller extends Controller
{
    
    public function index(Request $request) {
        $categories = Category::all(); // Lấy danh mục
        $productsQuery = Product::query(); // Tạo query cơ bản để lấy sản phẩm
        
        if ($request->has('keyword') && $request->keyword != null) {
            $productsQuery->where('name_product', 'LIKE', '%' . $request->keyword . '%');
        }
        // Lọc sản phẩm theo danh mục nếu có yêu cầu
        if ($request->has('category_id') && $request->category_id != null) {
            $productsQuery->where('category_id', $request->category_id);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $productsQuery->whereBetween('price', [$request->min_price, $request->max_price]);
        } elseif ($request->has('min_price')) {
            $productsQuery->where('saleprice', '>=', $request->min_price);
        }
    
        $products = $productsQuery->paginate(12); // Phân trang sản phẩm
        return view('pages.Products.Product',compact('products','categories')); 
    }

    public function show($id)
    {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($id);

        // Trả về view với dữ liệu sản phẩm
        return view('pages.Products.ProductDetail', compact('product'));
    }
    
}
