<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardTapped extends Model
{
    use HasFactory;
    protected $table = 'card_tap';
    protected $guarded = [];
}
