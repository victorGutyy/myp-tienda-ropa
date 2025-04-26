<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'quantity', 'category'];
    // Relación: Un producto tiene muchas variantes
    public function variants()
    {
        return $this->hasMany(\App\Models\ProductVariant::class);
    }
}


