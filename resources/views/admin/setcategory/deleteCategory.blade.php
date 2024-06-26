@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Chi tiết danh mục
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
                                <b>Tên Danh mục</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{ $inforcategory->name }}" id="name" placeholder="Tên Danh mục" type="text"  >
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
                                <input class="form-control input-sm" value="" id="is_block" placeholder="Khóa" type="checkbox"  {{ $inforcategory->is_block ? 'checked' : '' }}>
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
                                <input type="number" name="" class="form-control input-sm" id="number" placeholder="" value="{{$inforcategory->number_oder}}">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Loại danh mục</b>
                            </label>
                            <div class="col-md-9">
                                <select name="" id="level" class="form-control input-sm" >
                                    <option value="1"  {{ $inforcategory->level == '1' ? 'selected' : '' }}>Danh mục cha</option>
                                    <option value="2" {{ $inforcategory->level == '2' ? 'selected' : '' }}>Danh mục con</option>
                                </select>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Code</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control input-sm" id="code" placeholder="" value="{{$inforcategory->code}}">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Danh mục cha(Nếu có)</b>
                            </label>
                            <div class="col-md-9">
                                <select name="" id="parent" class="form-control input-sm" disabled >
                                    <option value="null" {{$inforcategory->parent_id === 'null'?'selected':''}} > - - Chọn Danh mục cha - - </option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{$inforcategory->parent_id === $category->id?'selected':''}} >{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
                        <a href="#" class="btn btn-info btn-sm" id="deleteCategory">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Khôi Phục</span>
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
    $("#deleteCategory").click(function(){
        let categoryID = "{{ $inforcategory->id }}";
        let editUrl = '{{ route("restore.category.delete", ":id") }}';
            editUrl = editUrl.replace(':id', categoryID);
        if(confirm('bạn có chắc muốn khôi phục danh mục này'))
        {
            $.ajax({
                type: 'PUT',
                url: editUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    if(response.success==1)
                    {
                        
                        Swal.fire(
                            'Thông báo',
                            'Xóa thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href ='{{route("index.category")}}';
                            }
                        });
                    }else{
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Thông báo',
                        'Đã có lỗi xảy ra vui lòng kiểm tra lại',
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
@endsection("content")