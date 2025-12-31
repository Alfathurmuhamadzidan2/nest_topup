<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'product_id',
        'variant_id',
        'amount',
        'total_price',
        'payment_method',
        'account_id',
        'contact',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
        return $this->belongsTo(Product::class)->withDefault([
        'name' => 'Produk tidak ditemukan'
    ]);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
        return $this->belongsTo(ProductVariant::class)->withDefault([
        'name' => '—'
    ]);
    }
    
}
