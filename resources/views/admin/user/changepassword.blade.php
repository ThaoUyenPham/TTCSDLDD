@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Thêm người dùng mới
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif -->
                </div>
            </div>
            <div class="row"> <!-- khung tìm kiếm -->
                <div class="col-md-12">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Mật khẩu hiện tại</b>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control input-sm" value="" id="currentPassword" placeholder="Nhập mật khẩu hiện tại" type="password">
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-12">
                    <form class="form-horizontal pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Mật khẩu mới</b>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control input-sm" value="" id="newPassword" placeholder="Nhập mật khẩu mới " type="password">
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-12">
                    <form class="form-horizontal pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Nhập lại mật khẩu mới</b>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control input-sm" value="" id="againPassword" placeholder="Nhập lại mật khẩu mới" type="password">
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm" id="changePassword">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>thay đổi mật khẩu</span>
                        </a>
                        <a href="{{route('admin')}}" class="btn btn-primary btn-sm" id="">
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
    $("#changePassword").click(function(){
        if(confirm("bạn có chắc muốn thay đổi mật khẩu không"))
        {
            let againPassword=$('#againPassword').val();
            let newPassword=$('#newPassword').val();
            let currentPassword=$('#currentPassword').val();
            
            if(againPassword.length >1)
            {
                if(againPassword==newPassword)
                {
                    $.ajax({
                        type:'PUT',
                        url:'{{route("change.password.admin")}}',
                        data:{
                            currentPassword:currentPassword,
                            newPassword:newPassword,
                            } ,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
                        //  dataType: "json",
                        success:function(response){
                            // console.log(response);
                            if(response.success==1)
                            {
                                Swal.fire(
                                    'Thông báo về việc thay đổi mật khẩu',
                                    'Thay đổi mật khẩu thành công',
                                    'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        // Run your function here
                                        window.location.href = "{{route('admin')}}";
                                    }
                                });         
                            }else if(response.success==3){ 
                                Swal.fire(
                                    'Thông báo về việc thay đổi mật khẩu',
                                    'Nhập mật khẩu cũ không đúng',
                                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                );
                            }else{
                                Swal.fire(
                                    'Thông báo về việc thay đổi mật khẩu',
                                    'Thay đổi mật khẩu không thành công',
                                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                );
                            }
                        // console.log(response);
                        },
                        error: function(data){
                            console.log(data.responseText);
                            Swal.fire(
                                    'Thông báo',
                                    'Thay đổi mật khẩu thành công thành công',
                                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                );
                        }
                    });
                }else{
                    Swal.fire(
                    'Thông báo',
                    'Nhập lại mật khẩu không đúng',
                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                );
                }
            }else{
                Swal.fire(
                    'Thông báo',
                    'Nhập mật khẩu quá ngắn',
                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                );
            }
        }
    });
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")