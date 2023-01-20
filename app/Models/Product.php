<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;

    protected $fillable = [
        'product_name',
        'category_id',
        'material_id',
        'barcode',
        'quantity',
        'unit',
        'retail_price',
        'purchase_price',
        'vendor_id',
        'images',
        'description',
    ];
    protected $casts = [
        'images' => 'array'
    ];
    protected static $logUnguarded = true;

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }
    public function material()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }
}
