<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_product',
        'image_product',
        'description_product',
        'quantity',
        'price',
        'saleprice',
        'sale',
        'category_id'
    ];

    // Define the inverse of the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
