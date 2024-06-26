@extends("admin.layouts.app")

@section("content")
<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/dataTables.fixedColumns.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/fixedColumns.dataTables.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/select.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script> -->
<link rel="stylesheet" href="{{asset('assets/vendor/DataTables/datatables.min.css')}}" />
<script src="{{asset('assets/vendor/DataTables/datatables.min.js')}}"></script>
<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Cập nhật bản đồ chuyên đề
            </h4>
            <form id="updateMap" enctype="multipart/form-data" >
                <div class="row"> <!-- khung tìm kiếm -->
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-5 control-label">
                                    <b>Tải bản hình nền bản đồ</b>
                                </label>
                                <div class="col-md-7">
                                    <input type="file" name="image" >
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Cấp</b>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control input-sm" name="level">
                                        <option value="1" {{ $inforSubjectMap->level == '1' ? 'selected' : '' }}> Cấp tỉnh</option>
                                        <option value="2"{{ $inforSubjectMap->level == '2' ? 'selected' : '' }}  >Cấp huyện</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Huyện/Thị xã/Thành phố</b>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control input-sm" name="district_id">
                                        <option value="null" selected>-- Vui lòng chọn huyện/xã/thị trấn --</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{$inforSubjectMap->district_id === $district->id?'selected':''}} >{{ $district->tenDVHC }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Tên bản đồ</b>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" value="{{ $inforSubjectMap->name }}" name="name"  placeholder="Tên bản đồ" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Năm</b>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control input-sm" id="yearSelect" name="year">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Danh mục bản đồ</b>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control input-sm" name="category_id" >
                                        <option value="" selected>--Lựa chọn Danh mục bản đồ-- </option>  
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"  {{ $inforSubjectMap->category_id==$category->id ?'selected':''}} >{{$category->name}}</option>
                                                @if(count($category->children)>0)
                                                        @foreach($category->children as $children)
                                                            <option value="{{$children->id}}"  {{ $inforSubjectMap->category_id==$children->id ?'selected':''}} >--{{$children->name}}</option>    
                                                        @endforeach
                                                @endif
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Show hình</b>
                                </label>
                                <div class="col-md-8">
                                    <img src="{{asset('storage/images/')}}/{{$inforSubjectMap->thumbnail}}" width="100%" height="200px">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Tóm tắt bản đồ</b>
                                </label>
                                <div class="col-md-9">
                                    <textarea name="summary" id="editor2" cols="30" style="width:100%; height:200px">{{ $inforSubjectMap->summary }}</textarea>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                    <b>Mô tả bản đồ</b>
                                </label>
                                <div class="col-md-10">
                                    <textarea name="discription" id="editor" cols="30" rows="10"  style="width:100%, height:300px">{{$inforSubjectMap->discription}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
   
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                    <b>Khóa</b>
                                </label>
                                <div class="col-md-10">
                                    <input type="checkbox" class="form-control input-sm" name="is_block" placeholder="" {{ $inforSubjectMap->is_block ? 'checked' : '' }}>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Mức độ ưu tiên</b>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" value="{{$inforSubjectMap->number_oder}}" name="number_oder" placeholder="STT" type="number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Không thời hạn</b>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" id="indefinite" value="" placeholder="" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Bắt đầu ngay</b>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" value="" id="runnow" placeholder="" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Ngày xuất bản</b>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" value="{{$inforSubjectMap->active_date}}" id="active_date" name="active_date" placeholder="" type="datetime-local">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Ngày thu hồi</b>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" value="{{$inforSubjectMap->expri_date}}" name="expri_date"  id="expri_date" placeholder="" type="datetime-local">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-4 control-label">
                                    <b>Ghi chú</b>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" value="{{$inforSubjectMap->note}}" placeholder="BBox" name="note" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center" >
                            <h2 class="text-info">Máy chủ GeoServer</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-horizontal  pdd-right-30">
                            <div class="form-group row list-ctkt">
                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                    <b>Chọn máy chủ GeoServer bản đồ</b>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm" name="" id="getGeoServer">
                                        <option value="">-- Chọn máy chủ GeoServer --</option>
                                        @foreach($systemgeos as $systemgeo)
                                            <option value="{{ $systemgeo->id }}">{{ $systemgeo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-info btn-sm text-white" id="getLoadLayer" >
                                        <i class="ti-plus pdd-right-5"></i>
                                        <span>Lấy lớp bản đồ</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="container mt-4">
                                <h1>Danh sách lớp bản đồ</h1>
                            <table class="table mt-4" id="table_layer">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên Layer</th>
                                        <th scope="col">Native SRS</th>
                                        <th scope="col">Name layer</th>
                                        <th scope="col">default</th>
                                        <th scope="col">Nền</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="inputList">
                                    @foreach($listLayerMaps as $listLayerMap)
                                        <tr>
                                            <td>
                                                <input class="form-control input-sm" type="hidden" value="{{ $listLayerMap->id }}">
                                                <input class="form-control input-sm" type="text" value="{{ $listLayerMap->lable }}">
                                                <input class="form-control input-sm" type="hidden" value="{{ $listLayerMap->systemgeo_id }}">
                                            </td>
                                            <td>
                                                <select class="form-control input-sm"  >
                                                    <option value="" >Native SRS</option>   
                                                    @foreach($nativeSRS as $itemnativeSRS)
                                                        <option value="{{ $itemnativeSRS->id }}" {{$listLayerMap->nativesrs_id === $itemnativeSRS->id?'selected':''}}  >{{ $itemnativeSRS->auth_name }}</option>
                                                    @endforeach
                                                </select>
                                            <td><input class="form-control input-sm" type="text" value="{{ $listLayerMap->name }}" disabled></td>
                                            <td><input class="form-control input-sm" type="checkbox" {{$listLayerMap->default === true?'checked':''}} ></td>
                                            <td><input class="form-control input-sm" type="checkbox"{{$listLayerMap->is_nen === true?'checked':''}} ></td>
                                            
                                            <td>
                                                <a class="btn btn-warning btn-sm moveUp text-white">Up</a>
                                                <a class="btn btn-warning btn-sm moveDown text-white">Down</a>
                                                <a class="btn btn-danger btn-sm deleteInput text-white">Delete</a>
                                            </td>
                                        </tr>
                                       
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-ctkt text-right">
                            <input type="submit" class="btn btn-info btn-sm" value="Cập nhật"> 
                            <a href="#" class="btn btn-danger btn-sm" id="delete_map">
                                <i class="ti-plus pdd-right-5"></i>
                                <span>Xóa</span>
                            </a>
                            <a href="{{route('index.map')}}" class="btn btn- btn-sm btn-primary">
                                <i class="ti-plus pdd-right-5"></i>
                                <span>Quay Lại</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="myModal" class="modal2">
  <!-- Modal content -->
    <div class="modal-content2">
        <span class="close">&times;</span>
        <h1 class="header-top-content" >Danh sách lớp layer</h1>
        <div class="row">
            <div class="col-md-12">
                <table id="table_load_layer" style="width:100%;text-align: center;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="list-ctkt text-right">
                    <a href="#" class="btn btn- btn-sm btn-primary" id="chooseLayer">
                        <i class="ti-plus pdd-right-5"></i>
                        <span>Thêm</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.noConflict();
        const select = $('#yearSelect');
        const currentYear = new Date().getFullYear();
        const startYear = 2000; // Năm bắt đầu, bạn có thể thay đổi theo ý muốn
        const yearchoose='{{$inforSubjectMap->year}}';
        for (let year = startYear; year <= currentYear; year++) {
            // let selected = (year == yearchoose) ? 'selected' : '';
            select.append(`<option  value="${year}">${year}</option>`);
        }
        // Tự động chọn năm hiện tại
        select.val(yearchoose);
        $("#updateMap").submit(function(e){

            e.preventDefault();
            if(confirm("bạn có chắc muốn cập nhật không!"))
            {
                let subjectMapId = "{{ $inforSubjectMap->id }}";
                let editUrl = '{{ route("update.map",":id") }}';
                    editUrl = editUrl.replace(':id', subjectMapId);
                let thead=$('#table_layer tr').map(function(){
                    return [$(this).find('td input, td select').map(function(){
                        return $(this)
                    }).get()]
                }).get();
                let layer=[]
                for (let i = 1; i < thead.length; i++) {
                    layer[i-1]=[];
                    for (let j = 0; j < 7; j++) {
                        try {
                            if(j>4)
                            {
                                // console.log(thead[i][j][0].checked);
                                layer[i-1][j] = thead[i][j][0].checked;
                            }else{
                                layer[i-1][j] = thead[i][j][0].value;
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }           
                let formData = new FormData(this);
                formData.append('layer', JSON.stringify(layer));
                // console.log(formData);
                
                if($("#category_id").val()==""||$("#category_id").val()==""||$("#district_id").val()==""||$("#level")==""||layer.length==0){
                    Swal.fire(
                        'Thông báo',
                        'Cảnh báo tên không được để trống',
                        'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                    );
                }else{
                    $.ajax({
                        type:'POST',
                        url:editUrl,
                        data:formData,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
                        cache:false,
                        contentType: false,
                        processData: false,
                        //  dataType: "json",
                        success:function(response){
                            if(response.success==1)
                            {
                                Swal.fire(
                                    'Thông báo',
                                    'Cập nhật dữ liệu thành công',
                                    'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        // Run your function here
                                        location.reload();
                                    }
                                });         
                                // alert("cập nhật dữ liệu thành công");
                                // location.reload();
                            }else{
                                Swal.fire(
                                    'Thông báo',
                                    'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                );         
                                // alert("đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!");
                            }
                        // console.log(response);
                        },
                        error: function(data){
                            Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            );  
                            console.log(data.responseText);
                        }
                    });
                }
            }
        });
      // Add input
        $("#chooseLayer").click(function(){
            let selected_id=table.rows({selected: true}).data();
            if (selected_id.length == 0) {
                alert("Vui lòng chọn lớp cần thêm");
            } else {
                if (confirm("Bạn chắc chắn muốn thêm lớp này")) {
                    for (let bientu = 0; bientu < selected_id.length; bientu++) {
                        let row = $("<tr>");
                        let datainput= `
                                <td>  
                                    <input type="hidden" class="form-control input-sm" placeholder="" >
                                    <input type="text" class="form-control input-sm" placeholder="Tên Lớp hiển thị" > 
                                    <input type="hidden" value="`+$("#getGeoServer").val()+`">
                                </td>`;
                        let dataInputSRS= `<td>
                                    <select class="form-control input-sm" >
                                        <option value="null" selected>Select Native SRS</option>
                                        @foreach($nativeSRS as $itemNativeSRS)
                                            <option value="{{ $itemNativeSRS->id }}">{{ $itemNativeSRS->auth_name }}</option>
                                        @endforeach
                                    </select>
                            </td>`;
                        let dataCell = '<td><input type="text" value="'+selected_id[bientu].name+'" class="form-control input-sm" disabled>';
                        let actionCell = $('<td>');
                        actionCell.append($('<a class="btn btn-warning btn-sm moveUp text-white">Up</a>'));
                        actionCell.append($('<a class="btn btn-warning btn-sm moveDown text-white">Down</a>'));
                        actionCell.append($('<a class="btn btn-danger btn-sm deleteInput text-white">Delete</a>'));
                        row.append(datainput);
                        row.append(dataInputSRS);
                        row.append(dataCell);
                        row.append(actionCell);
                        $("#inputList").append(row);
                    }
                    $('#myModal').css('display','none');
                }else {
                    console.log("No rows deleted")
                }
            }

        });
        $("#indefinite").change(function(){
            if($(this).is(":checked"))
            {
                $('#expri_date').val("");
                $('#expri_date').attr('disabled', 'disabled');
            }
           else $('#expri_date').removeAttr('disabled');
        });
        $("#runnow").change(function(){
            if($(this).is(":checked"))
            { 
                $("#active_date").val("");
                $("#active_date").attr('disabled', 'disabled');
            }
            else $("#active_date").removeAttr('disabled');
        });
        function isEmptyOrWhitespace(str) {
            return str.trim().length === 0;
        }
        // Delete input
        $(document).on("click", ".deleteInput", function () {
            if(confirm("Bạn có chắc muốn xóa không"))
            {
                let remove=$(this).closest("tr");
                let id=$(this).closest("tr").find('td input')[0].value;
                console.log(id);
                if(!isEmptyOrWhitespace(id))
                {
                    $.ajax({
                        type:'PUT',
                        url:"{{route('delete.layermap')}}",
                        data:{id:id},
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                                },
                        success:function(data){
                            if(data.success==1)
                            {
                                remove.remove();
                                Swal.fire(
                                    'Thông báo',
                                    'Đã xóa thành công',
                                    'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                    ).then((result) => {
                                        if (result.isConfirmed) {
                                            // Run your function here
                                            remove.remove(); 
                                        }
                                    });       
                            }
                        },
                        error: function(data){
                            Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            );  
                            // alert("Đã có lỗi xảy ra! vui lòng kiểm tra lại hoặc liên hệ với nhà phát triển phần mềm");
                            console.log(data.responseText);
                        }
                    });
                }else{
                    Swal.fire(
                        'Thông báo',
                        'Đã xóa thành công',
                        'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            // Run your function here
                            remove.remove(); 
                        }
                    });  
                    // console.log(remove);
                    // remove.remove();
                }   
            }
        });

        // Move input up
        $(document).on("click", ".moveUp", function () {
            var row = $(this).closest("tr");
            row.insertBefore(row.prev());
        });

        // Move input down
        $(document).on("click", ".moveDown", function () {
            var row = $(this).closest("tr");
            row.insertAfter(row.next());
        });
        CKEDITOR.replace( 'editor',{
            language: 'en',         
        } );
        let table=$('#table_load_layer').DataTable({ });

        $("#getLoadLayer").click(function(){
            LoadListCategory();       
            $('#myModal').css('display','block');
        });
        $('#delete_map').click(function(){ 
            if(confirm("Bạn có chắc muốn xóa bản đồ này"))
            {
                let subjectMapId = "{{ $inforSubjectMap->id }}";
                let editUrl = '{{ route("delete.map",":id") }}';
                editUrl = editUrl.replace(':id', subjectMapId);
                $.ajax({
                    type:'PUT',
                    url:editUrl,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
                    success:function(response){
                        if(response.success==1)
                        {
                            Swal.fire(
                                'Thông báo',
                                'Xóa thành công',
                                'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    // Run your function here
                                    window.location.href = "{{route('index.map')}}";
                                }
                            });         
                        }else{
                            Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            );         
                        }
                    },
                    error: function(data){
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );  
                        console.log(data.responseText);
                    }
                });
            }
        });
        $('.close').click(function(){
            $('#myModal').css('display','none');
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target ==  $('#myModal')) {
                $('#myModal').css('display','none');
            }
        }
        let columns=[
            {  
                data: null,
                render:function(){
                    return null;
                }
                , width: '10%',
            },
            {   
                data: null,
                // sClass: "text-center action",
                render:function(){
                    return null;
                }
                , width: '10%',
            },
            { 
                data: null,
                render: function (data, type, row) {
                    let name= '';
                    if(row.name != null){
                        name=row.name;
                    }
                    return name;
                },
                sClass: "text-center"
                , width: '80%',
            }, 
        ];
        function LoadListCategory() {
            let id=$("#getGeoServer").val();
            if ($.fn.dataTable.isDataTable('#table_load_layer')) {
                text = "Danh sach hệ thống";
                table.destroy();
                table = $('#table_load_layer').DataTable({
                    columns: columns,
                    columnDefs: [   
                        {
                            formatter: "rowSelection",
                            titleFormatter: "rowSelection",
                            frozen: true,
                            hozAlign: "center",
                            headerSort: false,
                            orderable: false,
                            className: 'select-checkbox',
                            targets:   0,
                        },
                        {
                            "defaultContent": "",
                            "targets": "_all"
                        },
                    ],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    order: [[ 1, 'asc' ]],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy','print',
                        {
                            extend: "excelHtml5",
                            text: "Xuất Excel",
                            className: "btn-sm",
                            init: function (api, node, config) {
                                //$(node).removeClass("dt-button");
                            },
                            filename: function () {
                                var date_edition = moment().format("YYYY-MM-DD HH[h]mm");
                                return text + " (" + date_edition + ")" ;
                            },
                            sheetName: "sheet1",
                            title: text,
                            customize: function (xlsx) {
                                var sheet = xlsx.xl.worksheets["sheet1.xml"];
                                $("row c", sheet).attr("s", "25");
                                $("row:nth-child(2) c", sheet).attr("s", "47");
                                $('row c[r="A1"]', sheet).attr("s", "51");
                                var styleSheet = xlsx.xl["styles.xml"];
                                var tagName = styleSheet.getElementsByTagName("sz");
                                for (i = 0; i < tagName.length; i++) {
                                    tagName[i].setAttribute("val", "14");
                                }
                            },
                            exportOptions: {
                                columns: ':visible :not(.action)'
                            },
                            messageBottom: null
                        },
                        {
                            extend: "pdfHtml5",
                            text: "Xuất PDF",
                            className: "btn-sm",
                            orientation: "landscape",
                            title: text,
                            filename: function () {
                                var date_edition = moment().format("YYYY-MM-DD HH[h]mm");
                                //var selected_machine_name = fileNameExport;
                                return text + " (" + date_edition + ")" ;
                            },
                            customize: function (doc) {
                        
                            },
                            exportOptions: {
                                columns: ':visible :not(.action)'
                            },
                            messageBottom: null
                        }, 
                    ],
                    ajax: {
                        url: '{{route("loadgeoserver.map")}}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                        },
                        data:{
                            "id": id,
                        } ,
                        complete: function(xhr, responseText){
                            // console.log(xhr);
                        },
                        // success: function(response){
                        //     console.log(response);
                        // },
                        error: function (error) {
                            Swal.fire(
                                'Thông báo',
                                'Có lỗi xảy ra vui lòng kiểm tra lại',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            )
                            console.log(error.responseText);
                        },
                    },
                    "language": {
                        "info": "Danh sách từ  _START_ đến _END_ của tổng _TOTAL_ ",
                        "infoEmpty": "Showing 0 to 0 of 0 entries",
                        "infoFiltered": "(filtered from _MAX_ total entries)"
                    },
                });
                table.on('draw', function() {
                    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                        var cell = this.cell(rowIdx, 1).node();
                        try {
                            cell.innerHTML = rowIdx + 1;
                        } catch (error) {
                            
                        }
                    });
                });

                // Trigger the draw event to update the numbering on initial load
                table.draw();
            }
        } 
        CKEDITOR.instances['editor'].on('change', function() { 
            CKEDITOR.instances['editor'].updateElement(); 
        });
    });
    
</script>

@endsection("content")