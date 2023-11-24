<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'brand_id',
        'img_thumbnail',
        'describe',
    ];
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
