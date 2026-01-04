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
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('slug')->unique();
            $table->longText('noi_dung');
            $table->string('anh_bia');
            $table->unsignedBigInteger('luot_xem')->default(0);
            $table->unsignedBigInteger('luot_thich')->default(0);

            $table->boolean('is_publish')->default(true);
            $table->boolean('is_comment')->default(true);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viets');
    }
};
