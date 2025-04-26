<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'stock',
        'price'
    ];

    // Relación con el producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con la talla
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    // Relación con el color
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
