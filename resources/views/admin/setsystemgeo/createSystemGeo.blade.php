@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Thêm máy chủ GeoServer 
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" id="errorslinkUrl" style="display:none">
                        <ul>
                            <li>Warring: Máy chủ GeoServer đã có trong hệ thống</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row"> <!-- khung tìm kiếm -->
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên máy chủ geo</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="name" placeholder="Tên Máy chủ" type="text">
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
                                <input class="form-control input-sm" value="" id="is_block" placeholder="Khóa" type="checkbox">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Địa chỉ máy chủ geo Https</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="linkurl" placeholder=" máy chủ geo Https" type="text">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Mặc định</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="default" placeholder="Khóa" type="checkbox">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Workspace</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control input-sm" id="workspace" placeholder="Name Workspace">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Thứ tự máy chủ</b>
                            </label>
                            <div class="col-md-3">
                                <input type="number" name="" class="form-control input-sm" id="number_oder" placeholder="">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Username</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control input-sm" id="username" placeholder="Username GeoServer">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Password</b>
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="" class="form-control input-sm" id="password" placeholder="Password GeoServer">
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
                        <a href="#" class="btn btn-info btn-sm" id="createSystemGeo">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Thêm mới</span>
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
    $('#createSystemGeo').click(function(){
        let name=$('#name').val();
        let is_block=$('#is_block').is(":checked");
        let linkUrl=$('#linkurl').val();
        let workspace=$("#workspace").val();
        let number_oder=$('#number_oder').val();
        let default2=$('#default').is(":checked");
        let username=$("#username").val();
        let password=$('#password').val();
        if(name==""||workspace==""||username==""||password==""||linkUrl==""){
            Swal.fire(
                'Thông báo',
                'Cảnh báo có mục không được để trống',
                'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
            );
        }else{ 
            $.ajax({
                type: 'POST',
                url: '{{route("save.systemgeo")}}',
                data: {
                    name:name,
                    is_block:is_block,
                    linkUrl:linkUrl,
                    number_oder:number_oder,
                    default:default2,
                    workspace:workspace,
                    username:username,
                    password:password
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
                                window.location.href = "{{URL::route('index.systemgeo')}}";
                            }
                        });     
                    }else {
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
    })
    $('#linkurl').focus(function(e){
        $.ajax({
            type: 'POST',
            url: '{{route("checkisset.systemgeo")}}',
            data: {
                linkUrl:$(this).val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
            },
            success: function(response) {
                // console.log(response);
                if(response.data==1)
                {
                    $('#errorslinkUrl').css('display', 'block');
                }else {
                    $('#errorslinkUrl').css('display', 'none');
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
    })
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")