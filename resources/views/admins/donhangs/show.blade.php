@extends('layouts.client')
@section('css')

@endsection
@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">cart</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- cart main wrapper start -->
<div class="cart-main-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">

                    <div class="myaccount-content">
                        <h4>Thông Tin Đơn Hàng :<span class="text-danger">{{$donhang->ma_don_hang}}</span></h4>
                        <div class="welcome">
                            <p>Tên Người Nhận:<strong>{{$donhang->ten_nguoi_nhan}}</strong></p>
                            <p>Email:<strong>{{$donhang->email_nguoi_nhan}}</strong></p>
                            <p>Phone:<strong>{{$donhang->so_dien_thoai_nguoi_nhan}}</strong></p>
                            <p>Address:<strong>{{$donhang->dia_chi_nguoi_nhan}}</strong></p>
                            <p>Note:<strong>{{$donhang->ghi_chu}}</strong></p>
                            <p>Tiền Hàng:<strong>{{$donhang->tien_hang}}</strong></p>
                            <p>Phí Ship:<strong>{{$donhang->tien_ship}}</strong></p>
                            <p>Tổng Tiền Thanh Toán :<strong>{{$donhang->tong_tien}}</strong></p>
                            <p>TRạng Thái Đơn
                                Hàng:<strong>{{ $trangThaiDonHang[$donhang->trang_thai_don_hang]}}</strong></p>
                            <p>TRạng Thái Thanh Toán
                                :<strong>{{ $trangThanhToan[$donhang->trang_thai_thanh_toan]}}</strong></p>

                        </div>
                        <p class='mb-0'> </p>
                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-12">


                            <div class="myaccount-content">
                                <h5>Orders</h5>
                                <div class="myaccount-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Hình Ảnh</th>
                                                <th>Mã Sản Phẩm</th>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Đơn Giá</th>
                                                <th>Số Lượng </th>
                                                <th>Thành Tiền</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donhang->chiTietDonHang as $item)
                                            @php
                                                $sanPham=$item->sanPham;
                                            @endphp
<tr>
                                                <td><img src="{{Storage::url($sanPham->hinh_anh)}}" alt="" width="50px"></td>
                                                <td>{{$sanPham->ma_san_pham}}</td>
                                                <td>{{$sanPham->ten_san_pham}}</td>
                                                <td>{{$sanPham->gia_san_pham}}</td>
                                                <td>{{$item->so_luong}}</td>
                                                <td>{{$item->thanh_tien}}</td>

                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p class='mb-0'> </p>


                        </div>




                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->



    @endsection
    @section('js')
    <script>
    $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
    $('.pro-qty').append('<span class="inc qtybtn">+</span>');

    // Hàm cập nhật tổng giỏ hàng
    function update() {
        var subTotal = 0;
        // Tính tổng số tiền của các sản phẩm có trong giỏ hàng
        $('.quantityInput').each(function() {
            var $input = $(this);
            var price = parseFloat($input.data('price'));
            var quantity = parseFloat($input.val());
            subTotal += price * quantity;
        });
        // Lấy số tiền ở vận chuyển
        var shipping = parseFloat($('.shipping').text().replace(/\./g, '').replace('đ', ''));
        var total = subTotal + shipping;
        // Cập nhật giá trị
        $('.sub-total').text(subTotal.toLocaleString('vi-VN') + 'đ');
        $('.total-amount').text(total.toLocaleString('vi-VN') + 'đ');
    }

    $('.qtybtn').on('click', function() {
        var $button = $(this);
        var $input = $button.parent().find('input.quantityInput');
        var oldValue = parseFloat($input.val());
        var newVal;
        if ($button.hasClass('inc')) {
            newVal = oldValue + 1;
        } else {
            newVal = oldValue > 1 ? oldValue - 1 : 1;
        }
        $input.val(newVal);
        // Cập nhật lại giá trị input ẩn
        $input.closest('tr').find('input[name^="cart"]').each(function() {
            if ($(this).attr('name').includes('so_luong')) {
                $(this).val(newVal);
            }
        });
        // Cập nhật lại giá trị subtotal
        var price = parseFloat($input.data('price'));
        var subtotalElement = $input.closest('tr').find('.subtotal');
        var newsubtotal = newVal * price;
        subtotalElement.text(newsubtotal.toLocaleString('vi-VN') + 'đ');
        update();
    });

    $('.quantityInput').on('change', function() {
        var value = parseInt($(this).val());
        if (isNaN(value) || value < 1) {
            alert('Số lượng phải lớn hơn 1');
            $(this).val(1);
        }
        // Cập nhật lại giá trị input ẩn
        $(this).closest('tr').find('input[name^="cart"]').each(function() {
            if ($(this).attr('name').includes('so_luong')) {
                $(this).val($(this).val());
            }
        });
        update();
    });

    // Xử lý xóa sản phẩm trong giỏ hàng
    $('.pro-remove').on('click', function(event) {
        event.preventDefault(); // Chặn thao tác mặc định của thẻ a
        var $row = $(this).closest('tr');
        $row.remove(); // Xóa hàng
        update();
    });

    update();
    </script>
    @endsection
