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
                        <h5 class="card-title ">Dahh Mục Sản Phẩm </h5>
                    </div><!-- end card header -->


                    <div class="table-responsive">
                        <a href="{{route('admins.danhmucs.create')}}"><button type="button"
                                class="btn btn-success rounded-pill">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">TThêm Danh Mục</font>
                                </font>
                            </button></a>

                        <table class="table  table-striped ">

                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Tên Danh Mục </th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Hành Động </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listDanhMuc as $index => $item)
                                <tr>
                                    <th scope="row">{{ $index + 1}}</th>
                                    <td class="image-cell">
                                        <img src="{{ Storage::url($item->hinh_anh) }}" alt="" width="100" height="100">
                                    </td>


                                    <td>{{ $item->ten_danh_muc}}</td>
                                    <td class="{{ $item->trang_thai ==true ? 'text-success' : 'text-danger'}}">
                                        {{ $item->trang_thai ==true ? 'Hiển Thị' : 'Ẩn'}}</td>

                                    <td>
                                        <a href="{{route('admins.danhmucs.edit',$item->id)}}"><i
                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                <form action="{{route('admins.danhmucs.destroy',$item->id)}}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-white"><i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
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
