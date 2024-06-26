@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Thêm thông báo mới
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
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên thông báo</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="name" placeholder="Tên thông báo" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Thông tin hiển thị thông báo</b>
                            </label>
                            <div class="col-md-9">
                                <textarea name="" id="describe" style="width:100%; height:100px"></textarea>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Số thứ tự hiển thị</b>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="" class="form-control input-sm" id="number" placeholder="Thứ tự hiển thị">
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm" id="create_topads">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Thêm mới</span>
                        </a>
                        <a href="{{route('index.topads')}}" class="btn btn-primary btn-sm" id="">
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
    $('#create_topads').click(function(){
        let name=$('#name').val();
        let is_block=$('#is_block').is(":checked");
        let number=$('#number').val();
        let describe=$('#describe').val();    
        if(confirm("bạn có chắc muốn thêm"))
        {
            if(name==""||describe==""){
                Swal.fire(
                    'Thông báo',
                    'Cảnh báo có mục không được để trống',
                    'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                );
            }else{
                $.ajax({
                    type: 'POST',
                    url: '{{route("save.topads")}}',
                    data: {
                        name:name,
                        is_block:is_block,
                        number:number,
                        describe:describe,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                    },
                    success: function(response) {
                        if(response.success=1)
                        {
                            Swal.fire(
                                'Thông báo',
                                'Thêm mới Thông báo thành công',
                                'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    // Run your function here
                                    window.location.href = "{{URL::route('index.topads')}}";
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
        }
    })
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")