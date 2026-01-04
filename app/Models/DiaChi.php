<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChi extends Model
{
    use HasFactory;

    protected $fillable = [
        'ho_ten',
        'so_dien_thoai',
        'dia_chi',
        'thanh_pho',
        'quan',
        'phuong',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
