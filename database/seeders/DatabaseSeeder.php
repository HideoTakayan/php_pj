<?php

namespace Database\Seeders;

use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\BaiViet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            // Tạo user admin
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => '123456', // model casts to hashed
                'mobile' => '0123456789',
                'utype' => 'admin',
            ]);
            $this->command->info('User Admin created');

            // Tạo user thường
            $user = User::create([
                'name' => 'User Demo',
                'email' => 'user@example.com',
                'password' => '123456', // model casts to hashed
                'mobile' => '0987654321',
            ]);
            $this->command->info('User Demo created');

            // Tạo danh mục
            $categories = [
                [
                    'ten' => 'Áo Nam',
                    'slug' => 'ao-nam',
                    'hinh_anh' => 'https://via.placeholder.com/300x300?text=Ao+Nam',
                ],
                [
                    'ten' => 'Áo Nữ',
                    'slug' => 'ao-nu',
                    'hinh_anh' => 'https://via.placeholder.com/300x300?text=Ao+Nu',
                ],
                [
                    'ten' => 'Quần Nam',
                    'slug' => 'quan-nam',
                    'hinh_anh' => 'https://via.placeholder.com/300x300?text=Quan+Nam',
                ],
                [
                    'ten' => 'Quần Nữ',
                    'slug' => 'quan-nu',
                    'hinh_anh' => 'https://via.placeholder.com/300x300?text=Quan+Nu',
                ],
                [
                    'ten' => 'Phụ Kiện',
                    'slug' => 'phu-kien',
                    'hinh_anh' => 'https://via.placeholder.com/300x300?text=Phu+Kien',
                ],
            ];

            foreach ($categories as $category) {
                DanhMuc::create($category);
            }
            $this->command->info('Categories created');

            // Tạo sản phẩm
            $products = [
                // Áo Nam
                [
                    'ten' => 'Áo Thun Nam Basic',
                    'slug' => 'ao-thun-nam-basic',
                    'ma_sp' => 'ATN001',
                    'mo_ta_ngan' => 'Áo thun nam chất liệu cotton cao cấp, thoáng mát',
                    'mo_ta' => 'Áo thun nam thiết kế basic, dễ phối đồ. Chất liệu cotton 100% thoáng mát, thấm hút mồ hôi tốt. Phù hợp mặc hàng ngày.',
                    'gia' => 199000,
                    'gia_giam' => 149000,
                    'tinh_trang' => 'con hang',
                    'hot' => 1,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Ao+Thun+Nam',
                    'hinh_anh_chi_tiet' => json_encode([
                        'https://via.placeholder.com/500x500?text=Detail+1',
                        'https://via.placeholder.com/500x500?text=Detail+2',
                    ]),
                    'so_luong' => 100,
                    'danh_muc_id' => 1,
                ],
                [
                    'ten' => 'Áo Sơ Mi Nam Công Sở',
                    'slug' => 'ao-so-mi-nam-cong-so',
                    'ma_sp' => 'ASM001',
                    'mo_ta_ngan' => 'Áo sơ mi nam công sở lịch sự, sang trọng',
                    'mo_ta' => 'Áo sơ mi nam thiết kế công sở, form dáng chuẩn. Chất liệu vải kate mềm mại, không nhăn. Phù hợp đi làm, đi tiệc.',
                    'gia' => 350000,
                    'gia_giam' => null,
                    'tinh_trang' => 'con hang',
                    'hot' => 0,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Ao+So+Mi',
                    'hinh_anh_chi_tiet' => json_encode([
                        'https://via.placeholder.com/500x500?text=Detail+1',
                    ]),
                    'so_luong' => 50,
                    'danh_muc_id' => 1,
                ],
                // Áo Nữ
                [
                    'ten' => 'Áo Kiểu Nữ Hoa Nhí',
                    'slug' => 'ao-kieu-nu-hoa-nhi',
                    'ma_sp' => 'AKN001',
                    'mo_ta_ngan' => 'Áo kiểu nữ họa tiết hoa nhí dễ thương',
                    'mo_ta' => 'Áo kiểu nữ thiết kế trẻ trung với họa tiết hoa nhí. Chất liệu voan mềm mại, thoáng mát. Phù hợp đi chơi, dạo phố.',
                    'gia' => 280000,
                    'gia_giam' => 199000,
                    'tinh_trang' => 'con hang',
                    'hot' => 1,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Ao+Kieu+Nu',
                    'hinh_anh_chi_tiet' => json_encode([
                        'https://via.placeholder.com/500x500?text=Detail+1',
                        'https://via.placeholder.com/500x500?text=Detail+2',
                    ]),
                    'so_luong' => 80,
                    'danh_muc_id' => 2,
                ],
                [
                    'ten' => 'Áo Thun Nữ Form Rộng',
                    'slug' => 'ao-thun-nu-form-rong',
                    'ma_sp' => 'ATN002',
                    'mo_ta_ngan' => 'Áo thun nữ form rộng thoải mái',
                    'mo_ta' => 'Áo thun nữ thiết kế form rộng thoải mái. Chất liệu cotton 100% mềm mại. Phù hợp mặc nhà, đi học.',
                    'gia' => 150000,
                    'gia_giam' => null,
                    'tinh_trang' => 'con hang',
                    'hot' => 0,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Ao+Thun+Nu',
                    'hinh_anh_chi_tiet' => json_encode([]),
                    'so_luong' => 120,
                    'danh_muc_id' => 2,
                ],
                // Quần Nam
                [
                    'ten' => 'Quần Jeans Nam Slim Fit',
                    'slug' => 'quan-jeans-nam-slim-fit',
                    'ma_sp' => 'QJN001',
                    'mo_ta_ngan' => 'Quần jeans nam form slim fit chuẩn dáng',
                    'mo_ta' => 'Quần jeans nam thiết kế slim fit ôm vừa vặn. Chất liệu denim cao cấp, bền đẹp. Phù hợp đi làm, đi chơi.',
                    'gia' => 450000,
                    'gia_giam' => 350000,
                    'tinh_trang' => 'con hang',
                    'hot' => 1,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Quan+Jeans',
                    'hinh_anh_chi_tiet' => json_encode([
                        'https://via.placeholder.com/500x500?text=Detail+1',
                    ]),
                    'so_luong' => 60,
                    'danh_muc_id' => 3,
                ],
                [
                    'ten' => 'Quần Kaki Nam',
                    'slug' => 'quan-kaki-nam',
                    'ma_sp' => 'QKN001',
                    'mo_ta_ngan' => 'Quần kaki nam công sở lịch sự',
                    'mo_ta' => 'Quần kaki nam thiết kế công sở. Chất liệu kaki cao cấp, không nhăn. Phù hợp đi làm.',
                    'gia' => 380000,
                    'gia_giam' => null,
                    'tinh_trang' => 'con hang',
                    'hot' => 0,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Quan+Kaki',
                    'hinh_anh_chi_tiet' => json_encode([]),
                    'so_luong' => 70,
                    'danh_muc_id' => 3,
                ],
                // Quần Nữ
                [
                    'ten' => 'Quần Jeans Nữ Ống Rộng',
                    'slug' => 'quan-jeans-nu-ong-rong',
                    'ma_sp' => 'QJN002',
                    'mo_ta_ngan' => 'Quần jeans nữ ống rộng thời trang',
                    'mo_ta' => 'Quần jeans nữ thiết kế ống rộng trendy. Chất liệu denim cao cấp. Phù hợp đi chơi, dạo phố.',
                    'gia' => 420000,
                    'gia_giam' => 320000,
                    'tinh_trang' => 'con hang',
                    'hot' => 1,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Quan+Jeans+Nu',
                    'hinh_anh_chi_tiet' => json_encode([
                        'https://via.placeholder.com/500x500?text=Detail+1',
                        'https://via.placeholder.com/500x500?text=Detail+2',
                    ]),
                    'so_luong' => 90,
                    'danh_muc_id' => 4,
                ],
                [
                    'ten' => 'Váy Midi Nữ',
                    'slug' => 'vay-midi-nu',
                    'ma_sp' => 'VMN001',
                    'mo_ta_ngan' => 'Váy midi nữ thanh lịch',
                    'mo_ta' => 'Váy midi nữ thiết kế thanh lịch, nữ tính. Chất liệu vải mềm mại. Phù hợp đi làm, đi tiệc.',
                    'gia' => 350000,
                    'gia_giam' => null,
                    'tinh_trang' => 'con hang',
                    'hot' => 0,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Vay+Midi',
                    'hinh_anh_chi_tiet' => json_encode([]),
                    'so_luong' => 40,
                    'danh_muc_id' => 4,
                ],
                // Phụ Kiện
                [
                    'ten' => 'Túi Xách Nữ Da PU',
                    'slug' => 'tui-xach-nu-da-pu',
                    'ma_sp' => 'TXN001',
                    'mo_ta_ngan' => 'Túi xách nữ da PU cao cấp',
                    'mo_ta' => 'Túi xách nữ thiết kế sang trọng. Chất liệu da PU cao cấp, bền đẹp. Nhiều ngăn tiện dụng.',
                    'gia' => 550000,
                    'gia_giam' => 450000,
                    'tinh_trang' => 'con hang',
                    'hot' => 1,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Tui+Xach',
                    'hinh_anh_chi_tiet' => json_encode([
                        'https://via.placeholder.com/500x500?text=Detail+1',
                    ]),
                    'so_luong' => 30,
                    'danh_muc_id' => 5,
                ],
                [
                    'ten' => 'Mũ Lưỡi Trai',
                    'slug' => 'mu-luoi-trai',
                    'ma_sp' => 'MLT001',
                    'mo_ta_ngan' => 'Mũ lưỡi trai thời trang',
                    'mo_ta' => 'Mũ lưỡi trai thiết kế basic. Chất liệu vải cotton thoáng mát. Phù hợp đi chơi, chơi thể thao.',
                    'gia' => 120000,
                    'gia_giam' => null,
                    'tinh_trang' => 'con hang',
                    'hot' => 0,
                    'hinh_anh' => 'https://via.placeholder.com/500x500?text=Mu+Luoi+Trai',
                    'hinh_anh_chi_tiet' => json_encode([]),
                    'so_luong' => 150,
                    'danh_muc_id' => 5,
                ],
            ];

            foreach ($products as $product) {
                SanPham::create($product);
            }
            $this->command->info('Products created');

            // Tạo bài viết
            $posts = [
                [
                    'ten' => 'Xu hướng thời trang mùa xuân 2024',
                    'slug' => 'xu-huong-thoi-trang-mua-xuan-2024',
                    'noi_dung' => 'Mùa xuân 2024 đang đến gần với những xu hướng thời trang mới mẻ và thú vị. Các tông màu pastel nhẹ nhàng, họa tiết hoa lá tươi mới đang được ưa chuộng...',
                    'anh_bia' => 'https://via.placeholder.com/800x400?text=Xu+Huong+Thoi+Trang',
                    'luot_xem' => 150,
                    'luot_thich' => 25,
                    'is_publish' => 1,
                    'is_comment' => 1,
                    'user_id' => $admin->id,
                ],
                [
                    'ten' => 'Cách phối đồ công sở cho nữ',
                    'slug' => 'cach-phoi-do-cong-so-cho-nu',
                    'noi_dung' => 'Phối đồ công sở không chỉ cần lịch sự mà còn phải thể hiện phong cách cá nhân. Hãy cùng khám phá những tips phối đồ công sở thông minh...',
                    'anh_bia' => 'https://via.placeholder.com/800x400?text=Phoi+Do+Cong+So',
                    'luot_xem' => 200,
                    'luot_thich' => 40,
                    'is_publish' => 1,
                    'is_comment' => 1,
                    'user_id' => $admin->id,
                ],
                [
                    'ten' => 'Bí quyết chọn quần jeans phù hợp',
                    'slug' => 'bi-quyet-chon-quan-jeans-phu-hop',
                    'noi_dung' => 'Quần jeans là item không thể thiếu trong tủ đồ. Tuy nhiên, làm sao để chọn được chiếc quần jeans phù hợp với vóc dáng của bạn?',
                    'anh_bia' => 'https://via.placeholder.com/800x400?text=Chon+Quan+Jeans',
                    'luot_xem' => 180,
                    'luot_thich' => 30,
                    'is_publish' => 1,
                    'is_comment' => 1,
                    'user_id' => $admin->id,
                ],
            ];

            foreach ($posts as $post) {
                BaiViet::create($post);
            }
            $this->command->info('Posts created');

            $this->command->info('✅ Đã tạo dữ liệu mẫu thành công!');
            $this->command->info('📧 Admin: admin@example.com / 123456');
            $this->command->info('📧 User: user@example.com / 123456');

        } catch (\Exception $e) {
            $msg = $e->getMessage() . "\n" . $e->getFile() . ":" . $e->getLine();
            file_put_contents(base_path('seed_error.txt'), $msg);
            $this->command->error($msg);
        }
    }
}
