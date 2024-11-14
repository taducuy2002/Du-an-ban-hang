<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function detailSanPham(string $id){
        $sanpham=SanPham::query()->findOrFail($id);
        $listSanPham=SanPham::query()->get();
        return view('clients.sanphams.chitiet',compact('sanpham','listSanPham'));
    }
}
