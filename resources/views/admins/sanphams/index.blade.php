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
                <h4 class="fs-18 fw-semibold m-0">Quản Lý Danh Mục Sản Phẩm </h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title ">Sản Phẩm </h5>
                    </div><!-- end card header -->


                    <div class="table-responsive">
                        <a href="{{route('admins.sanpham.create')}}"><button type="button"
                                class="btn btn-success rounded-pill">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Thêm Sản Phẩm </font>
                                </font>
                            </button></a>

                        <table class="table  table-striped ">

                            <thead>
                                <tr>
                                    <th scope="col">Mã Sản Phẩm</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Tên Sản Phẩm </th>
                                    <th scope="col">Danh Mục </th>
                                    <th scope="col">Giá Sản Phẩm </th>
                                    <th scope="col">Giá Ưu Đãi</th>

                                    <th scope="col">Số Lượng</th>
                                    <th scope="col">Trạng Thái </th>
                                    <th scope="col">Hành Động</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listSanPham as $index => $item)
                                <tr>
                                    <th scope="row">{{ $item->ma_san_pham}}</th>
                                    <td class="image-cell">
                                        <img src="{{ Storage::url($item->hinh_anh) }}" alt="" width="100" height="100">
                                    </td>
                                    <td>{{ $item->ten_san_pham}}</td>
                                    <td>{{ $item->danhMuc->ten_danh_muc}}</td>
                                    <td>{{ number_format($item->gia_san_pham)}}</td>
                                    <td>{{ empty($item->gia_khuyen_mai) ? 0 : $item->gia_khuyen_mai }}</td>
                                    <td>{{ $item->so_luong}}</td>

                                    <td class="{{ $item->is_type ==true ? 'text-success' : 'text-danger'}}">
                                        {{ $item->is_type ==true ? 'Hiển Thị' : 'Ẩn'}}</td>

                                    <td>
                                        <a href="{{route('admins.sanpham.edit',$item->id)}}"><i
                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                        <form action="{{route('admins.sanpham.destroy',$item->id)}}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white"><i
                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
                                        </form>

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

@endsection
