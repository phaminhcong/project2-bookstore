<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'receiveName',
        'receivePhoneNumber',
        'receiveEmail',
        'receiveAddress',
        'orderNote',
        'created_at',
        'update_at',
        'total_product_value',
        'cust_id',
        'order_status',
    ];
    public $timestamps = false;
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
