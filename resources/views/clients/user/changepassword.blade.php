@extends("clients.layouts.app")

@section("content")
<div class="container content-d">
    <div class="tab-content-map">
        <div class="row">
            <div class="col-md-9 table-showmap">
                <div class="header title-news-mini" style="margin-top:10px">
                    <h3>Thay đổi mật khẩu </h3>
                </div>               
                <div class="table-map">
                    <div class="wrapper_tabcontent background-imgae-show">
                        <div class="contentMapCategory ">
                            <div class="tabcontent2">
                                <div class="row">
                                    <h2></h2>
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30 ">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Mật khẩu hiện tại</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="password" class="form-control input-sm" id="passwordOld"  placeholder="Nhập mật khẩu hiện tại"> 
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
                                                    <b>Mật khẩu mới</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="password" class="form-control input-sm" id="newPassword"  placeholder="Nhập mật khẩu mới"> 
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2></h2>
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30 ">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Nhập lại mật khẩu mới</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="password" class="form-control input-sm" id="againPassword"  placeholder="Nhập lại mật khẩu mới"> 
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
                                                    <button type="button" class="btn btn-info" id="changePassword">Thay đổi</button>
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
    $("#changePassword").click(function(){
        if(confirm("bạn có chắc muốn thay đổi mật khẩu không"))
        {
            let againPassword=$('#againPassword').val();
            let newPassword=$('#newPassword').val();
            let currentPassword=$('#passwordOld').val();
            
            if(againPassword.length >1)
            {
                if(againPassword==newPassword)
                {
                    $.ajax({
                        type:'PUT',
                        url:'{{route("change.password.client")}}',
                        data:{
                            currentPassword:currentPassword,
                            newPassword:newPassword,
                            } ,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
                        //  dataType: "json",
                        success:function(response){
                            console.log(response);
                            if(response.success==1)
                            {
                                Swal.fire(
                                    'Thông báo về việc thay đổi mật khẩu',
                                    'Thay đổi mật khẩu thành công',
                                    'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{route('home')}}";
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
    })
</script>
@endsection("content")