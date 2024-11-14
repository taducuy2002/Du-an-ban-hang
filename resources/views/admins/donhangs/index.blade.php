@extends('layouts.admin')
@section('title')
{{$title}}
@endsection
@section('css')
@endsection
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Đơn Hàng </h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title ">Danh Sách Đơn hàng </h5>
                    </div><!-- end card header -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="table-responsive">


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Mã Đon Hàng</th>
                                    <th class="pro-title">Ngày Đặt</th>
                                    <th class="pro-price">Trạng Thái Đơn Hàng</th>


                                    <th class="pro-quantity">Tổng tiền</th>
                                    <th class="pro-subtotal">Thao tác </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $listDonHang as $key => $item )
                                <tr>
                                    <td>{{$item->ma_don_hang}}</td>
                                    <td>{{ $item->created_at->format('d-m-y')}}</td>
                                    <td>
                                        <form action="{{route('admins.donhangs.update',$item->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <select name="trang_thai_don_hang" id="" class="form-select"
                                                onchange="confirmSubmit(this)"
                                                data-default-value="{{$item->trang_thai_don_hang}}">
                                                @foreach ( $trangThaiDonHang as $key => $value )
                                                <option value="{{$key}}"
                                                    {{$key == $item->trang_thai_don_hang ? 'selected' : ''}}
                                                    {{$key == 'huy_don_hang' ? 'disabled' : ''}}> {{$value}}



                                                </option>
                                                @endforeach
                                            </select>

                                        </form>



                                    </td>
                                    <td>{{ $item->tong_tien}}</td>
                                    <td>
                                        <a href="{{route('admins.donhangs.show',$item->id)}}"><i
                                                class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>

                                        @if ($item->trang_thai_don_hang == 'huy_don_hang')
                                        <form action="{{route('admins.donhangs.destroy',$item->id)}}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white"><i
                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
                                        </form>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div> <!-- container-fluid -->
</div> <!-- content -->
@endsection
@section('js')
<script>
function confirmSubmit(selectElemet) {
    var form = selectElemet.form;
    var selectedOption = selectElemet.options[selectElemet.selectedIndex].text;
    var defaultValue = selectElemet.getAttribute('data-default-value');
    if (confirm('Bạn chắc chắn muốn thay đổi trang thái đơn hàng "' + selectedOption + '"không?')) {
        form.submit();
    } else {
        selectElemet.value = defaultValue;
    }

}
</script>
@endsection
