<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'credit',
        'debit',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
