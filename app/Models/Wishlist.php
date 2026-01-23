<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'san_pham_id'];

    public function product()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
