<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CleanupProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xóa toàn bộ dữ liệu sản phẩm và đơn hàng liên quan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Đang xóa dữ liệu...');
        
        try {
            Schema::disableForeignKeyConstraints();

            DB::table('chi_tiet_don_hangs')->truncate();
            $this->info('Đã xóa chi tiết đơn hàng.');

            DB::table('don_hangs')->truncate();
            $this->info('Đã xóa đơn hàng.');

            DB::table('san_phams')->truncate();
            $this->info('Đã xóa sản phẩm.');

            Schema::enableForeignKeyConstraints();

            $this->info('Hoàn tất! Dữ liệu đã được xóa sạch.');
        } catch (\Exception $e) {
            $this->error('Lỗi: ' . $e->getMessage());
        }
    }
}
