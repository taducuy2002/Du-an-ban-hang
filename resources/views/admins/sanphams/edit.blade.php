@extends('layouts.admin')

@section('title')
{{ $title }}
@endsection

@section('css')
<link href="{{ asset('assets/admin/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Sửa Sản Phẩm</h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Thông Tin Sản Phẩm</h5>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <form action="{{ route('admins.sanpham.update',$listSanPham->id) }}" method="post"
                            enctype="multipart/form-data" class="row">
                            @csrf
                            @method('put')
                            <div class="col-lg-4">

                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" id="simpleinput" class="form-control" name="ten_san_pham"
                                        value="{{$listSanPham -> ten_san_pham}}">
                                    @error('ten_san_pham')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Mã Sản Phẩm</label>
                                    <input type="text" id="simpleinput" class="form-control" name="ma_san_pham"
                                        value="{{$listSanPham -> ma_san_pham}}">
                                    @error('ma_san_pham')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Tên Danh Mục</label>
                                    <select class="form-select" id="example-select" name="danh_muc_id">
                                        @foreach($listDanhMuc as $DanhMuc)
                                        <option value="{{ $DanhMuc->id }}"
                                            {{$listSanPham -> danh_muc_id == $DanhMuc->id ? 'selected' : ''}}>
                                            {{ $DanhMuc->ten_danh_muc }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('danh_muc_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Giá Sản Phẩm</label>
                                    <input type="text" id="simpleinput" class="form-control" name="gia_san_pham"
                                        value="{{$listSanPham -> gia_san_pham}}">
                                    @error('gia_san_pham')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Giá Khuyến Mãi</label>
                                    <input type="text" id="simpleinput" class="form-control" name="gia_khuyen_mai"
                                        value="{{ empty($listSanPham->gia_khuyen_mai) ? 0 : $listSanPham->gia_khuyen_mai }}">
                                    @error('gia_khuyen_mai')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Số lượng</label>
                                    <input type="text" id="simpleinput" class="form-control" name="so_luong"
                                        value="{{$listSanPham -> so_luong}}">
                                    @error('so_luong')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Ngày Nhập</label>
                                    <input type="date" id="example-email" name="ngay_nhap" class="form-control"
                                        value="{{$listSanPham -> ngay_nhap}}">
                                    @error('ngay_nhap')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Hình Ảnh</label>
                                    <input type="file" class="form-control" name="hinh_anh" onchange="showImage(event)"
                                        value="{{$listSanPham -> hinh_anh}}">
                                    @error('hinh_anh')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <img id="image_san_pham" src="{{ Storage::url($listSanPham->hinh_anh) }}"
                                    alt="Hình ảnh sản phẩm" style="width: 200px;">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="example-select" name="is_type">
                                        <option value="" selected> {{$listSanPham -> is_type == 1 ? 'Hiển Thị' : 'Ẩn'}}
                                        </option>
                                        <option value="0">Ẩn</option>

                                        <option value="1">Hiển Thị</option>
                                    </select>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text">Mô Tả Ngắn</span>
                                    <textarea class="form-control" aria-label="Với vùng văn bản"
                                        name="mo_ta_ngan"> {{$listSanPham -> mo_ta_ngan}}</textarea>
                                    @error('mo_ta_ngan')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="simpleinput" class="form-label">Tùy Chỉnh Khác</label>
                                <div class="form-switch mb-2 d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_new" name="is_new"
                                            {{$listSanPham -> is_type == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="is_new">New</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_hot" name="is_hot"
                                            {{$listSanPham -> is_hot == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="is_hot">Hot</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_hot_deal"
                                            name="is_hot_deal" {{$listSanPham -> is_hot_deal == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="is_hot_deal">Hot Deal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_show_home"
                                            name="is_show_home" {{$listSanPham -> is_show_home == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="is_show_home">Show Home</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success rounded-pill">Thêm</button>

                            </div>
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="example-disable" class="form-label">Mô Tả Chi Tiết Sản Phẩm</label>
                                    <div id="quill-editor" style="height: 400px;">
                                        <h1>Mô Tả Chi Tiết</h1>
                                    </div>
                                    <textarea name="noi_dung" id="noi_dung_content" class="d-none"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="example-disable" class="form-label">Album Ảnh</label>
                                    <i id="add-row" class="mdi mdi-plus text-muted fs-18 rounded-2 border ms-3 p-1"
                                        style="cursor: pointer"></i>
                                    <table class="table align-middle table-nowrap mb-0">


                                        <tbody id="image-table-body">
                                            @foreach($listSanPham->hinhAnhSanPham as $index => $item)
                                            <tr>
                                                <td class="d-flex align-items-center">
                                                    <img id="preview_{{$index}}"
                                                    src="{{ Storage::url($item->hinh_anh)}}"
                                                        alt="Hình ảnh sản phẩm" style="width:50px;" class="me-3">
                                                    <input type="file" class="form-control" name="list_hinh_anh[{{$item->id}}]" id="hinh_anh"
                                                        onchange="previewImage(this,$index)">
                                                        <input type="hidden" name="list_hinh_anh[{{$item->id}}]" value="{{$item->id}}">
                                                <td>
                                                    <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                                                        style="cursor: pointer" onclick="removeRow(this)"></i>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/admin/libs/quill/quill.core.js') }}"></script>
<script src="{{ asset('assets/admin/libs/quill/quill.min.js') }}"></script>
<script>
function showImage(event) {
    const image_san_pham = document.getElementById('image_san_pham');
    const file = event.target.files[0];
    const render = new FileReader();

    render.onload = function() {
        image_san_pham.src = render.result;
        image_san_pham.style.display = 'block';
    }

    if (file) {
        render.readAsDataURL(file);
    }
}
</script>

<!-- phần mô tả -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var quill = new Quill("#quill-editor", {
        theme: "snow"
    });

    // Hiển thị lại nội dung cũ
    var old_content = `{!! $listSanPham->noi_dung !!}`;
    quill.root.innerHTML = old_content;
    // cập nhật
    quill.on('text-change', function() {
        var HTML = quill.root.innerHTML;
        document.getElementById('noi_dung_content').value = HTML;
    })
});
</script>

<!-- phần album ảnh -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var rowCount = {{count($listSanPham->hinhAnhSanPham)}};
    var tableBody = document.getElementById('image-table-body');
    document.getElementById('add-row').addEventListener('click', function() {
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td class="d-flex align-items-center">
            <img id="preview_${rowCount}"
                src="https://i.fbcd.co/products/resized/resized-750-500/563d0201e4359c2e890569e254ea14790eb370b71d08b6de5052511cc0352313.jpg"
                alt="Hình ảnh sản phẩm" style="width:50px;" class="me-3">
            <input type="file" class="form-control" name="list_hinh_anh[id_${rowCount}]"
                onchange="previewImage(this,${rowCount})">
            <td>
                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                    style="cursor: pointer" onclick="removeRow(this)"></i>
            </td>
        </td>`;
        tableBody.appendChild(newRow);
        rowCount++;
    });
});

function previewImage(input, rowIndex) {
    if (input.files && input.files[0]) {
        const render = new FileReader();
        render.onload = function(e) {
            document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result);
        }
        render.readAsDataURL(input.files[0]);
    }
}

function removeRow(element) {
    element.closest('tr').remove();
}
</script>
@endsection
