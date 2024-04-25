<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','price','brand','cpu','chipset','gpu','memory','battery',
        'display_type','display_size',
        'body_dimension','body_weight','body_type',
        'rear_camera','front_camera','video','camera_features','image'
    ];
}
