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
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforContact->name}}" id="name" placeholder="tên người dùng" type="text" disabled>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Chi tiết phản hồi</b>
                            </label>
                            <div class="col-md-9">
                                <textarea name="" id="describe" style="width:100%; height:100px" disabled>{{$inforContact->describe}}</textarea>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Email</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforContact->email}}" id="email" placeholder="Nhập email" type="email" disabled>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt"> 
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên cơ quan tổ chức</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control input-sm" id="district" placeholder="Tên cơ quan tổ chức" value="{{$inforContact->district}}" disabled>
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
                        <a href="#" class="btn btn-danger btn-sm" id="deleteContact">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Xóa</span>
                        </a>
                        <a href="{{route('index.contact')}}" class="btn btn-primary btn-sm" id="">
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
    $("#deleteContact").click(function(){
        let contactId = "{{ $inforContact->id }}";
        let editUrl = '{{ route("delete.contact", ":id") }}';
            editUrl = editUrl.replace(':id', contactId);
        if(confirm('bạn có chắc muốn xóa góp ý này!!'))
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
                            'Xóa thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href ='{{route("index.contact")}}';
                            }
                        });
                       
                       
                    }else{
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra xin vui lòng kiểm tra lại!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );
                    }
                    // console.log(response);
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Thông báo',
                        'Đã có lỗi xảy ra xin vui lòng kiểm tra lại!',
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