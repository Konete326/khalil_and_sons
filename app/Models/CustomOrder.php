<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'original_image_path',
        'model_3d_url',
        'karat',
        'target_weight_grams',
        'estimated_budget',
        'provides_own_gold',
        'customer_gold_weight',
        'design_token_paid',
        'payment_status',
        'manufacturing_status',
        'payment_slip_path',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'target_weight_grams' => 'decimal:3',
            'estimated_budget' => 'decimal:2',
            'provides_own_gold' => 'boolean',
            'customer_gold_weight' => 'decimal:3',
            'design_token_paid' => 'decimal:2',
        ];
    }

    public function getSlipUrlAttribute(): ?string
    {
        return $this->payment_slip_path;
    }
}
