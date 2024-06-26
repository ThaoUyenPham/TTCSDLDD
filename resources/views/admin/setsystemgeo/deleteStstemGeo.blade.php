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
                                <b>Tên máy chủ geo</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforSystemGeo->name}}" id="name" placeholder="Tên Máy chủ" type="text">
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
                                <input class="form-control input-sm" id="is_block" placeholder="Khóa" type="checkbox" {{ $inforSystemGeo->is_block ? 'checked' : '' }}>
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
                                <input class="form-control input-sm" value="{{$inforSystemGeo->linkurl}}" id="linkurl" placeholder=" máy chủ geo Https" type="text">
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
                                <input class="form-control input-sm" value="" id="default" placeholder="Khóa" type="checkbox" {{ $inforSystemGeo->default ? 'checked' : '' }}>
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
                                <input type="text" name="" class="form-control input-sm" id="workspace" placeholder="Name Workspace" value="{{$inforSystemGeo->workspace}}">
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
                                <input type="number" name="" class="form-control input-sm" id="number_oder" placeholder="" value="{{$inforSystemGeo->number_oder}}"> 
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
                                <input type="text" name="" class="form-control input-sm" id="username" placeholder="Username GeoServer" value="{{$inforSystemGeo->username}}">
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
                                <input type="password" name="" class="form-control input-sm" id="password" placeholder="Password GeoServer" value="">
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
                        <a href="#" class="btn btn-info btn-sm" id="deleteSystemGeo">
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
        </div>
    </div>
</div>
<script>
    $("#deleteSystemGeo").click(function(){
        let systemGeoId = "{{ $inforSystemGeo->id }}";
        let editUrl = '{{ route("restore.systemgeo.delete", ":id") }}';
            editUrl = editUrl.replace(':id', systemGeoId);
        if(confirm('Bạn có chắc muốn khôi phục máy chủ GeoServer này không?'))
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
                            'Khôi phục dữ liệu thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                // Run your function here
                                window.location.href ='{{route("index.delete.super")}}';
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
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")