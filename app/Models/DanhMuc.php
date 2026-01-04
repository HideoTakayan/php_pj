<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten',
        'slug',
        'hinh_anh',
        // 'danh_muc_cha_id'
    ];

    // public function cha()
    // {
    //     return $this->belongsTo(DanhMuc::class, 'danh_muc_cha_id');
    // }

    // public function con()
    // {
    //     return $this->hasMany(DanhMuc::class, 'danh_muc_cha_id');
    // }

    public function san_phams()
    {
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }
}
