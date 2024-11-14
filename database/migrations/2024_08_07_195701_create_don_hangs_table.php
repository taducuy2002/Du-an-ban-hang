<?php

use App\Models\User;
use App\Models\DonHang;
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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique();
            // lưu trữ thông tin tài khoản đã đặt hàng
            $table->foreignIdFor(User::class)->constrained();
            // lưu trữ thông tin người nhận
            $table->string('ten_nguoi_nhan');
            $table->string('email_nguoi_nhan');
            $table->string('so_dien_thoai_nguoi_nhan',10);
            $table->string('dia_chi_nguoi_nhan');
            $table->string('ghi_chu')->nullable();
           // lưu trữ thông tin quản lý đơn hàng
            $table->string('trang_thai_don_hang')->default(DonHang::CHO_XAC_NHAN);

            $table->string('trang_thai_thanh_toan')->default(DonHang::CHUA_THANH_TOAN);
            $table->double('tien_hang');
            $table->double('tien_ship');
            $table->double('tong_tien');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
