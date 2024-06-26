@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Thêm bản đồ mới 
            </h4>
            <div class="row">
                <div class="col-md-12">
                
                </div>
            </div>
            <div class="row"> <!-- khung tìm kiếm -->
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên quyền</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforPermission->name}}" id="name" placeholder="Tên Quyền" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Khóa</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="is_block" placeholder="Khóa"  type="checkbox"  {{ $inforPermission->is_block ? 'checked' : '' }}>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Mã Code Quyền</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforPermission->code}}" id="code" placeholder="Mã Code Quyền" type="text">
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
                        <a href="#" class="btn btn-info btn-sm" id="updatePermission">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Cập nhật</span>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" id="deletePermission">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Xóa</span>
                        </a>
                        <a href="{{route('index.systemgeo')}}" class="btn btn-primary btn-sm" id="">
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
    $("#deletePermission").click(function(){
        let systemGeoId = "{{ $inforPermission->id }}";
        let editUrl = '{{ route("delete.permission", ":id") }}';
            editUrl = editUrl.replace(':id', systemGeoId);
        if(confirm('bạn có chắc muốn xóa máy chủ này, nếu xóa máy chủ này có thể toàn bộ bản đồ sẽ bị xóa!!'))
        {
            $.ajax({
                type: 'PUT',
                url: editUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    // console.log(response);
                    if(response.success==1)
                    {
                        Swal.fire(
                            'Thông báo',
                            'Cập nhật quyền thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                // Run your function here
                                window.location.href ='{{route("index.permission")}}';
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
                    // console.log(response);
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
    $('#updatePermission').click(function(){
        let name=$('#name').val();
        let is_block=$('#is_block').is(":checked");
        let code=$('#code').val();
        let categoryID = "{{ $inforPermission->id }}";
        let editUrl = '{{ route("update.permission", ":id") }}';
            editUrl = editUrl.replace(':id', categoryID);
        let backUrl = '{{ route("edit.permission", ":id") }}';
            backUrl = backUrl.replace(':id', categoryID);
        if(confirm('Bạn có muốn cập nhật'))
        {
            if(name==""||code==""){
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
                        name:name,
                        is_block:is_block,
                        code:code,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                    },
                    success: function(response) {
                        if(response.success=1)
                        {
                            Swal.fire(
                                'Thông báo',
                                'Cập nhật quyền thành công',
                                'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    // Run your function here
                                    window.location.href = backUrl;
                                }
                            });     
                        }else {
                            Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            );  
                            // alert("đã có lỗi vui long kiểm tra lại");
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