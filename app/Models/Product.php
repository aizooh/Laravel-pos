<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'buying_price',
        'selling_price',
        'quantity',
        'low_stock_threshold',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'buying_price'        => 'decimal:2',
            'selling_price'       => 'decimal:2',
            'is_active'           => 'boolean',
            'quantity'            => 'integer',
            'low_stock_threshold' => 'integer',
        ];
    }

    /* ── Relationships ── */

    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class, 'item_id')
                    ->where('item_type', 'product');
    }

    /* ── Accessors ── */

    /**
     * Profit per unit (selling - buying).
     */
    public function getProfitPerUnitAttribute(): float
    {
        return (float) $this->selling_price - (float) $this->buying_price;
    }

    /**
     * Profit margin as a percentage.
     */
    public function getMarginPercentAttribute(): int
    {
        if ($this->buying_price <= 0) return 0;
        return (int) round(($this->profit_per_unit / $this->buying_price) * 100);
    }

    /**
     * Whether this item is low on stock.
     */
    public function getIsLowStockAttribute(): bool
    {
        return $this->quantity <= $this->low_stock_threshold;
    }

    /* ── Scopes ── */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query)
    {
        return $query->whereRaw('quantity <= low_stock_threshold');
    }
}
