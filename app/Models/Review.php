<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'name_reviewer',
        'email_review',
        'evaluate',
        'comments',
        'review_at',
    ];
    public $timestamps = false;
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }
}
