<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietSanPham extends Model
{
    use HasFactory;
    protected $table='chi_tiet_don_hangs';
    protected $fillable=[
        'don_hang_id',
        'san_pham_id',
        'don_gia',
        'so_luong',
        'thanh_tien',
    ];
    public function donHang(){
        return $this->belongsTo(DonHang::class);
    }
    public function sanPham(){
        return $this->belongsTo(SanPham::class);
    }
}
