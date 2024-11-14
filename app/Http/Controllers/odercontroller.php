<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Mail\MailConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class odercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donhang=Auth::user()->donHang;
        $trangThaiDonHang=DonHang::TRANG_THAI_DON_HANG;
        $type_cho_xac_nhan=DonHang::CHO_XAC_NHAN;
        $type_dang_van_chuyen=DonHang::DANG_VAN_CHUYEN;
return view('clients.donhangs.index',compact('donhang','trangThaiDonHang','type_cho_xac_nhan','type_dang_van_chuyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carts = session()->get('cart',[]);
        if(!empty($carts)){
        $total=0;
        $subTotal=0;
        foreach ($carts as  $item) {
    $subTotal += $item['gia'] * $item['so_luong'];

}
        $shipping=30000;
        $total=$subTotal + $shipping;
             return view('clients.donhangs.create',compact('total','shipping','subTotal','carts'));
        }
       return redirect()->route('cart.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            DB::beginTransaction();
            try {
            $params=$request->except(('_token'));
            $params['ma_don_hang']=$this->auto();
            $donhang=DonHang::query()->create($params);
            $donHangId=$donhang->id;
            $carts = session()->get('cart',[]);
            foreach ($carts as $key => $item) {
                $thanhTien=$item['gia']*$item['so_luong'];
                $donhang->ChiTietDonHang()->create([
                    'don_hang_id'=>$donHangId,
                    'san_pham_id'=>$key,
                    'don_gia' =>$item['gia'],
                    'so_luong'=>$item['so_luong'],
                    'thanh_tien'=>$thanhTien,
                ]);
            }

            DB::commit();


            // tự trừ đi số lượng của sản phẩm

            // Gửi  Mail thông qua đặt hàng thành công
            Mail::to($donhang->email_nguoi_nhan)->queue(new MailConfirm($donhang));
            session()->put('cart',[]);
            return redirect()->route('donhangs.index')->with('error','Tạo thành công đon hàng');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('cart.list')->with('error','cố Lỗi khi tạo đơn hàng,vui lòng thử sau ');
}
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donhang=DonHang::query()->findOrFail($id);
        $trangThaiDonHang=DonHang::TRANG_THAI_DON_HANG;
        $trangThanhToan=DonHang::TRANG_THAI_THANH_TOAN;
return view('clients.donhangs.show',compact('donhang','trangThaiDonHang','trangThanhToan'));

    }


    public function update(Request $request, string $id)
    {
        $donhang=DonHang::find($id);
        DB::beginTransaction();
        try {
            if($request->has('huy_don_hang')){
$donhang->update(['trang_thai_don_hang'=> DonHang::HUY_DON_HANG]);
            }elseif( $request->has('gia_hang_thanh_cong')){
                $donhang->update(['trang_thai_don_hang'=> DonHang::DA_GIAO_HANG]);

            }

            DB::commit();



        } catch (\Exception $e) {
            DB::rollBack();

}
return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function auto(){
        do {
            $orderCode='ORD' . Auth::id().'-'.now()->timestamp;

        } while (DonHang::where('ma_don_hang',$orderCode)->exists());
        return $orderCode;
    }
}
