<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'meta_desc',
        'slug',
        'content',
        'image',
        'status',
        'price',
        'stock', // Tambahkan stok ke dalam fillable
        'sku'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi Many-to-One dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many-to-One dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // app/Models/Product.php
public function getFinalPriceAttribute()
{
    if ($this->discount > 0) {
        return $this->price - ($this->price * $this->discount / 100);
    }
    return $this->price;
}

// Relasi One-to-Many dengan Cart
public function carts()
{
    return $this->hasMany(Cart::class);
}
public function getDiscountPercentAttribute()
{
    if ($this->old_price > 0) {
        return round((($this->old_price - $this->price) / $this->old_price) * 100);
    }
    return 0;
}
}