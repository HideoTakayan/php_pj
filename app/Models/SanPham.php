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
        'hinh_anh_chi_tiet',
        'so_luong',
        'danh_muc_id',
    ];


    public function danh_muc()
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function finalPrice()
    {
        return $this->gia_giam ?? $this->gia;
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getMainImageAttribute()
    {
        if (empty($this->hinh_anh_chi_tiet)) {
            return 'assets/images/no-image.png';
        }

        $images = explode(',', $this->hinh_anh_chi_tiet);
        return $images[0];
    }
}
