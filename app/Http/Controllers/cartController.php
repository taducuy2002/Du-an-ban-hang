<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function listCart(){
       // session()->put('cart',[]);
        $cart=session()->get('cart',[]);
        $total =0;
        $subTotal=0;
        foreach($cart as $item) {
            // Kiểm tra xem key 'gia' có tồn tại và có phải là số không
            if (isset($item['gia']) && is_numeric($item['gia'])) {
                $subTotal += $item['gia'] * $item['so_luong'];
            } else {
                // Xử lý lỗi, ví dụ:
                echo "Giá của sản phẩm không hợp lệ";
                // Hoặc ghi log lỗi

            }
        }

        $shiping = 30000;
        $total = $subTotal + $shiping;

return view('clients.giohang', compact('cart','subTotal','shiping','total'));
    }
    public function addCart(Request $request){

            $productId = $request->input('product_id');
            $quantity = $request->input('quantity');

            // Kiểm tra nếu không có sản phẩm hoặc số lượng

            $sanpham = SanPham::query()->findOrFail($productId);

            // Khởi tạo mảng chứa thông tin giỏ hàng trên session
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['so_luong'] += $quantity;
            } else {
                $cart[$productId] = [
                    'ten_san_pham' => $sanpham->ten_san_pham,
                    'so_luong' => $quantity,
                    'gia' => isset($sanpham->gia_khuyen_mai) ? $sanpham->gia_khuyen_mai : $sanpham->gia_san_pham,
                    'hinh_anh' => $sanpham->hinh_anh,
                ];
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công!');

    }

    public function updateCart(Request $request) {
        $cartNew = $request->input('cart', []);
        session()->put('cart', $cartNew);
        return redirect()->back()->with('success', 'Cart updated successfully');
    }

}

