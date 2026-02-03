<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sliders')->insert([
            [
                'tagline' => 'Bộ sưu tập mùa hè',
                'title' => 'New Arrival',
                'subtitle' => 'Giảm giá lên đến 50%',
                'link' => '/shop',
                'image' => 'uploads/sliders/sample-1.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tagline' => 'Thời trang nam',
                'title' => 'Men Collection',
                'subtitle' => 'Phong cách lịch lãm',
                'link' => '/shop?category=men',
                'image' => 'uploads/sliders/sample-2.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'tagline' => 'Phụ kiện nổi bật',
                'title' => 'Accessories',
                'subtitle' => 'Hoàn thiện phong cách của bạn',
                'link' => '/shop?category=accessories',
                'image' => 'uploads/sliders/sample-3.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
