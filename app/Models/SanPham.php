<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten',
        'slug',
        'ma_sp',
        'mo_ta_ngan',
        'mo_ta',
        'gia',
        'gia_giam',
        'tinh_trang',
        'hot',
        'hinh_anh',
        'hinh_anh_chi_tiet',
        'so_luong',
        'danh_muc_id',
        // 'danh_muc_id',
    ];


    public function danh_muc()
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function finalPrice()
    {
        return $this->gia_giam ?? $this->gia;
    }
}
