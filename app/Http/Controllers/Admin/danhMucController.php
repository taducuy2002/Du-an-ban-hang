<?php

namespace App\Http\Controllers\Admin;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class danhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title='Danh Mục Sản Phẩm';
        $listDanhMuc=DanhMuc::orderByDesc('trang_thai')->get();
        return view('admins.danhmucs.index',compact('title','listDanhMuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $title='Thêm Danh Mục Sản Phẩm';
        return view('admins.danhmucs.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
    if($request->isMethod('POST')){
        $dataInsert=$request->except('_token');

        if($request ->hasFile('hinh_anh')){
            $filename=$request->file('hinh_anh')->store('uploads/sanpham','public');

        }else {
            $filename=null;
        }
    }
        $dataInsert['hinh_anh']=$filename;





       // dd($dataInsert);
       DanhMuc::create($dataInsert);
       return redirect()->route('admins.danhmucs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { $listDanhMuc=DanhMuc::find($id);
       if(!$listDanhMuc){
        return redirect()->route('admins.danhmucs.index');
       }

        $title='Chỉnh Sửa Danh Mục Sản Phẩm';
        return view('admins.danhmucs.edit',compact('title','listDanhMuc'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         //Lấy lại thông tin sản phẩm
      $listDanhMuc=DanhMuc::find($id);
      if ($request -> hasFile('hinh_ảnh')) {
        if($listDanhMuc->hinh_anh && Storage::disk('public')->exits($listDanhMuc->hinh_anh)){
     Storage::disk('public')->delete($listDanhMuc->hinh_anh);
        }
        $filename=$request->file('hinh_anh')->store('uploads/sanpham','public');

      }else{
       $filename=$listDanhMuc->hinh_ảnh;

      }
      $dataUpdate=[

        'hinh_ảnh'=>$filename,
        'ten_danh_muc'=>$request->ten_danh_muc,
        'trang_thai'=>$request->trang_thai


    ];

$listDanhMuc->update($dataUpdate);
return redirect()->route('admins.danhmucs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $danhmuc=DanhMuc::find($id);
        if(!$danhmuc){
            return redirect()->route('admins.danhmucs.index');
        }
        //xóa ảnh của sản phẩm
        if ($danhmuc->hinh_anh) {
            if($danhmuc->hinh_anh){
         Storage::disk('public')->delete($danhmuc->hinh_anh);
            }
            // xóa sản phẩm trong db
            $danhmuc->delete();
            return redirect()->route('admins.danhmucs.index');
    }
    }
}
