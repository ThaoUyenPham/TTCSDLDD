
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <!-- <meta http-equiv="refresh" content="900; url=logout.php"> -->
        <title>Quản lý điểm lấy mẫu</title>
        <script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>
       <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <!-- Favicon -->
    <!-- TEST-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- TEST-->
    <link rel="shortcut icon" href="assets/images/SoTNMT.ico">
    <!-- datatable -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nprogress/nprogress.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/DataTables/datatables.min.css')}}" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/icon_font-awesome/css/fontawesome.min.css')}}">
    <link href="{{asset('assets/vendor/icon_font-awesome/css/brands.min.css')}}" rel="stylesheet" />
     <link href="{{asset('assets/vendor/icon_font-awesome/css/solid.min.css')}}" rel="stylesheet" />
    <!-- Page Plugins CSS -->
    <!-- Core CSS -->
    <link href="assets/css/ei-icon.css" rel="stylesheet">
    <link href="{{URL::asset('assets/clients/css/themify-icons.css')}}" rel="stylesheet">
    <!-- <link href="{{URL::asset('assets/clients/css/font-awesome.min.css')}}" rel="stylesheet"> -->
    <link href="assets/fonts/icomoon/styles.min.css" rel="stylesheet">
    <link href="assets/fonts/glyphicon/glyphicon.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="{{URL::asset('assets/clients/css/app.css')}}" rel="stylesheet">
    <!-- Map CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('assest/vendor/jquery/jquery3.7.1.min.js')}}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <!-- <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('assets/vendor/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-4.3.1/dist/js/popper.min.js')}}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="{{asset('assets/vendor/bootstrap-4.3.1/dist/js/bootstrap.min.js')}}"  crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <link href="{{URL::asset('assets/map/js/leaflet/leaflet.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/leaflet.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/MarkerCluster.Default.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/leaflet.zoomhome.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/leaflet-gps.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/leaflet-sidebar.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/Control.FullScreen.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/L.Icon.Pulse.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/L.Control.Basemaps.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/Control.LatLng.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/map/css/leaflet-measure.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/vendor/introjs/introjs.min.css')}}" rel="stylesheet">
 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{URL::asset('assets/map/css/Control.Geocoder.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/vendor/chosen_v1.8.7/chosen.css')}}" rel="stylesheet"/>
    <script src="{{asset('assets/vendor/chosen_v1.8.7/chosen.jquery.min.js')}}"></script>
    <link href="{{URL::asset('assets/map/css/leaflet.groupedlayercontrol.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/map/css/mapStyle.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-4.3.1/dist/css/bootstrap.min.css')}}"  crossorigin="anonymous">
     <style>
        .leaflet-popup-content {
          width: 2000px;
        }
        .row2:nth-child(odd) {
        }

        /* Màu nền cho hàng 2 */
        .row2:nth-child(even) {
            background-color: #f0f0f0;
        }
     </style>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>
<body>

    <div id="north" class=" x-border-panel">
        <div class="header-content-map row" style="margin-left: 0;margin-right: 0;">
            <div class="col-3">
                <ul>
                    <li class="ctext" data-tippy-content="Reload">
                        <a href="">
                            <button class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i></button>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6" id="step3">
                <h4 id="nameMap">{{$subjectmap->name}}</h4>
                 <!-- <h4 >BẢN ĐỒ SƠ ĐỒ TỌA ĐỘ VÀ ĐỘ CAO TOÀN TỈNH</h4> -->
            </div>
            <div class="col-3">
                <ul class="right-header">
                    <li class="ctext" data-tippy-content="Quay về trang chủ">
                        <a href="{{route('home')}}">
                            <button class="btn btn-primary"><i class="fa-solid fa-house"></i> Quay về trang chủ</button>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="">
                            <button class="btn btn-secondary"><i class="fa-solid fa-angles-left"></i></button>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
    <div id="map" style="background:white">
        
    </div>
        <!-- Modal END -->  
        <!-- Content Wrapper START -->
        <!-- Content Wrapper END -->
        <!-- Side Panel For Map -->
    <div id="sidebar" class="leaflet-sidebar collapsed">
        <!-- nav tabs -->
        <div class="leaflet-sidebar-tabs">
            <!-- top aligned tabs -->
            <ul role="tablist"  >
                <li id="step1"  class="ctext" data-tippy-content="Chức năng tìm kiếm bản đồ">
                    <a href="#search" role="tab">
                        <i class="fa fa-search active"></i>
                    </a>
                </li>
                <li id="step2" class="ctext" data-tippy-content="Chức năng mở rộng bản đồ">
                    <a href="#autopan" role="tab">
                        <i class="fa fa-leanpub"  style="margin-left: -3px"></i>
                    </a>
                </li>
                <li>
                    <a href="#" role="tab">
                        <i class="	fa fa-home" id="test" style="margin-left: -3px"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- panel content -->
        <div class="leaflet-sidebar-content">
            <div class="leaflet-sidebar-pane" id="search">
                <h3 class="leaflet-sidebar-header">
                    <b class="font-size-14">Tìm Kiếm Bản đồ</b>
                </h3>
                <div class="row mrg-top-5" style="width: 77.5%">
                    <div class="col-md-12 no-pdd">
                        <div class="card">
                            <div class="card-block pdd-horizon-10 pdd-vertical-10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal">
                                            <div class="form-group row list-ctkt" >
                                                <label style="margin-top: 7px" class="col-md-12 control-label">
                                                    <b>Cấp bản đồ</b>
                                                </label>
                                                <div class="col-md-12">
                                                    <select class="form-control " name="level" id="level" data-placeholder="-- Lựa Chọn Cấp bản đồ--">
                                                        <option value="">-- Chọn cấp bản đồ --</option>
                                                        <option value="2">Cấp huyện Tiền Giang</option>
                                                        <option value="1">Cấp tỉnh Tiền Giang</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-12 control-label">
                                                    <b>Chọn khu vực</b>
                                                </label>
                                                <div class="col-md-12">
                                                    <select class="form-control " name="district"  id="district" 
                                                        data-placeholder="-- Lựa Chọn Huyện/Thị xã/Thành phố --">
                                                        <option value="">-- Lựa Chọn Huyện/Thị xã/Thành phố --</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}">{{$district->tenDVHC}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt" >
                                                <label style="margin-top: 7px" class="col-md-12 control-label">
                                                    <b>Danh mục bản đồ</b>
                                                </label>
                                                <div class="col-md-12">
                                                    <select class="form-control " name="category" id="category" data-placeholder="-- Lựa Chọn Danh Mục --">
                                                        <option value="">-- Chọn Danh Mục --</option>
                                                        @foreach($categoriesload as $category)
                                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                                                @if(count($category->children)>0)
                                                                        @foreach($category->children as $children)
                                                                            <option value="{{$children->id}}"  >--{{$children->name}}</option>    
                                                                        @endforeach
                                                                @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row list-ctkt" >
                                                <label style="margin-top: 7px" class="col-md-12 control-label">
                                                    <b>Năm</b>
                                                </label>
                                                <div class="col-md-12">
                                                    <select class="form-control input-sm" multiple id="year" name="year" data-placeholder="-- Lựa Chọn năm --"></select>
    
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-left no-pdd" id="result_found_point" >
                                                <span class="text-black font-size-16">Kết quả tìm kiếm điểm : </span>   
                                                <span class="text-black font-size-16" id="result_point">0</span>
                                            </div>
                                            <div class="col-md-12 text-right no-pdd">
                                                <a class="btn-xs btn btn-info no-mrg" id="searchMap">
                                                    <span class="text-white font-size-12">Tìm kiếm</span>
                                                </a>
                                            </div>
                                            <!-- Kết quả tìm kiếm -->
                                            <div class="form-group row list-ctkt no-mrg-btm">
                                                <div class="col-md-12 search-errorr mrg-top-10 mrg-left-55" style="display: none">
                                                    <i class="icon-alert font-size-12" style="margin-top: -1px"></i>
                                                    <span>Không tìm thấy trạm quan trắc</span>
                                                </div>
                                                <div class="col-md-12 search-successs mrg-top-10 mrg-left-55" style="display: none">
                                                    <i class="icon-check font-size-14" style="margin-top: -1px"></i>
                                                    <span id="success_alert"></span>
                                                </div>
                                            </div>
                                        </form>
                                        <form class="form-horizontal">
                                            <table id="listShowDataSearch">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center">Id</th>
                                                        <th style="text-align:center"></th>
                                                        <th style="text-align:center"></th>
                                                        <th style="text-align:center">Tên bản đồ</th>
                                                        <!-- <th style="text-align:center">năm</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="leaflet-sidebar-pane" id="autopan">
                <h3 class="leaflet-sidebar-header">
                    <b class="font-size-14">Chức năng bản đồ</b>
                    <div class="row mrg-top-5" style="width: 77.5%">
                        <div class="col-md-12 no-pdd">
                            <div class="card">
                                <div class="card-header pdd-vertical-5">
                                    <span class="font-size-14 text-center text-info text-bold">xem thông tin bản đồ</span>
                                </div>
                                <div class="card-block pdd-horizon-5 pdd-vertical-5">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label style="margin-top: 7px" class="col-md-12 control-label font-size-14 text-dark">
                                                <b>Xem thông tin lớp bản đồ</b>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <form class="form-horizontal">
                                                <div class="form-group row list-ctkt">
                                                    <input class="form-control"type="checkbox" name="" id="informationmap">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header pdd-vertical-5">
                                    <span class="font-size-14 text-center text-info text-bold">Chức năng Zoom theo huyện</span>
                                </div>
                                <div class="card-block pdd-horizon-5 pdd-vertical-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label style="margin-top: 7px" class="col-md-12 control-label font-size-14 text-dark">
                                                <b>Chọn huyện</b>
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- <form class="form-horizontal"> -->
                                                <!-- <div class="form-group row list-ctkt"> -->
                                                    <select class="form-control " name="district"  id="districtZoom" 
                                                        data-placeholder="-- Lựa Chọn Huyện/Thị xã/Thành phố --">
                                                        <option value="">--Lựa Chọn Huyện/Thị xã/Thành phố--</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}">{{$district->tenDVHC}}</option>
                                                        @endforeach
                                                    </select>
                                                <!-- </div> -->
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/vendor/proj4js_v2.6.0/proj4.js')}}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.0/proj4.js"></script> -->
        <!-- Side Panel START -->
        <!-- Side Panel END -->
    <script src="{{URL::asset('assets/map//js/map_function/config.js')}}"></script>
    <!-- Page Plugins JS -->

    <!-- Map JS -->
    <script src="{{URL::asset('assets/vendor/tippy/popper.min.js')}}"></script>
     <script src="{{URL::asset('assets/vendor/tippy/tippy-bundle.umd.min.js')}}"></script>

    <script src="{{URL::asset('assets/vendor/introjs/intro.min.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet.ajax.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet.markercluster.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet.zoomhome.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet-gps.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet-sidebar.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/Control.FullScreen.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/L.Icon.Pulse.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/L.Control.Basemaps.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/Leaflet.Control.Custom.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/Control.LatLng.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/rbush.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/labelgun.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/geojson-bbox.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet-measure.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/leaflet.groupedlayercontrol.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/Control.Geocoder.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/leaflet_plugin/L.Control.Button.js')}}"></script>
    <script src="{{asset('assets/vendor/nprogress/nprogress.js')}}"></script>
    <!-- Map JS Custom -->    
    <script src="{{URL::asset('assets/map/js/map_function/MapScriptOut.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/map_function/mapSide.js')}}"></script>
    <!-- <script src="assets_map/js/map_function/mapSearch.js"></script> -->
    <script src="{{URL::asset('assets/map/js/map_function/mapInfo.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/map_function/mapRanhThua.js')}}"></script>
    <script src="{{URL::asset('assets/map/js/map_function/mapInfo_RanhThua.js')}}"></script>
    <!-- Main JS Custom -->
    <!-- <script src="assets/js/app.js"></script> -->
    <!-- <script src="assets/js/forms/form-elements.js"></script> -->
    <style type="text/css">
    .dataTables_filter {
        display: none;
        }
    </style>
    <script> 
        $("#test").click(()=>{
            map.zoomOut ();
        });
        $("#districtZoom").change(function(e){
            // console.log($(this).val());
            if($(this).val()>0&&$(this).val()!="")
            {
                let editUrl = '{{route("load.district.client",":id") }}';
                editUrl = editUrl.replace(':id', $(this).val());
                $.ajax({
                    type: 'GET',
                    url: editUrl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                    },
                    success: function(response) {
                        // console.log(response);
                        if(response.data.valueY!=null)
                        {
                            map.flyTo([response.data.valueY, response.data.valueX],response.data.zoomm,{
                                animate: true,
                                duration: 2.0,
                                easeLinearity: 0.5, // Điều chỉnh tốc độ chuyển động
                                // noMoveStart: false// Thời gian chuyển động (giây)
                            });  
                            map.on('zoomend', ()=>{
                                map.setZoom( map.getZoom(), { animate: true });
                            });   
                        }                                            },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        console.error('Status: ' + status);
                        console.error('Error: ' + error);
                    }
                });
            }
        });
        function showTab(tabId) {
            var contents = document.querySelectorAll('.tab-content');
            contents.forEach(function(content) {
                content.classList.remove('active');
            });

            var activeTab = document.getElementById(tabId);
            if (activeTab) {
                activeTab.classList.add('active');
            }
        }
        $("#level").change(function(){
            if($(this).val()!=2)
            { 
                // $("#district_id").val("");
                $('#district').val('173');
                $("#district").attr('disabled', 'disabled');
            }
            else  $("#district").removeAttr('disabled');
        });
        var menuViewLayer=[];
        var overlayMaps=[];
        var viewLayerMaps=[]; 
        var inputLayerViewMap;
         $(document).ready(function() {
            const select2s = $('#year');
            const currentYear = new Date().getFullYear();
            const startYear = 2000; // Năm bắt đầu, bạn có thể thay đổi theo ý muốn
            for (let year = startYear; year <= currentYear; year++) {
                select2s.append(`<option value="${year}">${year}</option>`);
            }
            // $.noConflict();
            $("#year").chosen({max_selected_options: 5, width:'100%'});   
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
                    , width: '10%',
                },
                { //img
                    data: null,
                    render: function (data, type, row) {
                        let url= '';
                        if(row.thumbnail != null){
                            let editUrl = '{{ asset("storage/images/url") }}';
                            editUrl = editUrl.replace('url', row.thumbnail);
                            url='<img src="'+editUrl+'" width="50" height="20">';
                        }
                        return url;
                    },
                    sClass: "text-center"
                    , width: '20%',
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
                        let editUrl = '{{ route("map", ":id") }}';
                        editUrl = editUrl.replace(':id', id);
                        return '<a href="'+editUrl+'">'+ name +'</a>';
                    },
                    sClass: "text-center",
                    width: '50%',
                },
                // { 
                //     data: null,
                //     render: function (data, type, row) {
                //         let year = '';
                //         if(row.year != null){
                //             year=row.year;
                //         }
                //         return year;
                //     },
                //     sClass: "text-center",
                //     width: '10%',
                // },
            ];
            // let viewLayerMaps=[];  
            let idMap = ["{{ $subjectmap->id }}"];
            $.ajax({
                type: 'POST',
                url: '{{route("load.map.client")}}',
                data: {
                    id:idMap
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    // console.log(response);
                    inputLayerViewMap=response.data;
                    // console.log(inputLayerViewMap);
                    showLayerMap(inputLayerViewMap);
                    if (!sessionStorage.getItem('secondLoad')) {
                        sessionStorage.setItem('secondLoad', 'true');
                        startIntro();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error('Status: ' + status);
                    console.error('Error: ' + error);
                }
            });
            var table=$('#listShowDataSearch').DataTable({});
            let text;
            $("#searchMap").click(()=>{
                // console.log(table.destroy());
                loadListMap();
            })
            function loadListMap() {
                let district=$('#district').val();
                let category=$('#category').val();
                let level=$('#level').val();
                let year=$('#year').val();
                if ($.fn.dataTable.isDataTable('#listShowDataSearch')) {
                    text = "Danh sach Diem";
                    table.destroy();
                    table = $('#listShowDataSearch').DataTable({
                        searching: false,
                        lengthChange: false ,
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
                        ajax: {
                            url: '{{route("loadlist.map.client")}}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                            },
                            data:{
                                chooseDistrict:district,
                                findYear:year,
                                chooseCategory:category,
                                chooseLevel:level,
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
                            "infoEmpty": "danh sách từ 0 đến 0 của 0 danh sách",
                            "infoFiltered": "(filtered from _MAX_ total entries)"
                        }
                    })
                }
            } 
            table.on('select', function (e, dt, type, indexes) {
                if (type === 'row') {
                    let idArray=[];
                    let idarray=table.rows({selected: true}).data();
                   
                    for (let is = 0; is < idarray.length; is++) {
                        idArray.push(idarray[is]['id']);
                    }
                    if(idArray.length>0)
                    {
                        showClickMap(idArray,'{{route("load.map.client")}}');
                    }
                }
            });
            table.on('deselect', function (e, dt, type, indexes) {
                if (type === 'row') {
                    let idArray=[];
                    let idarray=table.rows({selected: true}).data();
                   
                    for (let is = 0; is < idarray.length; is++) {
                        idArray.push(idarray[is]['id']);
                    }
                    if(idArray.length>0)
                    {
                        showClickMap(idArray,'{{route("load.map.client")}}');
                    }
                }
            });
        });
        function showTableMap(latlng,map,tabMap)
        {
            L.popup({
                minWidth: 500 // Đặt chiều rộng tối thiểu của popup
            })
            .setLatLng(latlng)
            .setContent(sample_info(tabMap))
            .openOn(map);
            
            $(".nav-link").click(function(){
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
                var tabId = $(this).attr("href");
                $(".tab-pane").removeClass("show active");
                $(tabId).addClass("show active");
            });
        }
        $('#informationmap').change(function(){
            if($(this).is(":checked"))
            {

                map.on('click', onMapClick);
            }else{
                map.off('click', onMapClick);
            }
        });
        async function processAjax(map, viewLayerMap, latlng, e) {
            let responsedata = [];
            for (let j = 0; j < viewLayerMap.length; j++) {
                // console.log(viewLayerMap[j]);
                if(map.hasLayer(viewLayerMap[j].layer))
                {
                    const url = getFeatureInfoUrl(map, viewLayerMap[j].layer, latlng, {
                    'info_format': 'application/json',
                    // 'propertyName': 'ALL',
                    // 'propertyName': 'RED_BAND,GREEN_BAND,BLUE_BAND',
                    }, viewLayerMap[j].proj4text, e);
                    if (url) {
                        try {
                            let response = await $.ajax({
                                type: 'POST',
                                url: '{{route("convertCORS")}}',
                                data: {
                                    url: url
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                                }
                            });
                            if(response.error==1)
                            {
                                // Swal.fire(
                                //     'Thông báo',
                                //     'Vui lòng đăng nhập để thực hiện chức năng này',
                                //     'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                // )
                            }else{
                                if (response.data.length) {
                                    let dataInforMap = [];
                                    response.data.forEach(element => {
                                        dataInforMap.push(element.properties);
                                    });
                                    responsedata.push({ nameLayer: viewLayerMap[j].lable, data: dataInforMap });
                                }
                            }
                        } catch (error) {
                            // Swal.fire(
                            //     'Thông báo',
                            //     'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                            //     'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            // )
                            console.error('AJAX error:', error);
                        }
                    }
                }
            }
            return responsedata;
        }
        async function onMapClick(e) {
            NProgress.start();
            let latlng = e.latlng;
            let tabMap = [];

            try {
                // Making AJAX request
                let response = await $.ajax({
                    type: 'GET',
                    url: '{{ route("get.listpermission.client") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                console.log(response);

                if (response.error == 1) {
                    Swal.fire(
                        'Thông báo',
                        'Vui lòng đăng nhập để sử dụng chức năng này',
                        'warning'
                    );
                } else {
                    NProgress.start(); // Corrected to NProgress.start()
                    for (let i = 0; i < viewLayerMaps.length; i++) {
                        let layerMap = await processAjax(map, viewLayerMaps[i], latlng, e);
                        tabMap.push({
                            nameMap: inputLayerViewMap[i].name,
                            layer: layerMap
                        });
                    }
                    showTableMap(latlng, map, tabMap);
                }
            } catch (error) {
                Swal.fire(
                    'Thông báo',
                    'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                    'error'
                );
                console.error('Error:', error);
            } finally {
                NProgress.done();
            }
        }
        // async function onMapClick(e) {
        //     NProgress.start();
        //     let latlng = e.latlng;
        //     let tabMap = []
            
        //     $.ajax({
        //         type:'GET',
        //         url:'{{route("get.listpermission.client")}}',
        //         headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
        //         success:function(response){ 
        //             console.log(response);
        //             if(response.error==1)
        //             {
        //                 Swal.fire(
        //                     'Thông báo',
        //                     'Vui lòng đăng nhập để sử dụng chức năng này',
        //                     'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
        //                 );
        //             }else{
        //                 Progress.start();
        //                 for (let i = 0; i < viewLayerMaps.length; i++) {
        //                     let layerMap = await processAjax(map, viewLayerMaps[i], latlng, e);
        //                     tabMap.push({
        //                         nameMap: inputLayerViewMap[i].name,
        //                         layer: layerMap
        //                     });
        //                 }
        //                 showTableMap(latlng,map,tabMap);
        //                 NProgress.done();
        //             }
        //         },
        //         error: function(data){
        //             Swal.fire(
        //                 'Thông báo',
        //                 'Đã có lỗi xảy ra vui lòng kiểm tra lại',
        //                 'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
        //             );
        //             console.log(data.responseText);
        //         }
        //     });
        //     NProgress.done();
        // }
        function getFeatureInfoUrl(map, layer, latlng, params, proj4Def, e) {
            let point = map.latLngToContainerPoint(latlng, map.getZoom());
            let projectedPoint = proj4(proj4Def, [latlng.lng, latlng.lat]);
            let size = map.getSize();
            let bounds = map.getBounds();
            let nw = bounds.getNorthWest();
            let se = bounds.getSouthEast();
            let nwProjected = proj4(proj4Def, [nw.lng, nw.lat]);
            let seProjected = proj4(proj4Def, [se.lng, se.lat]);
            let bbox = [nwProjected[0], seProjected[1], seProjected[0], nwProjected[1]].join(',');

            const defaultParams = {
                request: 'GetFeatureInfo',
                service: 'WMS',
                srs: 'EPSG:327677',
                styles: '',
                version: layer._wmsVersion,
                format: layer.options.format,
                bbox: bbox,
                height: size.y,
                width: size.x,
                layers: layer.options.layers,
                query_layers: layer.options.layers,
                feature_count: 50,
            };

            params = L.extend(defaultParams, params || {});
            params[params.version === '1.3.0' ? 'i' : 'x'] = Math.floor(e.containerPoint.x);
            params[params.version === '1.3.0' ? 'j' : 'y'] = Math.floor(e.containerPoint.y);

            return layer._url + L.Util.getParamString(params, layer._url, true);
        }
        function startIntro(){
            var intro = introJs();
            intro.setOptions({
                steps: [
                    {
                        intro: "Xin chào! đây là hướng dẫn sử dụng phần mềm."
                    },
                    {
                        element: '#step1',
                        intro: "Phần chức năng tìm kiếm bản đồ khác.",
                        position: 'right'
                    },
                    {
                        element: '#step2',
                        intro: "Tại đây là chức năng mở rộng tìm kiếm bản đồ.",
                        position: 'left'
                    },
                    {
                        element: '#step3',
                        intro: "Đây là tên của bản đồ",
                        position: 'left'
                    },
                    {
                        element: document.querySelector('.leaflet-control-layers-overlays'),
                        intro: "Tại đây là chức năng tắt mở các lớp bản đồ",
                        position: 'left'
                    },
                    {
                        element: document.querySelector('.basemaps'),
                        intro: "Tại đây là chọn nền bản đồ",
                        position: 'left'
                    }
                ]
            });

            intro.start();
        }
        tippy('.ctext');
    </script>
    <!-- custom datatable  -->
  
 <!-- custom  -->
</body>

</html>
