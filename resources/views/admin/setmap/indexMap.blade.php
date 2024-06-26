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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Danh sách bản đồ chuyên đề
            </h4>
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('errors'))
                        <div class="alert alert-danger">
                             {{ session('errors') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row"> <!-- khung tìm kiếm -->
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Huyện/Thị xã/Thành phố</b>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control input-sm" id="chooseDistrict">
                                    <option value="">-- Chọn huyện/ tỉnh bản đồ --</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->tenDVHC }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Năm</b>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control input-sm" id="yearSelect" name="year">
                                <option value="">-- Chọn Năm--</option>
                                </select>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Danh mục bản đồ</b>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control input-sm" id="chooseCategory">
                                    <option value="" selected>--Lựa chọn Danh mục bản đồ-- </option>  
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"  >{{$category->name}}</option>
                                                @if(count($category->children)>0)
                                                        @foreach($category->children as $children)
                                                            <option value="{{$children->id}}" >--{{$children->name}}</option>    
                                                        @endforeach
                                                @endif
                                        @endforeach 
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Cấp</b>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control input-sm" id="chooseLevel">
                                    <option value="" > -- Lựa chọn Cấp --</option> 
                                    <option value="1">Cấp tỉnh</option> 
                                    <option value="2">Cấp huyện</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tìm tên</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="findName" placeholder="Nhập tên tìm kiếm" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="form-group row list-ctkt">
                        <a href="#" class="btn btn-info btn-sm " id="search_map" style="margin-left:auto;margin-right:auto">
                            <i class="ti-search pdd-right-5"></i>
                            <span title="Tìm kiếm điểm quan trắc">Tìm kiếm</span>
                        </a>
                    </div>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------------------->
            <div class="row"> <!-- bảng data -->
                <div class="col-md-12">        
                    <table id="load_data_map" class="display table table-bordered" style="width:100%"> 
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th></th> 
                                <th>STT</th>
                                <th>Image</th> 
                                <th>Xem bản đồ</th>  
                                <th>Tên bản đồ</th>
                                <th>Danh mục</th>
                                <th>Cấp</th>
                                <th>Năm</th>
                                <th>Khóa</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="{{route('create.map')}}" class="btn btn-info btn-sm">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Thêm mới</span>
                        </a>
                    </div>
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
        for (let year = startYear; year <= currentYear; year++) {
            select.append(`<option value="${year}">${year}</option>`);
        }
        // Tự động chọn năm hiện tại
        select.val('');
        let columns=[
            {  
                data: null,
                render:function(){
                    return null;
                }
                , width: '0%',
                visible: false , 
            },
            {   
                data: null,
                sClass: "text-center action",
                render:function(){
                    return null;
                }
                , width: '5%',
            },
            {   
                data: null,
                // sClass: "text-center action",
                render:function(){
                    return null;
                }
                , width: '5%',
            },
            { //img
                data: null,
                render: function (data, type, row) {
                    let url= '';
                    if(row.thumbnail != null){
                        let editUrl = '{{ asset("storage/images/url") }}';
                         editUrl = editUrl.replace('url', row.thumbnail);
                        url='<img src="'+editUrl+'" width="200" height="130">';
                    }
                    return url;
                },
                sClass: "text-center"
                , width: '20%',
            }, 
            { //xem van do 
                data: null,
                render: function (data, type, row) {
                    let name= '';
                    if(row.id != null){
                        let editUrl = '{{ route("map",":id") }}';
                        editUrl = editUrl.replace(':id', row.id);
                         name= '<a href="'+editUrl+'"><button class="btn-xs btn-outline-info"><i class="fa fa-map-marker font-size-30"></i></button></a>';
                    }
                    return name;
                },
                sClass: "text-center"
                , width: '5%',
            }, 
            { //ten ban do
                data: null,
                render: function (data, type, row) {
                    let name= '';
                    let id="";
                    if(row.id != null){
                        id=row.id;
                    }
                    if(row.name != null){
                        let editUrl = '{{ route("edit.map",":id") }}';
                        editUrl = editUrl.replace(':id', row.id);
                        name='<a href="'+editUrl+'">'+row.name+'</a>';
                    }
                    return name;
                },
                sClass: "text-center"
                , width: '20%',
            }, 
            { //danh muc
                data: null,
                render: function (data, type, row) {
                    let categoryname= '';
                    if(row.categoryname != null){
                        categoryname=row.categoryname;
                    }
                    return categoryname;
                },
                sClass: "text-center"
                , width: '20%',
            }, 
            { //cap
                data: null,
                render: function (data, type, row) {
                    let level= '';
                    if(row.level != null){
                        if(row.level==1)
                        {
                            level='<a style="color:green">Cấp tỉnh</a>';
                        }else{
                            level='<a style="color:green">cấp huyện</a>';
                        }
                    }else{
                        level='<a style="color:green">Cấp tỉnh</a>';
                    }
                    return level;
                },
                sClass: "text-center"
                , width: '10%',
            }, 
            { //nam
                data: null,
                render: function (data, type, row) {
                    let year= '';
                    if(row.year != null){
                        year=row.year;
                    }
                    return year;
                },
                sClass: "text-center"
                , width: '10%',
            },
            { //khoa
                data: null,
                render: function (data, type, row) {
                    let block= '';
                    if(row.is_block != null){
                        if(row.is_block==true)
                        {
                            block='<a style="color:red">Khóa</a>';
                        }else{
                            block='<a style="color:green">Hoạt động</a>';
                        }
                    }else{
                        block='<a style="color:green">Hoạt động</a>';
                    }
                    return block;
                },
                sClass: "text-center"
                , width: '10%',
            },
        ];
        let table=$('#load_data_map').DataTable({});
        LoadSubjectMap();
        function LoadSubjectMap() {
            let chooseDistrict=$("#chooseDistrict").val();
            let findYear=$("#yearSelect").val();
            let chooseCategory=$("#chooseCategory").val();
            let chooseLevel=$("#chooseLevel").val();
            let findName=$("#findName").val();
            if ($.fn.dataTable.isDataTable('#load_data_map')) {
                text = "Danh sach hệ thống";
                table.destroy();
                table = $('#load_data_map').DataTable({
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
                            targets:   1,
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
                        url: '{{route("load.map")}}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                        },
                        data:{
                            chooseDistrict:chooseDistrict,
                            findYear:findYear,
                            chooseCategory:chooseCategory,
                            chooseLevel:chooseLevel,
                            findName:findName
                        } ,
                        complete: function(xhr, responseText){
                            // console.log(xhr);
                        },
                        // success: function(response){
                        //     console.log(response);
                        // },
                        error: function (error) {
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
                        var cell = this.cell(rowIdx, 2).node();
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
        $("#search_map").click(function(){
            LoadSubjectMap();
        });
    });

</script>
<!-- <script src="{{asset('assets\admin\setmap\index.js')}}"></script> -->
@endsection("content")