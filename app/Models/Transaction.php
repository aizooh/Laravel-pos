<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $fillable = [
        'reference',
        'attendant_id',
        'payment_method',
        'mpesa_phone',
        'mpesa_ref',
        'checkout_request_id',
        'total',
        'profit',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total'  => 'decimal:2',
            'profit' => 'decimal:2',
        ];
    }

    /* ── Relationships ── */

    public function attendant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'attendant_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function mpesaCallback(): HasOne
    {
        return $this->hasOne(MpesaCallback::class);
    }

    /* ── Scopes ── */

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                     ->whereYear('created_at',  now()->year);
    }

    /* ── Helpers ── */

    /**
     * Generate a unique transaction reference e.g. TXN-20250610-0042
     */
    public static function generateReference(): string
    {
        $date     = now()->format('Ymd');
        $count    = static::whereDate('created_at', today())->count() + 1;
        return 'TXN-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
