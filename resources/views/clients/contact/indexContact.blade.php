@extends("clients.layouts.app")

@section("content")
<div class="container content-d">
    <div class="tab-content-map">
        <div class="row">
            <div class="col-md-9 table-showmap">
                <div class="header title-news-mini" style="margin-top:10px">
                    <h3>Liên hệ phản hồi đánh giá</h3>
                </div>  
              
                <div class="table-map">
                    <div class="wrapper_tabcontent background-imgae-show">
                        <div class="contentMapCategory">
                            <div class="tabcontent2 " >
                                <div class="row">
                                    <h2></h2> 
                                    <div class="col-md-12">
                                        <form class="form-horizontal  pdd-right-30">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Tiêu đề</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control input-sm" id="title" value=""  placeholder="Tiêu đề"> 
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
                                                    <input type="email" class="form-control input-sm" id="email" value="" placeholder="Email "> 
                                        
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
                                                    <b>Tên Người gửi</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control input-sm" id="name" value=""  placeholder="Tên người gửi"> 
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
                                                    <b>Địa chỉ/Cơ quan tổ chức</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control input-sm" id="district" value=""  placeholder="Địa chỉ cơ quan tổ chức"> 
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
                                                    <b>Chi tiết nội dung</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <textarea name="" class="form-control input-sm" id="describe" style="width:100%;height:100px;"  placeholder="Chi tiết nội dung"></textarea>
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
                                                    <button type="button" class="btn btn-info" id="sendContact">Gửi phản hồi</button>
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
    $("#sendContact").click(function(){
        if(confirm("Bạn muốn thay đổi tài khoản không"))
        {
            let title=$("#title").val();
            let email=$("#email").val();
            let describe=$("#describe").val();
            let name=$("#name").val();
            let district=$("#district").val();
            $.ajax({
                type:'POST',
                url:'{{route("save.contact.client")}}',
                data:{
                    email:email,
                    title:title,
                    name:name,
                    describe:describe,
                    district:district
                    } ,
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
                //  dataType: "json",
                success:function(response){
                    // console.log(response);
                    if(response.success==1)
                    {
                        Swal.fire(
                            'Thông báo',
                            'Gửi thông tin thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{route('home')}}";
                            }
                        });  
                    }else{
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );
                    }
                // console.log(response);
                },
                error: function(data){
                    console.log(data.responseText);
                    Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );
                }
            });
        }
    })
</script>
@endsection("content")