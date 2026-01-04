<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('slug')->unique();
            $table->string('ma_sp')->unique();
            $table->string('mo_ta_ngan')->nullable();
            $table->text('mo_ta');
            $table->decimal('gia', 10, 2);
            $table->decimal('gia_giam', 10, 2)->nullable();
            $table->enum('tinh_trang', ['con hang', 'het hang'])->default('con hang');
            $table->boolean('hot')->default(false);
            $table->string('hinh_anh')->nullable();
            $table->text('hinh_anh_chi_tiet')->nullable();
            $table->unsignedInteger('so_luong')->default(1);
            $table->bigInteger('danh_muc_id')->unsigned();
            $table->foreign('danh_muc_id')->references('id')->on('danh_mucs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
