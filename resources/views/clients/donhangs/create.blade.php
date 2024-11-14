@extends('layouts.client')
@section('css')

@endsection
@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="checkoutaccordion" id="checkOutAccordion">
            <div class="card">
                <h6> <span data-bs-toggle="collapse" data-bs-target="#couponaccordion"></span></h6>
                <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                </div>
            </div>
        </div>
        <form action="{{route('donhangs.store')}}" method="POST">
            <div class="row">
                @csrf
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Billing Details</h5>
                        <div class="billing-form-wrap">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="single-input-item">
                                <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                            </div>
                            <div class="single-input-item">
                                <label for="ten_nguoi_nhan" class="required">Tên Người Nhận</label>
                                <input type="text" id="ten_nguoi_nhan"  name="ten_nguoi_nhan" placeholder="Nhập Tên Người Nhận" value="{{Auth::user()->name}}">
                                @error('ten_nguoi_nhan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-input-item">
                                <label for="email_nguoi_nhan" class="required">Email Address</label>
                                <input type="email" id="email_nguoi_nhan" placeholder="Email Address" value="{{Auth::user()->email}}" name="email_nguoi_nhan">
                                @error('email_nguoi_nhan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-input-item">
                                <label for="so_dien_thoai_nguoi_nhan" class="required">Số Điện Thoại</label>
                                <input type="text" id="so_dien_thoai_nguoi_nhan" placeholder="Số Điện Thoại" value="{{Auth::user()->phone}}" name="so_dien_thoai_nguoi_nhan">
                                @error('so_dien_thoai_nguoi_nhan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-input-item">
                                <label for="dia_chi_nguoi_nhan" class="required">Địa Chỉ</label>
                                <input type="text" id="dia_chi_nguoi_nhan" placeholder="Địa Chỉ" value="{{Auth::user()->address}}" name="dia_chi_nguoi_nhan">
                                @error('dia_chi_nguoi_nhan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-input-item">
                                <label for="ghi_chu">Order Note</label>
                                <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3" placeholder="Ghi Chú"></textarea>
                                @error('ghi_chu')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Your Order Summary</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $key => $item)
                                        <tr>
                                            <td><a href="{{route('products.detail',$key)}}">{{ $item['ten_san_pham'] }}
                                                <strong> × {{$item['so_luong']}}</strong></a>
                                            </td>
                                            <td>{{$item['gia'] * $item['so_luong']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td><strong>{{$subTotal}}</strong></td>
                                            <input type="hidden" name="tien_hang" id="" value="{{$subTotal}}">
                                            @error('tien_hang')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td>
                                                <strong>{{$shipping}}</strong>
                                                <input type="hidden" name="tien_ship" id="" value="{{$shipping}}">
                                                @error('tien_ship')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td><strong>{{$total}}</strong></td>
                                            <input type="hidden" name="tong_tien" id="" value="{{$total}}">
                                            @error('tong_tien')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method show">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashon" class="custom-control-input" checked="">
                                            <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="cash">
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                </div>
                                <div class="summary-footer-area">
                                    <button type="submit" class="btn btn-sqr"> Xác Nhận Đặt Hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- cart main wrapper start -->

<!-- cart main wrapper end -->
@endsection
@section('js')

@endsection
