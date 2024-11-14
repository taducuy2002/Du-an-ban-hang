@component('mail::message')
    # Xác Nhận đơn hàng
    Xin Chào{{ $donhang->ten_nguoi_nhan }},
    Cảm Ơn Bạn Đã đặt hàng của  chúng tôi , Đây là thông tin đơn hàng của bẻn bạn :
    *** Mã Đơn Hàng *:{{ $donhang->ma_don_hang }}
    *** Sản Phẩm Đã Đặt *
    @foreach ($donhang->chiTietDonHang as $chitiet)
        {{ $chitiet->sanPham->ten_san_pham }} x {{ $chitiet->so_luong }} : {{ $chitiet->thanh_tien }} đ
    @endforeach
*** Tổng Tiền * {{ $donhang->tong_tien }}
Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận thông tin giao hàng .
{{ config('app.name') }}
@endcomponent
