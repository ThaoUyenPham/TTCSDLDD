@extends("clients.layouts.app")

@section("content")
<div class="container content-d">
    <div class="tab-content-map">
        <div class="row">
            <div class="col-md-9 table-showmap">
                <div class="header title-news-mini" style="margin-top:10px">
                    <h3>Thông tin tài khoản</h3>
                </div>               
                <div class="table-map">
                    <div class="wrapper_tabcontent background-imgae-show">
                        <div class="contentMapCategory ">
                            <div class="tabcontent2">
                                 <div class="row">
                                    <h2></h2> 
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Tên người dùng</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control input-sm" id="name" value="{{$inforUser->name}}"  placeholder="Tên người dùng"> 
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2></h2> 
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Username</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <span id=""class="form-control input-sm">{{$inforUser->username}}</span>
                                        
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2></h2> 
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Email</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="email" class="form-control input-sm" id="email" value="{{$inforUser->email}}"  placeholder="Địa chỉ email"> 
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2></h2> 
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Tổ chức danh nghiệp</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control input-sm" id="company" value="{{$inforUser->company}}"  placeholder="Tên tổ chức danh nghiệp"> 
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2></h2> 
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Số điện thoại</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control input-sm" id="phone" value="{{$inforUser->phone}}"  placeholder="Số điện thoại"> 
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2></h2>
                                    <div class="col-md-12">
                                        <div class="form-horizontal  pdd-right-30 ">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                
                                                </label>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-info" id="changeAccount">Thay đổi</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 box-list-mini"> 
                @include("clients.layouts.ads")
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
                        url:'{{route("change.account.client")}}',
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
                                        window.location.href = "{{route('home')}}";
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
    })
</script>
@endsection("content")