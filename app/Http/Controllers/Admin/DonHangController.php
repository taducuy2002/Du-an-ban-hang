<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title='Danh sách đơn hàng';
        $listDonHang=DonHang::query()->orderByDesc('id')->get();
        $trangThaiDonHang=DonHang::TRANG_THAI_DON_HANG;
        return view('admins.donhangs.index',compact('title','listDonHang','trangThaiDonHang'));
    }



    public function show(string $id)
    {
        $donhang=DonHang::query()->findOrFail($id);
        $trangThaiDonHang=DonHang::TRANG_THAI_DON_HANG;
        $trangThanhToan=DonHang::TRANG_THAI_THANH_TOAN;
        return view('admins.donhangs.show',compact('donhang','trangThaiDonHang','trangThanhToan'));
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $donHang=DonHang::query()->find($id);
        $trangThai= $donHang->trang_thai_don_hang;
        $newTrangThai=$request->input('trang_thai_don_hang');
        $trangThais= array_keys(DonHang::TRANG_THAI_DON_HANG);
        //kiểm tra trang thaais đơn hàng đã hủy thì ko sửa được nữa
        if($trangThai === DonHang::HUY_DON_HANG){
            return redirect()->route('admins.donhangs.index')->with('error', 'Đơn Hàng Đã bị Hủy nên không cập nhật được');

        }
// nếu kiểm tra trạng mới ko được được lằm sau trang thái hiện tại

if (array_search($newTrangThai, $trangThais) < array_search($trangThai, $trangThais)) {
    return redirect()->route('admins.donhangs.index')->with('error', 'Không Thành công');

}

$donHang->trang_thai_don_hang=$newTrangThai;
$donHang->save();
return redirect()->route('admins.donhangs.index');
    }


    public function destroy(string $id)
    {
        $donHang=DonHang::query()->find($id);
        if($donHang && $donHang->trang_thai_don_hang == DonHang::HUY_DON_HANG){
        $donHang->ChiTietDonHang()->delete();
        $donHang->delete();
        return redirect()->back();
        }

        return redirect()->back();
    }
}
