<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['quantity', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
