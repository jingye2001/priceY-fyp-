<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laptop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'image', 'price','manufacturer','process_model','graphics',
        'display_technology','screen_size','screen_resolution','memory','storage',
        'operating_system','connectivity','camera','ports','battery','dimension','weight','type',
        'shopee','lazada'
    ];

    public function comparisons()
{
    return $this->belongsToMany(Compare::class, 'compare_laptop', 'laptop_id', 'compare_id');
}

}
