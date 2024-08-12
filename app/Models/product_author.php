<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_author extends Model
{
    use HasFactory;
    protected $table = 'product_author';
    protected $fillable = [
        'product_id',
        'auhtor_id',
    ];
    public $timestamps = false;
}
