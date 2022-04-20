<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function customerOrder()
    {
        return $this->belongsTo(CustomerOrder::class,'customer_orders_id','id');
    }
}
