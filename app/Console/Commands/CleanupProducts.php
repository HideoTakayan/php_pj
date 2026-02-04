<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Artisan Command: Xóa toàn bộ dữ liệu sản phẩm và đơn hàng
 * 
 * Sử dụng: php artisan cleanup:products
 * 
 * Chức năng:
 * - Xóa chi tiết đơn hàng
 * - Xóa đơn hàng
 * - Xóa sản phẩm
 * - Tắt foreign key constraints để tránh lỗi
 */
class CleanupProducts extends Command
{
    protected $signature = 'cleanup:products';
    protected $description = 'Xóa toàn bộ dữ liệu sản phẩm và đơn hàng liên quan';

    /**
     * Thực thi command
     * Sử dụng truncate() để xóa nhanh toàn bộ dữ liệu
     */
    public function handle()
    {
        $this->info('Đang xóa dữ liệu...');
        
        try {
            // Tắt foreign key constraints để tránh lỗi khi xóa
            Schema::disableForeignKeyConstraints();

            // Xóa theo thứ tự: chi tiết → đơn hàng → sản phẩm
            DB::table('chi_tiet_don_hangs')->truncate();
            $this->info('Đã xóa chi tiết đơn hàng.');

            DB::table('don_hangs')->truncate();
            $this->info('Đã xóa đơn hàng.');

            DB::table('san_phams')->truncate();
            $this->info('Đã xóa sản phẩm.');

            // Bật lại foreign key constraints
            Schema::enableForeignKeyConstraints();

            $this->info('Hoàn tất! Dữ liệu đã được xóa sạch.');
        } catch (\Exception $e) {
            $this->error('Lỗi: ' . $e->getMessage());
        }
    }
}
