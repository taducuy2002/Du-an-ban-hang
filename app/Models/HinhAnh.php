<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnh extends Model
{
    use HasFactory;
    protected $table='hinh_anhs';
    protected $fillable=[
'san_pham_id',
        'hinh_anh'
    ];
    public function sanPham(){
        return $this->belongsTo(SanPham::class);
    }
}
