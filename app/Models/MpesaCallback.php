<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MpesaCallback extends Model
{
    protected $fillable = [
        'transaction_id',
        'checkout_request_id',
        'merchant_request_id',
        'result_code',
        'result_desc',
        'mpesa_receipt',
        'phone',
        'amount',
        'raw_payload',
    ];

    protected function casts(): array
    {
        return [
            'raw_payload' => 'array',
            'amount'      => 'decimal:2',
            'result_code' => 'integer',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function isSuccessful(): bool
    {
        return $this->result_code === 0;
    }
}
