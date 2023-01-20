<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Store extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;

    public function seller()
    {
        return $this->hasOne(User::class,'id','store_seller');
    }
}
