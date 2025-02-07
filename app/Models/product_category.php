<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    use HasFactory;
    protected $table = 'product_category';
    protected $fillable = [
        'product_id',
        'category_id',
    ];
    public $timestamps = false;
}
