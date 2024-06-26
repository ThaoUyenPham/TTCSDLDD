/*---- Control Base Map ----*/

var Basemaps_Control = [
    L.tileLayer('https://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}', {
        attribution: 'Ảnh vệ tinh Google',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Ảnh vệ tinh Google',
        iconURL: 'https://mt0.google.com/vt/lyrs=s&hl=en&x=101&y=60&z=7'
    }),
    
    // L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
    //     attribution: 'Simple Map ',
    //     subdomains: 'abcd',
    //     maxZoom: 20,
    //     minZoom: 0,
    //     label: 'Bản đồ đơn giản',
    //     /* optional label used for tooltip */
    //     iconURL: 'assets/images/b_tile.stamen.png'
    // }),

    L.tileLayer('https://mt1.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        attribution: 'Google Terrain',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ địa hình Google',
        iconURL: 'https://mt1.google.com/vt/lyrs=p&x=101&y=60&z=7'
    }),

    /* L.tileLayer('http://gis.chinhphu.vn/BaseMap/{z}/{x}/{y}.png', {
        attribution: 'Map tiles by gis.chinhphu.vn',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ hành chính',
        iconURL: 'assets/images/gis_chinhphu.png'
    }), */
    // L.tileLayer('https://{s}.dothanhlong.org/basemap/hanhchinh/zxy/t6/VBD/{z}/{x}/{y}.png', {
    //     attribution: 'Map tiles by Việt Bản đồ',
    //     subdomains: 'abcd',
    //     maxZoom: 20,
    //     minZoom: 0,
    //     label: 'Việt Bản đồ',
    //     /* iconURL: '../assets/img/map_thumb/Map_tiles_by_Việt_Bản_đồ.png' */
    //     iconURL: 'http://images.vietbando.com/ImageLoader/GetImage.ashx?Ver=2016&LayerIds=VBD&Level=7&X=101&Y=60'
    // }),

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Map tiles by Esri',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Ảnh vệ tinh ESRI',
        iconURL: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/7/60/101'
    }),
    L.tileLayer('nen.png', {
        // attribution: 'Map tiles by Esri',
        // subdomains: 'abcd',
        // maxZoom: 20,
        // minZoom: 0,
        label: 'Nền trắng',
        iconURL: 'nen.png'
    }),
]

/*---- Đem biến map ra ngoài cấu trúc nested của getJSON để không bị lỗi invalidateSize bên main.js ----*/
var map = L.map('map', {
    center: [10.411348991998135, 106.29704018005418],
    zoomDelta: 0.1,
    zoomSnap: 0,
    zoom: 1,
    maxZoom: 20,
    minZoom: 10.5,
    zoomControl: true,
    wheelPxPerZoomLevel:200
});

/*---- Search Leaflet Geocoding ----*/
// L.Control.geocoder({
//     // var bbox=e.geocode.bbox;
//     // var poly=L.polygon(
//     //     [
//     //     bbox.getSouthEast(),
//     //     bbox.getNorthEast(),
//     //     bbox.getNorthWest(),
//     //     bbox.getSouthWest()
//     //     ])
//     geocoder: L.Control.Geocoder.google(),
//     showUniqueResult: true,
//     showResultIcons: false,
//     collapsed: false,
//     expand: 'touch',
//     position: 'topleft',
//     placeholder: 'Tìm kiếm địa điểm...',
//     errorMessage: 'Không tìm thấy địa điểm',
//     iconLabel: 'Tìm kiếm địa điểm mới',
//     query: '',
//     queryMinLength: 1,
//     suggestMinLength: 250,
//     suggestTimeout: 250,
//     defaultMarkGeocode: true
// }).addTo(map);

/*---- Fullscreen Leaflet ----*/
L.control.fullscreen({
    position: 'topleft',
    title: 'Phóng to bản đồ',
    titleCancel: 'Thu nhỏ bản đồ ',
}).addTo(map);

/*---- Zoom Home ----*/
var zoomHome = L.Control.zoomHome();

console.log(zoomHome);

zoomHome.addTo(map);
$(".leaflet-control-zoomhome-in").css("display","none");
$(".leaflet-control-zoomhome-out").css("display","none");
/*---- Measure Tool ----*/
var measureControl = new L.Control.Measure({
    position: 'topleft',
    primaryLengthUnit: 'meters',
    secondaryLengthUnit: 'kilometers',
    primaryAreaUnit: 'hectares',
    secondaryAreaUnit: 'sqmeters',
    popupOptions: {
        className: 'leaflet-measure-resultpopup',
        autoPanPadding: [10, 10]
    },
    activeColor: '#ff0000',
    completedColor: '#f27000'
})
measureControl.addTo(map);
/*---- Tạo Pulse Marker ----*/
var pulse_marker;
var pulsingIcon = L.icon.pulse({
    popupAnchor: [0, 0],
    iconAnchor: [6, -6],
    iconSize: [13, 13],
    color: '#ff0000',
    fillColor: 'rgba(255,255,255,0)',
    heartbeat: 1
});
/*---- Show Latlong ----*/
map.removeControl(map.latLngControl);
map.addControl(L.control.latLng({ position: "bottomleft" }));
/*---- WMS Geoserver ----*/
// var view_hanhchinh = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspace + '/wms', {
//     layers: 'hanhchinh_tiengiang',
//     tiled: true,
//     format: 'image/png',
//     maxZoom: 20,
//     minZoom: 0,
//     transparent: true,
//    // viewparams:'mahuyen:825', 
// });
var view_hanhchinh = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms', {
    layers: 'DiaPhanHanhChinh',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true,
   // viewparams:'mahuyen:825', 
});
var view_RanhGioi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms', {
    layers: 'RanhGioiDiaChinh',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true,
   // viewparams:'mahuyen:825', 
});

var view_giaothongmoi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
    layers: 'giaothongnew_select',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true
});

var view_thuyhemoi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
    layers: 'thuyhetinhnew_select',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true
});
var ranhgioidiachinhnew_select = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
    layers: 'ranhgioidiachinhnew_select',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true
});
var view_thuyhe_name = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
    layers: 'thuyhetinhnew_select_name',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true
});

var view_diachat_thuyvan = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
    layers: 'DiaChat_ThuyVan',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true
});

var tenXa_select = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
    layers: 'TenXa_select',
    tiled: true,
    format: 'image/png',
    maxZoom: 20,
    minZoom: 0,
    transparent: true
});


/*---- Spatial Data ----*/
var marker_url = [];

/*---- Hàm Zoom on Click marker ----*/
function markerOnClick(e) {
    var latLngs, lat, lng;
    var markerBounds;
    latLngs = [e.target.getLatLng()];
    lat = latLngs[0]['lat'];
    lng = latLngs[0]['lng'];
}
function KhoiTaoTable(KyHieu,ma_donvi) {
    let tableId= 'KetQua'+KyHieu;
    if($('#'+tableId).length>0){
        // if(document.getElementById('thongsos3')){
            if ( $.fn.dataTable.isDataTable( '#' + tableId ) ) {
                table = $('#' + tableId).DataTable();
            }
            else {
                var table;
                 table= $('#' + tableId).DataTable({    
                         
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    paging: false,
                    bInfo: false,
                    columnDefs: 
                        [{
                            targets: 4,
                            searchable: true,
                            visible: false
                        },
                        {
                            targets: 0,
                            searchable: true,
                            visible: false
                        }
                    ]
                     ,
                    language: {
                        "sZeroRecords": "Năm này không có kết quả quan trắc nào",
                    }
                }); 
                setTimeout(()=>{
                    if(parseInt($('#' + tableId).outerWidth())>parseInt($(".leaflet-popup-content").outerWidth()))
                    {
                        $(".leaflet-popup-content").css("width", $('#' + tableId).outerWidth()+"px" );
                    }
                  
                },500)
               
            }
            let nam_valus= document.getElementById('nam_value1').value;
            table.search( nam_valus ).draw();
                $('#' + tableId).show();
            setTimeout(()=>{
                let value_name= document.getElementById('nam_value1').value;
                table.search( value_name ).draw();
            },500)    
    }
    else{
        setTimeout(KhoiTaoTable(KyHieu,ma_donvi), 1000);
    }
}
var feat_ktsd_ndd, feat_ktsd_xt, feat_ktsd_nm, feat_ktsd_td
var DiemLayMau
    /* Fake layer to control Real layer */
var feat_ktsd_ndd_layer, feat_ktsd_xt_layer, feat_ktsd_nm_layer, feat_ktsd_td_layer
var sample_mau_layer
function poi_district_bgcolor(district) {
    if (district == "Thành phố Mỹ Tho") {
        return "my_tho"
    } else if (district == "Thị xã Gò Công") {
        return "go_cong"
    } else if (district == "Thị xã Cai Lậy") {
        return "thi_xa_cai_lay"
    } else if (district == "Huyện Tân Phước") {
        return "tan_phuoc"
    } else if (district == "Huyện Cái Bè") {
        return "cai_be"
    } else if (district == "Huyện Cai Lậy") {
        return "huyen_cai_lay"
    } else if (district == "Huyện Châu Thành") {
        return "chau_thanh"
    } else if (district == "Huyện Chợ Gạo") {
        return "cho_gao"
    } else if (district == "Huyện Gò Công Tây") {
        return "go_cong_tay"
    } else if (district == "Huyện Gò Công Đông") {
        return "go_cong_dong"
    } else if (district == "Huyện Tân Phú Đông") {
        return "tan_phu_dong"
    }
}
/*----- Điểm/Giếng KTSD NDD -----*/
/*----- Show vị trí thu mẫu -----*/

  function Show_DiemLayMau() { 
    let show_bieudo;
    if($('#bieudo_cot')!=undefined)
        show_bieudo= $('#bieudo_cot')[0].checked;
    else 
        show_bieudo='';
  
    let loaiquantrac = $("#loaiquantrac").val();
   // var ten_quantrac = $("#ten_quantrac").val();
    let namtimkiem = $("#nam_mau").val();
   // var ky_hieu= $("#kyhieu_mau").val();
    let district_mau = $("#district_mau").val();

    let hienthi_diem=$('#hienthi_diem')[0].checked;

    let donvi_mau = $("#donvi_mau").val();

    if (DiemLayMau!=undefined)
        map.removeLayer(DiemLayMau);
    let bientam1=0;
    sample_mau_layer = L.geoJson(null);
    ajaxUrl="services/services-map/get_DiemLayMau.php?huyen=" + district_mau  + "&loai_quan_trac=" + loaiquantrac + "&namtimkiem=" +  namtimkiem + "&donvi_quantrac=" + donvi_mau + "&show_bieudo=" + show_bieudo;
   
       DiemLayMau = new L.GeoJSON.AJAX(ajaxUrl, {
        
        onEachFeature: function(feat, layer) {
            /* feature_detail(feat, layer) */
            bientam1++;
            $("#result_point").text(bientam1);
            marker_url.push({
                type: feat.properties.ma_loaiquantrac,
                lat: feat.geometry.coordinates[1],
                lng: feat.geometry.coordinates[0],
                idpoi: feat.properties.id,
                id: L.stamp(layer)
            })
        },error:function(errorshow){
            console.error('Error loading GeoJSON:', errorshow);
        },
        pointToLayer: function(feat, latlng) {
         
            var label
            var html_style;
            var className_style;
            html_style="";
            if(feat.thongso=='')
            {
             
            }else if(100>=feat.thongso&&feat.thongso>=91) {
                html_style += "<div  class='showcolums' style='display:none;border: 1px solid black;background: rgb(51, 51, 255);margin-top:-40px; margin-left:5px; width:10px;height:50px'></div>"; 
            }else if(90>=feat.thongso&&feat.thongso>=76) {
                html_style += "<div class='showcolums' style='display:none; border: 1px solid black;background: rgb(0, 228 , 0);margin-top:-32px; margin-left:5px;  width:10px;height:42px'></div>";
            }else if(75>=feat.thongso&&feat.thongso>=51) {
                html_style += "<div class='showcolums' style='display:none;border: 1px solid black;background: rgb(255, 255, 0);margin-top:-24px; margin-left:5px; width:10px;height:34px'></div>";
            }else if(50>=feat.thongso&&feat.thongso>=26) {
                html_style += "<div class='showcolums' style='display:none;border: 1px solid black;background: rgb(255, 126, 0);margin-top:-16px;  margin-left:5px; width:10px;height:26px'></div>";
            }else if(25>=feat.thongso&&feat.thongso>10) {
                html_style += "<div class='showcolums' style='display:none;border: 1px solid black;background: rgb(255, 0, 0);margin-top:-8px;  margin-left:5px; width:10px;height:18px'></div>";
            }else {
                html_style += "<div class='showcolums' style='display:none;border: 1px solid black;background: rgb(255, 0, 35);margin-top:0px;  margin-left:5px; width:10px;height:10px'></div>";
            }
            if(feat.thongso2=='')
            {
                
            }else if(100>=feat.thongso2&&feat.thongso2>=91) {
                html_style += "<div  class='showcolums2' style='display:none;border: 1px solid black;background: rgb(51, 51, 255);margin-top:-40px; margin-left:5px; width:10px;height:50px'></div>"; 
            }else if(90>=feat.thongso2&&feat.thongso2>=76) {
                html_style += "<div class='showcolums2' style='display:none; border: 1px solid black;background: rgb(0, 228 , 0);margin-top:-32px; margin-left:5px;  width:10px;height:42px'></div>";
            }else if(75>=feat.thongso2&&feat.thongso2>=51) {
                html_style += "<div class='showcolums2' style='display:none;border: 1px solid black;background: rgb(255, 255, 0);margin-top:-24px; margin-left:5px; width:10px;height:34px'></div>";
            }else if(50>=feat.thongso2&&feat.thongso2>=26) {
                html_style += "<div class='showcolums2' style='display:none;border: 1px solid black;background: rgb(255, 126, 0);margin-top:-16px;  margin-left:5px; width:10px;height:26px'></div>";
            }else if(25>=feat.thongso2&&feat.thongso2>10) {
                html_style += "<div class='showcolums2' style='display:none;border: 1px solid black;background: rgb(255, 0, 0);margin-top:-8px;  margin-left:5px; width:10px;height:18px'></div>";
            }else {
                html_style += "<div class='showcolums2' style='display:none;border: 1px solid black;background: rgb(255, 0, 35);margin-top:0px;  margin-left:5px; width:10px;height:10px'></div>";
            }
            if(feat.properties.ma_loaiquantrac != "")
            {
                html_style += "<i class='"+feat.properties.bieutuong +" showpoints' style='color: "+feat.properties.mausac+"; font-size: "+feat.properties.kichthuoc +"; margin-left: -1px; margin-top: 3px'></i>";
            }
            label = '<p class=""><b>Điểm ' + feat.properties.idgieng + '</b></p>';
            className_style = "mouse-pointer diem_mau";
            html_style+=`<b class="showtenkyhieumau" style=" 
            text-shadow: 1px 0 #fff, -1px 0 #fff, 0 1px #fff, 0 -1px #fff,1px 1px #fff, -1px -1px #fff, 1px -1px #fff, -1px 1px #fff;
            color:black;
            `;
            if(hienthi_diem==true)
                html_style+='';
            else 
                html_style+='display:none;';
            html_style+=`
                text-align:center;width:100%; margin-left:-5px;font-size:12px">`+feat.properties.idgieng+`</b>`;
                
            return L.marker(latlng, {
                icon: L.divIcon({
                    html: html_style,
                    popupAnchor: [0, 0],
                    iconAnchor: [12, -2],
                    className: className_style
                }),
                title: feat.properties.idgieng,
                riseOnHover: true,
            }).bindTooltip(label, {
                permanent: false,
                direction: "center",
                opacity: 1
            }).openTooltip({}).on('click', markerOnClick).bindPopup(''
                , {
                'maxWidth': '1000',
                'maxHeight':'750'
            }).on("popupopen", (e) => {
            
                    request = $.ajax({
                        url: "services/services-map/get_thongso_diem.php",
                        type: "post",
                        data: {id:e.target.feature.properties.id, ma_donvi:feat.properties.ma_donvi,ma_loaiquantrac:feat.properties.ma_loaiquantrac, quyketqua:feat.properties.quiketqua}   
                    }).done(function (response, textStatus, jqXHR){
                        //trả  về kết quả thông số của điểm response 
                        e.popup.setContent(sample_info(feat,response));
                        // hiện thị kết quả khi click vào điểm 
                        KhoiTaoTable(e.target.defaultOptions.title,feat.properties.ma_donvi);
                        // chay hàm khởi tạo datatable 
                    }).fail(function (response){
                        // Log the error to the console
                        // console.log(response.responseText);
                        alert('Error: ' + response.responseText);
                    });
            // e.popup.setContent(sample_info(feat,''));
                // console.log(e.target.defaultOptions.title);
                // alert('popup done');    
            })
        }
    }) 
    $("#result_point").text(bientam1);
 
}


Show_DiemLayMau();
 DiemLayMau.on("data:loaded", function() {
    map.addLayer(DiemLayMau);
    
    sample_mau_layer.addTo(map);
    /*---- Zoom when have Param from URL ----*/
    var current_Url = new URL(window.location.href);
    var idpoi_param = current_Url.search.split("=")[1].split("&type")[0];
    var type_param = current_Url.search.split("=")[2];
    if (typeof idpoi_param != "undefined") {
        for (var attr in marker_url) {
            var datum = marker_url[attr];
            //alert(datum.idpoi);
            /*---- Dùng id và type để phân loại ----*/
            if (idpoi_param == datum.idpoi && type_param == datum.type) {
                /*---- Đưa về giữa khung nhìn bản đồ ----*/
                map.fitBounds([
                    [datum.lat + 0.009, datum.lng],
                    [datum.lat - 0.0001, datum.lng + 0.02]
                ], { maxZoom: 15 });
                if (map._layers[datum.id]) {
                    map._layers[datum.id].fire("click");
                }
            }
        }
    }
})
/*---- Load BaseMap ----*/
map.addControl(
    L.control.basemaps({
        basemaps: Basemaps_Control,
        tileX: 0,
        tileY: 0,
        tileZ: 1
    })
);
//view_hanhchinh.addTo(map);
chon_hien_thi_huyen2();
// view_giaothong.addTo(map);
// view_diagioi.addTo(map);
function themdiemmoi2(khoa){
    map.on('dblclick', function(ev){
        if(khoa==1)
        {
            var latlng = map.mouseEventToLatLng(ev.originalEvent);
            window.open("./services/DiemLayMau/form-ViTriLayMau.php?toadox="+ latlng.lat +"&toadoy="+ latlng.lng);
        }

 // console.log(latlng.lat + ', ' + latlng.lng);
});
}
/*---- Layer Control ----*/
var overlayMaps;
var baselayers;
var Menudanhgia;

function showMenuMap(overlayMaps2)
{
    if(overlayMaps!=undefined)
    {
        Menudanhgia.remove();
    }
     overlayMaps = {
        "<span class='font-size-14 text-center'>Nền bản đồ</span>": {
            "<span class='pdd-left-10 font-size-14'>Ranh giới tỉnh</span>": view_RanhGioi,
            "<span class='pdd-left-10 font-size-14'>Tất cả Huyện/Thị xã</span>": view_hanhchinh,
            "<span class='pdd-left-10 font-size-14'>Thủy hệ </span>": view_thuyhemoi,
            "<span class='pdd-left-10 font-size-14'>Tên thủy hệ</span>": view_thuyhe_name,
            "<span class='pdd-left-10 font-size-14'>Giao thông </span>": view_giaothongmoi,
            "<span class='pdd-left-10 font-size-14'>Tên Xã</span>": tenXa_select,
            "<span class='pdd-left-10 font-size-14'>Ranh giới xã</span>": ranhgioidiachinhnew_select,
            "<span class='pdd-left-10 font-size-14'>Địa chất - Thủy văn</span>": view_diachat_thuyvan,
        },
     }
     Menudanhgia= L.control.groupedLayers(baselayers, overlayMaps, {
    collapsed: false
    }).addTo(map);
}
/* Add Checkbox to Turn ON/OFF layer */
function add_checkbox_cus() {
    $(".leaflet-control-layers-overlays").append('<label>' +
        '<div>' +
        '<input id="on_feat_check" type="checkbox" class="leaflet-control-layers-selector" checked>' +
        '<span>' +
        '<span id="on_feat" class="pdd-left-10 font-size-14" style="color: green">Còn hoạt động</span>' +
        '</span>' +
        '</div>' +
        '</label>')
    $(".leaflet-control-layers-overlays").append('<label>' +
        '<div>' +
        '<input id="off_feat_check" type="checkbox" class="leaflet-control-layers-selector" checked>' +
        '<span>' +
        '<span id="off_feat" class="pdd-left-10 font-size-14" style="color: red">Không hoạt động/Đã trám lấp</span>' +
        '</span>' +
        '</div>' +
        '</label>')
}
map.addLayer(view_RanhGioi);
function chon_hien_thi_huyen()
{
    let huyenId = $("#district_mau").val();
    map.removeLayer(view_hanhchinh);
    map.removeLayer(view_thuyhemoi);
    map.removeLayer(view_thuyhe_name);
    map.removeLayer(view_giaothongmoi);
    map.removeLayer(ranhgioidiachinhnew_select);
    map.removeLayer(tenXa_select);
    let viewparams = "";
    if(huyenId!="")
    {
         viewparams = 'mahuyen:'+ huyenId;
          map.removeLayer(view_RanhGioi);
    }
    view_RanhGioi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms', {
        layers: 'RanhGioiDiaChinh',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
       // viewparams:'mahuyen:825', 
    });   
    view_hanhchinh = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms', {
        layers: 'DiaPhanHanhChinh',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_thuyhemoi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'thuyhetinhnew_select',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_thuyhe_name = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'thuyhetinhnew_select_name',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_giaothongmoi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'giaothongnew_select',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    ranhgioidiachinhnew_select = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'ranhhuyenxa_select',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    tenXa_select = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'TenXa_select',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_diachat_thuyvan = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'DiaChat_ThuyVan',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true
    });
    showMenuMap(overlayMaps);
    map.addLayer(ranhgioidiachinhnew_select);
    map.addLayer(view_hanhchinh);
    map.addLayer(view_thuyhemoi);
    map.addLayer(view_giaothongmoi);
    map.removeLayer(view_RanhGioi);
    if(huyenId!="")
    { 
        map.addLayer(tenXa_select);
        map.removeLayer(view_RanhGioi);
    }
   $.ajax({
        type:"POST",//or POST
        url:'./services/tinhhuyen.php',
        data:{id:huyenId},
        success:function(data){      
        if(huyenId=="")
        {   
            //gán nút home zoom về một điểm cố định 
            zoomHome.setHomeCoordinates([10.411348991998135, 106.29704018005418]);
            zoomHome.setHomeZoom(10.63);
            //hiện zoom toàn canh
            map.setView([10.411348991998135, 106.29704018005418],10.9+((window.screen.width/1920)-1));
        }else {
            var fullsreenn=0.0;
             if( map._isFullscreen==true)
             {
                fullsreenn=fullsreenn+0.3;

             }else
             {
                fullsreenn=0;
             }
            //zoom toàn một khu vực 
            map.setView([data[0].valueY,data[0].valueX],(parseFloat(data[0].zoomm) + fullsreenn)+((window.screen.width/1920)-1));
            //gán nút home zoom về một điểm cố định 
            zoomHome.setHomeCoordinates([data[0].valueY,data[0].valueX]);
            zoomHome.setHomeZoom((parseFloat(data[0].zoomm) + fullsreenn)+((window.screen.width/1920)-1));
        }
        //hien thi 
        },error: function (jqXHR, textStatus, errorThrown) {
                  if (jqXHR.status == 500) {
                      alert('Internal error: ' + jqXHR.responseText);
                  } else {
                      alert('Unexpected error.');
                  }
              }
     })
 }
 function chon_hien_thi_huyen2()
{
    let huyenId = $("#district_mau").val();
    map.removeLayer(view_hanhchinh);
    map.removeLayer(view_thuyhemoi);
    map.removeLayer(view_thuyhe_name);
    map.removeLayer(view_giaothongmoi);
    map.removeLayer(ranhgioidiachinhnew_select);
    map.removeLayer(tenXa_select);
    let viewparams = "";
    if(huyenId.length>0)
    {   
        let bientam='';
        for (let index = 0; index < 5; index++) {
            bientam+='mahuyen'+(index+1)+':'+huyenId[index%huyenId.length]+';';
        }
         viewparams = bientam;
          map.removeLayer(view_RanhGioi);
    }

    view_RanhGioi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms', {
        layers: 'RanhGioiDiaChinh',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
       // viewparams:'mahuyen:825', 
    });   
    view_hanhchinh = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms', {
        layers: 'DiaPhanHuyen_multiple',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_thuyhemoi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'thuyhetinhnew_multiple',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_thuyhe_name = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'thuyhetinhnew_multiple_name',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_giaothongmoi = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'giaothongnew_multiple',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    ranhgioidiachinhnew_select = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'ranhhuyenxa_multiple',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    tenXa_select = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'TenXa_multiple',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true,
        viewparams: viewparams, 
    });
    view_diachat_thuyvan = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspaceDiemLayMau + '/wms?', {
        layers: 'DiaChat_ThuyVan',
        tiled: true,
        format: 'image/png',
        maxZoom: 20,
        minZoom: 0,
        transparent: true
    });
    showMenuMap(overlayMaps);
    map.addLayer(ranhgioidiachinhnew_select);
    map.addLayer(view_hanhchinh);
    map.addLayer(view_thuyhemoi);
    map.addLayer(view_giaothongmoi);
    map.removeLayer(view_RanhGioi);
    if(huyenId!="")
    { 
        map.addLayer(tenXa_select);
        map.removeLayer(view_RanhGioi);
    }
    //zoom toi 1 huyện được chọn huyện
    if(huyenId.length==1)
    {
        $.ajax({
            type:"POST",//or POST
            url:'./services/tinhhuyen.php',
            data:{id:huyenId[0]},
            success:function(data){      
            if(huyenId=="")
            {   
                //gán nút home zoom về một điểm cố định 
                zoomHome.setHomeCoordinates([10.411348991998135, 106.29704018005418]);
                zoomHome.setHomeZoom(10.63);
                //hiện zoom toàn canh
                map.setView([10.411348991998135, 106.29704018005418],10.9+((window.screen.width/1920)-1));
            }else {
                var fullsreenn=0.0;
                 if( map._isFullscreen==true)
                 {
                    fullsreenn=fullsreenn+0.3;
    
                 }else
                 {
                    fullsreenn=0;
                 }
                //zoom toàn một khu vực 
                map.setView([data[0].valueY,data[0].valueX],(parseFloat(data[0].zoomm) + fullsreenn)+((window.screen.width/1920)-1));
    
                //gán nút home zoom về một điểm cố định 
                zoomHome.setHomeCoordinates([data[0].valueY,data[0].valueX]);
                zoomHome.setHomeZoom((parseFloat(data[0].zoomm) + fullsreenn)+((window.screen.width/1920)-1));
            }
            //hien thi 
            },error: function (jqXHR, textStatus, errorThrown) {
                      if (jqXHR.status == 500) {
                          alert('Internal error: ' + jqXHR.responseText);
                      } else {
                          alert('Unexpected error.');
                      }
                  }
         })
    }
 }   
/*---- Add/Remove Some Layer when Zooming ----*/
// thêm hoặc xóa layer khi zoom
// map.on('zoomend', function() {
//     if (map.getZoom() >= 15 && map.hasLayer(view_hanhchinh)) {
//         map.removeLayer(view_hanhchinh);
//         map.addLayer(view_thuyhe);
//         // map.addLayer(view_diagioi);
//         /*add_checkbox_cus() */
//     }
//     if (map.getZoom() < 15 && map.hasLayer(view_hanhchinh) == false) {
//         map.addLayer(view_hanhchinh);
//        map.removeLayer(view_thuyhe);
//       // map.removeLayer(view_diagioi);
//         /* add_checkbox_cus() */
//     }
// });
/*---- Checkbox ON/OFF Feature

}) ----*/
/*---- DOM view LatLng when F5 page or load first times ----*/
$(".leaflet-control-lat").val(10.411348991998135);
$(".leaflet-control-lng").val(106.29704018005418);
    
/*---- Zoom Home Event ----*/
$(".leaflet-control-zoomhome-home").on("click", function() {
    var searh_loc = map._layers
    if (Object.keys(searh_loc).length > 39) {
        var result_loc_search_1 = searh_loc[Object.keys(searh_loc)[Object.keys(searh_loc).length - 1]]
        var result_loc_search_2 = searh_loc[Object.keys(searh_loc)[Object.keys(searh_loc).length - 2]]
        // tắt remmovelayer  dưới vì lý do nhấn nhiều lần nút home sẽ remove toàn bộ điểm hiển thị trên bản đồ
            /* Remove point sau khi tìm kiếm địa điểm khi click Zoom home */
        // map.removeLayer(result_loc_search_1)
        // map.removeLayer(result_loc_search_2)
    }
    //không chọn huyện zoom toàn cảnh
    if($('#district_mau').val()=="")
    {
         if( map._isFullscreen==true)
        {
            fullsreenn=fullsreenn+0.3;
            map.setView([10.411348991998135, 106.29704018005418],10.9+fullsreenn+((window.screen.width/1920)-1));
        }else
        {
            fullsreenn=0;
            map.setView([10.411348991998135, 106.29704018005418],10.9+fullsreenn+((window.screen.width/1920)-1));
        }
        zoomHome.setHomeCoordinates([10.411348991998135, 106.29704018005418]);
        zoomHome.setHomeZoom(10.9+((window.screen.width/1920)-1));
    }
})
$("#poi_search_mau").click(function() {
    // hien thị thông tin điểm đã tìm
    Show_DiemLayMau();
    DiemLayMau.on("data:loaded", function() {
        //console.log(DiemLayMau);
        /*** Zoom tới vùng Search ***/
        //Fitbound_zoom(url_ktsd_nm)
        //markers.addLayer(sample_mau); 
        //console.log(markers);
        map.addLayer(DiemLayMau);
        /*** Thêm Option Giếng/Điểm ***/
        update_Stationn(url_ktsd_nm)
    })
    // đổi hiển thị trong geoserver
    chon_hien_thi_huyen2(); 
    
    // tắt sidebar
     sidebar.onCloseClick();
     LoadChange(); 
})
var button = new L.Control.Button('<div style="font-size:15px">Thêm điểm tắt</div>', {
  toggleButton: 'active'
});
button.addTo(map);

var buttonmap = new L.Control.Button('<div style="font-size:15px;line-height:normal;"><i class="material-icons">my_location</i></div>', {
    toggleButton: 'active'
  });

  buttonmap.addTo(map);
    let clearinterval;
  buttonmap.on('click', function () {
    if (buttonmap.isToggled()) {
        this._container.innerHTML='<div style="line-height:normal;font-size:15px;"><i class="material-icons">my_location</i></div>';
        this._container.style.background="white";
    //    clearInterval(clearinterval);
        if(directmap!=undefined)
        {   
            directmap.remove();
        }
        if(newMarker!=undefined)
        {
            navigator.geolocation.clearWatch(offpoint);
            newMarker.remove();
           // rotatedMarker.remove();
    
        }      
       // clearInterval(clearinterval);
    } else {
        this._container.innerHTML='<div style="line-height:normal;font-size:15px;"><i class="material-icons">my_location</i></div>';
        this._container.style.background="#90EE90";
        if (navigator.geolocation) {
            offpoint = navigator.geolocation.watchPosition((position)=>{
            //  console.log(position.coords.latitude, position.coords.longitude);
                if(newMarker!=undefined)
                {
                    newMarker.remove();
                   // rotatedMarker.remove();
                }      
                newMarker = L.marker([position.coords.latitude, position.coords.longitude],{icon:iconponit}).addTo(map);
                //rotatedMarker = L.popup().setLatLng([position.coords.latitude, position.coords.longitude]).setContent(position.coords.latitude+","+position.coords.longitude).openOn(map);
            });
        }
    }
});

button.on('click', function () {
    if (button.isToggled()) {
        this._container.innerHTML='<div style="font-size:15px">Thêm điểm mở </div>';
        this._container.style.background="white";
        map.removeEventListener("dblclick", );            
    } else {
        this._container.innerHTML='<div style="font-size:15px">Thêm điểm tắt </div>';
        this._container.style.background="#90EE90";
        themdiemmoi(1);
    }
});
var newMarker;
let directmap;
let rotatedMarker;
let offpoint;
var iconmap=L.icon({
    iconUrl:'carpoint.png',
    iconSize:[20,20]
})
var iconponit=L.icon({
    iconUrl:'point.png',
    iconSize:[20,20]
})
//chỉ duong Google Map
function RoutingMap(ValueX,ValueY)
{
    var end = new google.maps.LatLng(ValueX, ValueY);
    var apiKey = 'AIzaSyA0BBgzAbRXQh4hoHEkR62IiBS1sFTDt4U';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position)=>{
            getDirections(new google.maps.LatLng(position.coords.latitude, position.coords.longitude), end, apiKey);
        });
    }
  
}

function Routing(ValueX,ValueY)
{
    if(directmap!=undefined)
    { 
        directmap.remove();
        newMarker.remove();
    }
    if (navigator.geolocation) {
        //dùng khi nâng cấp chứng chỉ ssl
        navigator.geolocation.getCurrentPosition((position)=>{
       //    newMarker = L.marker([position.coords.latitude, position.coords.longitude],{icon:iconmap}).addTo(map);
            directmap=L.Routing.control({
                waypoints: [
                    L.latLng(ValueX, ValueY),
                    L.latLng(position.coords.latitude, position.coords.longitude)
                ]
            }).on('routesfound', function (e) {
                        newMarker.remove();
                        var routes = e.routes;
                    //  console.log( e.routes[0].coordinates);
                
                    e.routes[0].coordinates.forEach(function (coord, index) {
        
                        setInterval(function () {
                            newMarker.setLatLng([position.coords.latitude, position.coords.longitude]);
                        }, 100 * index);
                    })
            
            }).addTo(map)
         });
       /// newMarker = L.marker([10.377226413086893,  106.36537468363458],{icon:iconmap}).addTo(map);
    }     
}
// tool chi duong cua google map
function decodePolyline(encoded) {
    var polyline = L.Polyline.fromEncoded(encoded);
    return polyline.getLatLngs();
  }

  function getDirections(start, end, apiKey) {
    var directionsService = new google.maps.DirectionsService();

    var request = {
      origin: start,
      destination: end,
      travelMode: 'DRIVING'
    };

    directionsService.route(request, function (response, status) {
      if (status == 'OK') {
        var steps = response.routes[0].legs[0].steps;

        for (var i = 0; i < steps.length; i++) {
          var encodedPolyline = steps[i].polyline.points;
          var decodedPolyline = decodePolyline(encodedPolyline);

          L.polyline(decodedPolyline).addTo(map);
        }
      } else {
        console.log('Directions request failed');
      }
    });
  }

  // Call the function with the starting and ending points

 