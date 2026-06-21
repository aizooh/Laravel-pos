<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionItem extends Model
{
    protected $fillable = [
        'transaction_id',
        'item_type',
        'item_id',
        'item_name',
        'quantity',
        'unit_price',
        'buying_price',
        'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'unit_price'   => 'decimal:2',
            'buying_price' => 'decimal:2',
            'subtotal'     => 'decimal:2',
            'quantity'     => 'integer',
        ];
    }

    /* ── Relationships ── */

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /* ── Accessors ── */

    public function getProfitAttribute(): float
    {
        return ((float) $this->unit_price - (float) $this->buying_price) * $this->quantity;
    }
}
