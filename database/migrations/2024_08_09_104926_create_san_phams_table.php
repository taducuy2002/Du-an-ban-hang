<?php

use App\Models\DanhMuc;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ma_san_pham')->unique();
            $table->string('ten_san_pham');
            $table->string('hinh_anh')->nullable();
            $table->double('gia_san_pham');
            $table->double('gia_khuyen_mai')->nullable();
            $table->string('mo_ta_ngan')->nullable();
            $table->text('noi_dung')->nullable();
            $table->unsignedInteger('so_luong');
            $table->unsignedBigInteger('luot_xem')->default();
            $table->date('ngay_nhap');
            $table->foreignIdFor(DanhMuc::class)->constrained();
            $table->boolean('is_type')->default(true);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_hot')->default(true);
            $table->boolean('is_hot_deal')->default(true);
            $table->boolean('is_show_home')->default(true);

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
