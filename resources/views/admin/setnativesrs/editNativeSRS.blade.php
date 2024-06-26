@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Chi tiết Native SRS
            </h4>
            <div class="row">
                <div class="col-md-12">
                
                </div>
            </div>
            <div class="row"> <!-- khung tìm kiếm -->
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên Native SRS</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforNativeSRS->auth_name}}" id="auth_name" placeholder="Tên Danh mục" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>auth_srid</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforNativeSRS->auth_srid}}" id="auth_srid" placeholder="mã Native SRS number" type="number">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>srtext</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" value="{{$inforNativeSRS->srtext}}" class="form-control input-sm" id="srtext" placeholder="mã Srtext">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>proj4text</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" value="{{$inforNativeSRS->proj4text}}" class="form-control input-sm" id="proj4text" placeholder="mã Proj4text">
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-12">
                    
                 </div>
            </div> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm" id="updateNativeSRS">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Cập nhật</span>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" id="deleteNativeSRS">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Xóa</span>
                        </a>
                        <a href="{{route('index.nativesrs')}}" class="btn btn-primary btn-sm" id="">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Quay về</span>
                        </a>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#deleteNativeSRS").click(function(){
        let nativeSRSID = "{{ $inforNativeSRS->id }}";
        let editUrl = '{{ route("delete.nativesrs", ":id") }}';
            editUrl = editUrl.replace(':id', nativeSRSID);
        if(confirm('bạn có chắc muốn xóa native SRS này không?'))
        {
            $.ajax({
                type: 'DELETE',
                url: editUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    if(response.susess==1)
                    {
                        Swal.fire(
                            'Thông báo',
                            'Xóa dữ liệu thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                // Run your function here
                                window.location.href ='{{route("index.nativesrs")}}';
                            }
                        });     
                    }else{
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );  
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Thông báo',
                        'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                        'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                    );       
                    console.error(xhr.responseText);
                    console.error('Status: ' + status);
                    console.error('Error: ' + error);
                }
            });
        }
    });
    $('#updateNativeSRS').click(function(){

        let auth_name=$('#auth_name').val();
        let auth_srid=$('#auth_srid').val();
        let srtext=$('#srtext').val();
        let proj4text=$('#proj4text').val();
        let nativeSRS = "{{ $inforNativeSRS->id }}";
        let editUrl = '{{ route("update.nativesrs", ":id") }}';
            editUrl = editUrl.replace(':id', nativeSRS);
        if(confirm("Bạn có muốn cập nhật "))
        {
            if(auth_name==""||auth_srid==""||srtext==""||proj4text==""){
                Swal.fire(
                    'Thông báo',
                    'Cảnh báo có mục không được để trống',
                    'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                );
            }else{ 
                $.ajax({
                    type: 'PUT',
                    url: editUrl,
                    data: {
                        auth_name:auth_name,
                        auth_srid:auth_srid,
                        srtext:srtext,
                        proj4text:proj4text,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                    },
                    success: function(response) {
                        if(response.success=1)
                        {
                            Swal.fire(
                                'Thông báo',
                                'Thêm mới dữ liệu thành công',
                                'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    // Run your function here
                                    location.reload();
                                }
                            });       
                            // alert('Thêm thành công!');
                            // location.reload();
                            // window.location.href = backUrl;
                        }else {
                            Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            );       
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );       
                        console.error(xhr.responseText);
                        console.error('Status: ' + status);
                        console.error('Error: ' + error);
                    }
                }); 
            } 
        }
    })
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")