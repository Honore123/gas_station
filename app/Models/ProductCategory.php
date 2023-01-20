<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;
    protected $fillable = ['category_name'];
    protected static $logUnguarded = true;
}
