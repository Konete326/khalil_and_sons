<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'karat',
        'gross_weight_grams',
        'net_gold_weight_grams',
        'making_charges',
        'gemstone_cost',
        'stone_description',
        'images',
        'model_3d_url',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'gross_weight_grams' => 'decimal:3',
            'net_gold_weight_grams' => 'decimal:3',
            'making_charges' => 'decimal:2',
            'gemstone_cost' => 'decimal:2',
            'images' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
