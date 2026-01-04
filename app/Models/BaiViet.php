<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaiViet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ten',
        'slug',
        'noi_dung',
        'anh_bia',
        'luot_xem',
        'luot_thich',
        'is_publish',
        'is_comment',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
