<?php

namespace App\Http\Controllers\Admin;

use App\Models\DanhMuc;
use App\Models\HinhAnh;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SanPhamRequest;
use Illuminate\Support\Facades\Storage;

class sanPhamController extends Controller
{

    public function index()
    {
        $title='Danh Sách Sản Phẩm';
        $listSanPham=SanPham::orderByDesc('is_type')->get();

        return view('admins.sanphams.index',compact('title','listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { $title='Thêm  Mục Sản Phẩm';
        $listDanhMuc=DanhMuc::all();
        return view('admins.sanphams.create',compact('title','listDanhMuc'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    { if($request->isMethod('POST')){
        $dataInsert=$request->except('_token');
$dataInsert['is_type']= $request->has('is_type') ? 1 : 0;
$dataInsert['is_hot']= $request->has('is_hot') ? 1 : 0;
$dataInsert['is_hot_deal']= $request->has('is_hot_deal') ? 1 : 0;
$dataInsert['is_show_home']= $request->has('is_show_home') ? 1 : 0;
$dataInsert['is_new']= $request->has('is_new') ? 1 : 0;

        if($request ->hasFile('hinh_anh')){
            $filename=$request->file('hinh_anh')->store('uploads/sanpham','public');

        }else {
            $filename=null;
        }

        $dataInsert['hinh_anh']=$filename;
        //Thêm sản phẩm
        $sanpham=SanPham::query()->create($dataInsert);
        // Lấy id sản phẩm vừa thêm để tải album lên
        $sanphamID=$sanpham->id;
        if($request->hasFile('list_hinh_anh')){
            foreach($request->file('list_hinh_anh') as $image){
if($image){
    $path= $image->store('uploads/hinhAnhsanpham/id_'.$sanphamID,'public');
    $sanpham->hinhAnhSanPham()->create(

        [ 'san_pham_id'=>$sanphamID,
        'hinh_anh'=>$path]
    );
}
            }
        }
        return redirect()->route('admins.sanpham.index')->with('success', 'Thêm San Phẩm thành công');


    }





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
    {
         $listDanhMuc=DanhMuc::all();
         $listSanPham=SanPham::find($id);

             $title='Chỉnh Sửa  Sản Phẩm';
             return view('admins.sanphams.edit',compact('title','listDanhMuc','listSanPham'));




    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            if($request->isMethod('PUT')) {
                $dataInsert = $request->except('_token');
                $dataInsert['is_type'] = $request->has('is_type') ? 1 : 0;
                $dataInsert['is_hot'] = $request->has('is_hot') ? 1 : 0;
                $dataInsert['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
                $dataInsert['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
                $dataInsert['is_new'] = $request->has('is_new') ? 1 : 0;

                $sanPham = SanPham::query()->find($id);

                if ($request->hasFile('hinh_anh')) {
                    if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                         Storage::disk('public')->delete($sanPham->hinh_anh);
                    }
                    $dataInsert['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
                } else {
                     $dataInsert['hinh_anh'] = $sanPham->hinh_anh;
                }

                // xử lý album ảnh
                $currentImages = $sanPham->hinhAnhSanPham->pluck('id')->toArray();
                $arrayCombine = array_combine($currentImages, $currentImages);

                // Xóa hình ảnh cũ
                foreach($arrayCombine as $key => $value){
                    if(!array_key_exists($key, $request->list_hinh_anh)){
                        $hinhAnhSanPham = HinhAnh::query()->find($key);
                        if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                            Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                            $hinhAnhSanPham->delete();
                        }
                    }
                }

                // Xử lý thêm và cập nhật hình ảnh mới
                foreach($request->list_hinh_anh as $key => $image){
                    if(!array_key_exists($key, $arrayCombine)){
                        if($request->hasFile("list_hinh_anh.$key")){
                            $path = $request->file("list_hinh_anh.$key")->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                            $sanPham->hinhAnhSanPham()->create([
                                'san_pham_id' => $id,
                                'hinh_anh' => $path
                            ]);
                        }
                    } else if(is_file($image) && $request->hasFile("list_hinh_anh.$key")){
                        $hinhAnhSanPham = HinhAnh::query()->find($key);
                        if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                            Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                        }
                        $path = $request->file("list_hinh_anh.$key")->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                        $hinhAnhSanPham->update(['hinh_anh' => $path]);
                    }
                }

                $sanPham->update($dataInsert);
                return redirect()->route('admins.sanpham.index')->with('success', 'Cập nhật Sản Phẩm thành công');
            }

        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanPham=SanPham::query()->find($id);
        if($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)){
            Storage::disk('public')->delete($sanPham->hinh_anh);
        }
        $sanPham->hinhAnhSanPham()->delete();
        $path = 'uploads/hinhAnhsanpham/id_'.$id;
        if($sanPham->hinh_anh && Storage::disk('public')->exists($path)){
            Storage::disk('public')->deleteDirectory($path);
        }
        $sanPham->delete();
        return redirect()->route('admins.sanpham.index');

    }

    }
