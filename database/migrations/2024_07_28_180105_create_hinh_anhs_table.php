<?php

use App\Models\SanPham;
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
        Schema::create('hinh_anhs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SanPham::class)->constrained();
$table->string('hinh_anh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hinh_anhs');
    }
};
