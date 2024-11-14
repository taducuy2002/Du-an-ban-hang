<?php

namespace App\Models;

use App\Models\User;
use App\Models\ChiTietSanPham;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonHang extends Model
{
    use HasFactory;
    protected $table='don_hangs';
protected $fillable=[
    'ma_don_hang',
    'user_id',
    'ten_nguoi_nhan',
    'email_nguoi_nhan',
    'so_dien_thoai_nguoi_nhan',
    'dia_chi_nguoi_nhan',
    'ghi_chu',
    'trang_thai_don_hang',
    'trang_thai_thanh_toan',
    'tien_hang',
    'tien_ship',
    'tong_tien',
];

    const TRANG_THAI_DON_HANG =[
        'cho_xac_nhan' => 'Chờ Xác Nhận',
        'da_xac_nhan' => 'Đã xác Nhận',
        'dang_chuan_bi' => 'Đang Chuẩn Bị',
        'dang_van_chuyen' => 'Đang Vận Chuyển',
        'da_giao_hang' => 'Đang giao Hàng',
        'huy_don_hang' => 'Hủy Đơn Hàng',

    ];
    const TRANG_THAI_THANH_TOAN =[
        'chua_thanh_toan' => 'Chưa Thanh Toán',
        'da_thanh_toan' => 'Đã Thanh Toán',

    ];

    const CHO_XAC_NHAN = 'cho_xac_nhan';
    const DA_XAC_NHAN = 'da_xac_nhan';
    const DANG_CHUAN_BI = 'dang_chuan_bi';
    const DANG_VAN_CHUYEN = 'dang_van_chuyen';
    const DA_GIAO_HANG = 'da_giao_hang';
    const HUY_DON_HANG = 'huy_don_hang';
    const CHUA_THANH_TOAN = 'chua_thanh_toan';
    const DA_THANH_TOAN = 'da_thanh_toan';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ChiTietDonHang(){
        return $this->hasMany(ChiTietSanPham::class);
    }
}
