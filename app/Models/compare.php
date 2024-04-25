<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $table = 'compare';

    use HasFactory;

    protected $fillable = [
        'laptop_id', // Add 'product_id' to this array
        'compared_laptop_id',
    ];
    
    public function laptop()
    {
        return $this->belongsTo(laptop::class, 'laptop_id');
    }

    public function comparedLaptop()
    {
        return $this->belongsTo(laptop::class, 'compared_laptop_id');
    }

    public function laptops()
    {
        return $this->belongsToMany(Laptop::class, 'compare_laptop', 'compare_id', 'laptop_id');
    }

}