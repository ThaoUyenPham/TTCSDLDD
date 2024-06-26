@extends("admin.layouts.app")

@section("content")
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

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
                Danh sách Danh mục
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
                                <b>Danh mục cha</b>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control input-sm" id="choose_category">
                                    <option value="">-- Chọn Danh Mục Cha -- </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <b>Tìm tên</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="find_name" placeholder="Nhập tên tìm kiếm" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm  text-right" id="search_data" >
                            <i class="ti-search pdd-right-5"></i>
                            <span title="Tìm kiếm điểm quan trắc">Tìm kiếm</span>
                        </a>
                    </div>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------------------->
            <div class="row"> <!-- bảng data -->
                <div class="col-md-12">        
                    <table id="load_list_category" class="display table table-bordered" style="width:100%"> 
                        <thead>
                            <tr>
                                <th style="text-align:center">Id</th>
                                <th style="text-align:center"></th> 
                                <th style="text-align:center">STT</th>
                                <th style="text-align:center">Tên</th>  
                                <th style="text-align:center">Khoá</th>
                                <th style="text-align:center">Loại danh mục</th>
                                <th style="text-align:center">Danh mục cha</th>
                                <th style="text-align:center">code</th>
                                <th style="text-align:center">Sớ thứ tự</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="{{route('create.category')}}" class="btn btn-info btn-sm" id="">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Thêm mới</span>
                        </a>
                        <!-- <a href="#" class="btn btn-danger btn-sm" id="detele_category">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Xóa</span>
                        </a> -->
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<script>
  
   $(document).ready(function() {
    $.noConflict();
    let columns = [ //gán giá trị cho từng cột
        {  
            data: null,
            render: function (data, type, row) {
                let idcategory = '';
                if(row.id != null){
                    idcategory = row.id;
                }
                return idcategory;
            },
            visible: false , 
        },
        {   
            data: null,
            // sClass: "text-center action",
            render:function(){
                return null;
            }
            , width: '5%',
        },
        {   
            data: null,
            sClass: "text-center action",
            visible: true ,
            width: '5%',        
        },
        {  
            data: null,
            render: function (data, type, row) {
                let name = '';
                if(row.name != null){
                    name = row.name;
                }
                let id = '';
                if(row.id != null){
                    id = row.id;
                }
                let editUrl = '{{ route("edit.category", ":id") }}';
                editUrl = editUrl.replace(':id', id);
                return '<a href="'+editUrl+'">'+ name +'</a>';
            },
            sClass: "text-center",
            width: '20%',
        },
        { 
            data: null,
            render: function (data, type, row) {
                let block = '';
                if(row.is_block != null){
                    if(row.is_block==true)
                    {
                        block='<a style="color:red">Khóa</a>';
                    }else{
                        block='<a style="color:green">Hoạt động</a>';
                    }
                }
                return block;
            },
            sClass: "text-center",
            width: '20%',
        },
        { 
            data: null,
            render: function (data, type, row) {
                let level = '';
                if(row.level != null){
                    if(row.level==1)
                    {
                        level='<a style="color:red">Danh mục cha</a>';
                    }else{
                        level='<a style="color:green">Danh mục con</a>';
                    }
                }
                return level;
            },
            sClass: "text-center",
            width: '10%',
        },
        { 
            data: null,
            render: function (data, type, row) {
                let parent_name = '';
                if(row.parent_name != null){
                    parent_name=row.parent_name;
                }
                return parent_name;
            },
            sClass: "text-center",
            width: '20%',
        },
        { 
            data: null,
            render: function (data, type, row) {
                let code = '';
                if(row.code != null){
                    code=row.code;
                }
                return code;
            },
            sClass: "text-center",
            width: '10%',
        },
        { 
            data: null,
            render: function (data, type, row) {
                let number_oder = '';
                if(row.number_oder != null){
                    number_oder=row.number_oder;
                }
                return number_oder;
            },
            sClass: "text-center",
            width: '5%',
        },
    ];
    var table=$('#load_list_category').DataTable({
        
    });
    let text;
  
    $("#search_data").click(()=>{
        // console.log(table.destroy());
        LoadListCategory();
    })
   
    LoadListCategory();
    function LoadListCategory() {

        let  choose_category=$('#choose_category').val();
        let find_name=$('#find_name').val();
        if ($.fn.dataTable.isDataTable('#load_list_category')) {

            text = "Danh sach Diem";
            table.destroy();
            table = $('#load_list_category').DataTable({
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
                    url:"{{route('load.category')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                    },
                    data:{
                        "choose_category": choose_category, 
                        "find_name": find_name,
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
                initComplete: function(settings, json) {
                    var api = this.api();
                    api.column(2).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                } , 
                "language": {
                    "info": "Danh sách từ  _START_ đến _END_ của tổng _TOTAL_ ",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)"
                }
            })
            console.log(table);
        }
    }    
});
</script>

<!-- <script src="{{asset('assets\admin\setmap\index.js')}}"></script> -->
@endsection("content")