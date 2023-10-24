<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsExtra extends Model
{
    protected $table = 'products_extras';
    use HasFactory;
    protected $fillable = [
        'name', 'lazada', 'shopee',
    ];
}
