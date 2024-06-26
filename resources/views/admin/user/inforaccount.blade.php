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
                                <b>Tên Người dùng/Tổ chức</b>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control input-sm" value="{{$inforUser->name}}" id="name" placeholder="Nhâp người dùng/tổ chức" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Email của người dùng/tổ chức</b>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control input-sm" value="{{$inforUser->email}}" id="email" placeholder="Nhâp Email người dùng/tổ chức" type="email">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên cơ quan/công ty</b>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control input-sm" value="{{$inforUser->company}}" id="company" placeholder="Nhâp tên cơ quan/ công ty" type="text">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Số điện thoại</b>
                            </label>
                            <div class="col-md-4">
                                <input type="number" name="" value="{{$inforUser->phone}}" class="form-control input-sm" id="phone" placeholder="Số điện thoại">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên tài khoản đăng nhập</b>
                            </label>
                            <div class="col-md-4">
                                <span class="form-control input-sm">{{$inforUser->username}}</span>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>       
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm" id="changeAccount">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>
                                Thay đổi tài khoản
                            </span>
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
  $("#changeAccount").click(function(){
        if(confirm("Bạn muốn thay đổi tài khoản không"))
        {
            let email=$("#email").val();
            let phone=$("#phone").val();
            let name=$("#name").val();
            let company=$("#company").val();
            $.ajax({
                type:'PUT',
                url:'{{route("change.account.admin")}}',
                data:{
                    email:email,
                    phone:phone,
                    name:name,
                    company:company,
                    } ,
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
                //  dataType: "json",
                success:function(response){
                    // console.log(response);
                    if(response.success==1)
                    {
                        Swal.fire(
                            'Thông báo',
                            'Thay đổi thông tin tài khoản thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                // Run your function here
                                window.location.href = "{{route('admin')}}";
                            }
                        });  
                    }else{
                        Swal.fire(
                            'Thông báo',
                            'Thay đổi thông tin tài khoản không thành công!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );
                    }
                // console.log(response);
                },
                error: function(data){
                    console.log(data.responseText);
                    Swal.fire(
                            'Thông báo',
                            'Thay đổi thông tin tài khoản không thành công!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );
                }
            });
        }
    });
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")