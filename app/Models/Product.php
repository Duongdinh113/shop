<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const STATUS_YES = 'có';
    const STATUS_NO  = 'không';

    protected $fillable = [
        'thumbnail',
        'name',
        'price',
        'status',
        'created'
    ];
}
