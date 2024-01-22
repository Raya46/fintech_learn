<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'photo',
        'description',
        'categories_id',
        'stand',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'transactions_id');
    }
}
