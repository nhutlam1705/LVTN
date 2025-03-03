<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\Category;
use App\Models\Information;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    
    public function index() {
        $information = Information::Where('type','Giới thiệu')->orderBy('created_at', 'desc')->take(1)->get();
        $products = Product::all();
        $categories = Category::all();
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['saleprice'] * $item['quantity'];
        }
       $vouchers = Voucher::orderBy('id', 'desc')->take(3)->get();
        $informations = Information::Where('type','Tin tức')->orderBy('created_at', 'desc')->take(3)->get();
       
        return view('pages.home',compact('information','products','cart','total','vouchers','informations','categories')); 
    }

    public function categoryProduct(Request $request) {
        $productsQuery = Product::query();
        if ($request->has('category_id') && $request->category_id != null) {
            $productsQuery->where('category_id', $request->category_id);
        }
        return view('pages.Products.Product',compact('products','categories')); 
    }
}
