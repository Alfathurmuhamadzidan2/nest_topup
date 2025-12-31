<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'status',
        'image',
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'name' => 'Produk tidak ditemukan'
        ]);
    }
}
