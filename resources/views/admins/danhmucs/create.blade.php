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
                                                   <form action="{{route('admins.danhmucs.store')}}" method="post"
                                                       enctype="multipart/form-data">
                                                       @csrf
                                                       <div class="mb-3">
                                                           <label for="simpleinput" class="form-label">
                                                               Tên Danh Mục
                                                           </label>
                                                           <input type="text" id="simpleinput" class="form-control"
                                                               name="ten_danh_muc" @error('ten_danh_muc') is-invalid
                                                               @enderror>
                                                           @error('ten_danh_muc')
                                                           <div class="alert alert-danger">{{ $message }}</div>
                                                           @enderror
                                                       </div>
                                                       <div class="mb-3">
                                                           <label for="example-email" class="form-label">
                                                              Hình Ảnh
                                                           </label>
                                                           <table class="table align-middle table-nowrap mb-0">
                                                               <tbody>
                                                                   <tr class="d-flex align-items-center">
                                                                       <input type="file" class="form-control"
                                                                           name="hinh_anh" onchange="showImage(event)">
                                                                       <img id="image_san_pham" src=""
                                                                           alt="Hình ảnh sản phầm"
                                                                           style="width: 50px ;">
                                                                   </tr>
                                                               </tbody>


                                                           </table>


                                                       </div>



                                                       <div class="mb-3">
                                                           <label for="example-disable" class="form-label">
                                                               Trạng thái

                                                           </label>
                                                           <select class="form-select" id="example-select"
                                                               name="trang_thai">
                                                               <option value="0">

                                                                   Ẩn
                                                               </option>
                                                               <option value="1">
                                                                   Hiển Thị
                                                               </option>
                                                           </select>

                                                       </div>
                                                       <button type="submit"
                                                           class="btn btn-success rounded-pill">Thêm</button>
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
                   @endsection
