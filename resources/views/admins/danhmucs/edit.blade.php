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
                <h4 class="fs-18 fw-semibold m-0">Thêm Danh Mục Sản Phẩm </h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title ">Thông Tin Danh Mục Sản Phẩm </h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('admins.danhmucs.update',$listDanhMuc->id)}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">
                                            Tên Danh Mục
                                        </label>
                                        <input type="text" id="simpleinput" class="form-control" name="ten_danh_muc" @error('ten_danh_muc') is-invalid @enderror value="{{$listDanhMuc->ten_danh_muc}}">
                                        @error('ten_danh_muc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">
                                            Hình Ảnh
                                        </label>
                                        <input type="file" id="example-email" name="hinh_anh" class="form-control"value="{{$listDanhMuc->hinh_anh}}">

                                    </div>



                                    <div class="mb-3">
                                        <label for="example-disable" class="form-label">
                                            Trạng thái

                                        </label>
                                        <select class="form-select" id="example-select" name="trang_thai">

                                            <option value="0" {{$listDanhMuc->trang_thai ==true ?  'checked' : ' '}} >

                                                Ẩn
                                            </option>
                                            <option value="1" {{$listDanhMuc->trang_thai ==false ?  'checked' : ' '}} >
                                                Hiển Thị
                                            </option>
                                        </select>

                                    </div>
                                    <button type="submit" class="btn btn-success rounded-pill">Thêm</button>
                                </form>
                            </div>




                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div> <!-- container-fluid -->
<!-- content -->
@endsection
@section('js')

@endsection
