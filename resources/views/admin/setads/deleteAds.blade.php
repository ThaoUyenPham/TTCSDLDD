@extends("admin.layouts.app")

@section("content")   
<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Chi tiết Liên kết đã xóa 
            </h4>
            <form  id="uploadForm"   enctype="multipart/form-data">
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
                                    <b>Hình ảnh</b>
                                </label>
                                <div class="col-md-9">
                                    <img src='{{ asset("storage/images/")}}/{{$inforads->thumbnail}}' style="width:100px;height:100px" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Tên Liên kết</b>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" value="{{ $inforads->name }}" name="name" id="name" placeholder="Tên Liên kết" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Đường dẫn liên kết</b>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" name="link" id="link" placeholder="Đường dẫn liên kết" type="text" value="{{ $inforads->link}}"  >
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
                                    <input class="form-control input-sm" name="is_block" id="is_block" placeholder="Khóa" type="checkbox"  {{ $inforads->is_block ? 'checked' : '' }}>
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
                                    <input type="number" name="number" value="{{ $inforads->number_oder }}" class="form-control input-sm" id="number" placeholder="">
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
                                    <input type="text" name="code" value="{{ $inforads->code }}" class="form-control input-sm" id="code" placeholder="">
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-ctkt text-right">                                           
                            <a href="#" class="btn btn-info btn-sm" id="deleteAds">
                                <i class="ti-plus pdd-right-5"></i>
                                <span>Khôi phục</span>
                            </a>
                            <a href="{{route('index.delete.super')}}" class="btn btn-primary btn-sm" id="">
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
    $(document).ready(function() {
        $.noConflict();
    });
        //     document.querySelector("html").classList.add('js');

        // var fileInput  = document.querySelector( ".input-file" ),  
        //     button     = document.querySelector( ".input-file-trigger" ),
        //     the_return = document.querySelector(".file-return");
            
        // button.addEventListener( "keydown", function( event ) {  
        //     if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        //         fileInput.focus();  
        //     }  
        // });
        // button.addEventListener( "click", function( event ) {
        // fileInput.focus();
        // return false;
        // });  
        // fileInput.addEventListener( "change", function( event ) {  
        //     the_return.innerHTML = this.value;  
        // });  
     $("#deleteAds").click(function(){
        let AdsID = "{{ $inforads->id }}";
        let editUrl = '{{ route("delete.ads.admin", ":id") }}';
            editUrl = editUrl.replace(':id', AdsID);
        if(confirm('bạn có chắc muốn khôi phục liên kết này!'))
        {
            $.ajax({
                type: 'PUT',
                url: editUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    console.log(response);
                    if(response.success==1)
                    { 
                        Swal.fire(
                            'Thông báo',
                            'Khôi phục liên kết thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href ='{{route("index.delete.super")}}';
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
                }
            });
        }
    });
   
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")