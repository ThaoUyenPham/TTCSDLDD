@extends("admin.layouts.app")

@section("content")
<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Thêm liên kết mới 
            </h4>
            <form  id="uploadForm"  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>
                <div class="row"> <!-- khung tìm kiếm -->
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Tải hình ảnh</b>
                                </label>
                                <div class="col-md-9">
                                    <input class="input-file" name="image" id="my-file" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Tên liên kết</b>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" value="" name="name" id="name" placeholder="Tên liên kết" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Đường dẫn</b>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" name="link" id="link"  placeholder="Đường dẫn liên kết" type="text">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Khóa</b>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" name="is_block"  placeholder="Khóa" type="checkbox">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Số thứ tự hiển thị</b>
                                </label>
                                <div class="col-md-9">
                                    <input type="number" name="number" class="form-control input-sm" id="number" placeholder="">
                                </div> 
                            </div>
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Code</b>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="code" class="form-control input-sm" id="code" placeholder="">
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-ctkt text-right">
                            <a href="#"  id="create_category">
                                <i class="ti-plus pdd-right-5"></i>
                                <button  class="btn btn-success btn-sm" type="submit">Thêm mới</button>
                            </a>
                            <a href="{{route('index.ads.admin')}}" class="btn btn-primary btn-sm" id="">
                                <i class="ti-plus pdd-right-5"></i>
                                <span>Quay về</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

// document.querySelector("html").classList.add('js');

// var fileInput  = document.querySelector( ".input-file" ),  
//     button     = document.querySelector( ".input-file-trigger" ),
//     the_return = document.querySelector(".file-return");
      
// button.addEventListener( "keydown", function( event ) {  
//     if ( event.keyCode == 13 || event.keyCode == 32 ) {  
//         fileInput.focus();  
//     }  
// });
// button.addEventListener( "click", function( event ) {
//    fileInput.focus();
//    return false;
// });  
// fileInput.addEventListener( "change", function( event ) {  
//     the_return.innerHTML = this.value;  
// });   

    $(document).ready(function() {

        $('#uploadForm').on('submit', function(e) {
            let name=$("#name").val();
            let ulink=$("#link").val();
            e.preventDefault(); // Ngăn chặn hành động submit mặc định của for
            // Tạo đối tượng FormData từ form
            let formData = new FormData(this);
            // Thêm giá trị của các trường name và size vào formData
            // Gửi dữ liệu qua AJAX
            if(confirm("bạn có chắc muốn thêm"))
            {
                if(ulink==""||name=="")
                {
                    Swal.fire(
                        'Thông báo',
                        'Cảnh báo các mục nhập không được để trống ',
                        'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                    );
                }else {
                    $.ajax({
                        type:'POST',
                        url:"{{route('save.ads.admin')}}",
                        data:formData,
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                                },
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if(response.success==1)
                            {
                                
                                Swal.fire(
                                    'Thông báo',
                                    'Thêm mới liên kết thành công',
                                    'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href ='{{route("index.ads.admin")}}';
                                    }
                                });
                            }else{
                                Swal.fire(
                                    'Thông báo',
                                    'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                );
                                console.log(response);
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                    'Thông báo',
                                    'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                );
                            console.error(xhr.responseText);
                            console.error('Status: ' + status);
                            console.error('Error: ' + error);
                            // alert("đã có lỗi vui long kiểm tra lại");
                        }
                    });
                }   
            }
         
        });
        
    });

  
  
</script>
@endsection("content")