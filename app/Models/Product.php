<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'image_product',
        'prd_desc',
        'cat_id',
        'author_id',
        'sale',
    ];
    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function order_detail()
    {
        return $this->belongsTo(OrderDetail::class, 'prd_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'product_author', 'product_id', 'author_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
