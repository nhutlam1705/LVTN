<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show list of products
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.ProductManager.ShowProduct', compact('products'));
    }

    // Show form to create a product
    public function create()
    {
        $categories = Category::all(); // Fetch existing categories
        return view('admin.ProductManager.CreateProduct', compact('categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'nullable|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'saleprice' => 'required|numeric',
            'sale' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'image_product' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
    
        $data = $request->only(['name_product', 'description_product','quantity', 'price', 'saleprice', 'sale', 'category_id']);
         // Xử lý file hình ảnh
         if ($request->hasFile('image_product')) {
            $image = $request->file('image_product');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); 
            $data['image_product'] = $imageName; 
        } else {
            $data['image_product'] = null;
        }
        Product::create($data);
    
        return redirect()->route('ProductManager.ShowProduct')->with('success', 'Sản phẩm đã được thêm thành công');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create($validated);

        return redirect()->route('ProductManager.CreateProduct')->with('success', 'Danh mục đã được thêm thành công');
    }

    // Show form to edit a product
    public function edit(Product $product, $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.ProductManager.EditProduct', compact('product', 'categories'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_product' => 'nullable|string|max:255',
            'description_product' => 'nullable|string',
            'quantity' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'saleprice' => 'nullable|numeric',
            'sale' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image_product' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product = Product::findOrFail($id);

        $data = $request->only(['name_product', 'description_product','quantity', 'price', 'saleprice', 'sale', 'category_id']);

        if ($request->hasFile('image_product')) {
            $image = $request->file('image_product');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image_product'] = $imageName;
        } else {
            $data['image_product'] = $product->image_product;
        }

        $product->update($data);

        return redirect()->route('ProductManager.ShowProduct')->with('success', 'Sản phẩm đã được cập nhật thành công');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('ProductManager.ShowProduct')->with('success', 'Product deleted successfully!');
    }
}
