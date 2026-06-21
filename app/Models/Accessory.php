<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'sku',
    ];

    // Optional: auto-decrement stock when sold (we'll handle in sale logic)
    // For now, just a helper method
    public function hasStock($quantity = 1)
    {
        return $this->stock_quantity >= $quantity;
    }

    public function decrementStock($quantity = 1)
    {
        $this->decrement('stock_quantity', $quantity);
    }

    public function incrementStock($quantity = 1)
    {
        $this->increment('stock_quantity', $quantity);
    }
}