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

    L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
        attribution: 'Simple Map ',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ đơn giản',
        /* optional label used for tooltip */
        iconURL: 'assets/images/b_tile.stamen.png'
    }),

    L.tileLayer('https://mt1.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        attribution: 'Google Terrain',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ địa hình Google',
        iconURL: 'https://mt1.google.com/vt/lyrs=p&x=101&y=60&z=7'
    }),
    L.tileLayer('https://{s}.dothanhlong.org/basemap/hanhchinh/zxy/t6/VBD/{z}/{x}/{y}.png', {
        attribution: 'Map tiles by Việt Bản đồ',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Việt Bản đồ',
        /* iconURL: '../assets/img/map_thumb/Map_tiles_by_Việt_Bản_đồ.png' */
        iconURL: 'http://images.vietbando.com/ImageLoader/GetImage.ashx?Ver=2016&LayerIds=VBD&Level=7&X=101&Y=60'
    }),

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


/*---- Fullscreen Leaflet ----*/
let fullscreen= L.control.fullscreen({
    position: 'topleft',
    title: 'Phóng to bản đồ',
    titleCancel: 'Thu nhỏ bản đồ ',
});
fullscreen.addTo(map);
/*---- Zoom Home ----*/
let zoomHome = L.Control.zoomHome();
zoomHome.addTo(map);
$(".leaflet-control-zoomhome-in").css("display","none");
$(".leaflet-control-zoomhome-out").css("display","none");
/*---- Measure Tool ----*/
// var measureControl = new L.Control.Measure({
//     position: 'topleft',
//     primaryLengthUnit: 'meters',
//     secondaryLengthUnit: 'kilometers',
//     primaryAreaUnit: 'hectares',
//     secondaryAreaUnit: 'sqmeters',
//     popupOptions: {
//         className: 'leaflet-measure-resultpopup',
//         autoPanPadding: [10, 10]
//     },
//     activeColor: '#ff0000',
//     completedColor: '#f27000'
// })
// measureControl.addTo(map);
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

/*---- WMTS Geoserver ----*/
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
/*---- Load BaseMap ----*/
map.addControl(
    L.control.basemaps({
        basemaps: Basemaps_Control,
        tileX: 0,
        tileY: 0,
        tileZ: 1
    })
);
/*---- Add/Remove Some Layer when Zooming ----*/

/*---- Zoom Home Event ----*/
$(".leaflet-control-zoomhome-home").on("click", function() {
    var searh_loc = map._layers
    if (Object.keys(searh_loc).length > 39) {
        var result_loc_search_1 = searh_loc[Object.keys(searh_loc)[Object.keys(searh_loc).length - 1]]
        var result_loc_search_2 = searh_loc[Object.keys(searh_loc)[Object.keys(searh_loc).length - 2]]
    }
    //không chọn huyện zoom toàn cảnh
    // if($('#district_mau').val()=="")
    // {
    //      if( map._isFullscreen==true)
    //          {
    //             fullsreenn=fullsreenn+0.3;
    //             map.setView([10.411348991998135, 106.29704018005418],10.9+fullsreenn+((window.screen.width/1920)-1));
    //          }else
    //          {
    //             fullsreenn=0;
    //             map.setView([10.411348991998135, 106.29704018005418],10.9+fullsreenn+((window.screen.width/1920)-1));
    //          }
    //     zoomHome.setHomeCoordinates([10.411348991998135, 106.29704018005418]);
    //     zoomHome.setHomeZoom(10.9+((window.screen.width/1920)-1));
    // }
})
function createLayer(layerData,mahuyen) {
    // console.log(mahuyen); 
    if(layerData.is_nen&&layerData.level==2)
    {
        let viewparams = 'mahuyen:'+ mahuyen.ma_dvhc;

        return L.tileLayer.wms(layerData.linkurl +"/"+ layerData.workspace + '/wms', {
            layers:layerData.name,
            tiled: true,
            format: 'image/png',
            maxZoom: 20,
            minZoom: 0,
            transparent: true,
            viewparams: viewparams, 
        });   
    }else{
        return L.tileLayer.wms(layerData.linkurl +"/"+ layerData.workspace + '/wms', {
            layers:layerData.name,
            tiled: true,
            format: 'image/png',
            maxZoom: 20,
            minZoom: 0,
            transparent: true,
            // viewparams: viewparams, 
        });   
    }
}
function showMenuMap(inputLayerViewMap)
{
    if(menuViewLayer.length>0||menuViewLayer==undefined)
    {  
        for (let i = 0; i < menuViewLayer.length; i++) {
            menuViewLayer[i].remove();
            overlayMaps[i]={};
        }
        menuViewLayer=[];
    }
    if(viewLayerMaps.length==1&&inputLayerViewMap[0].level==1){

    }
    let checklevel=0;
    let checkdistrict=0;
    let district_idcheck=0;
    // let itemmap=0;
    // console.log(viewLayerMaps);
    for (let itemMap in viewLayerMaps) {
        // console.log(inputLayerViewMap[itemMap]);
        if(district_idcheck!=inputLayerViewMap[itemMap].district_id)
        {
            checkdistrict++;
        }
        // itemmap=itemMap;
        district_idcheck=inputLayerViewMap[itemMap].district_id;
    
        overlayMaps[itemMap] ={["<span class='font-size-14 text-center'>"+inputLayerViewMap[itemMap].name+"</span>"]:{}};
        if(inputLayerViewMap[itemMap].level==1)
        {
            checklevel=1;
        }
        if(menuViewLayer.length==0||menuViewLayer==undefined)
        {
            menuViewLayer[itemMap]=[];
        }
        for(let itemLayer in viewLayerMaps[itemMap])
        {
            // console.log(itemLayer);
            // Tạo một biến mới để lưu trữ chuỗi HTML
            overlayMaps[itemMap]["<span class='font-size-14 text-center'>"+inputLayerViewMap[itemMap].name+"</span>"] 
                ["<span class='pdd-left-10 font-size-14'>"+viewLayerMaps[itemMap][itemLayer].lable+"</span>"] =viewLayerMaps[itemMap][itemLayer].layer; 
        }
        menuViewLayer[itemMap]= L.control.groupedLayers('', overlayMaps[itemMap], {
            collapsed: false
        }).addTo(map);
        // delete overlayMaps[itemMap];
    }
    //set zoom

    if(checklevel==1)
    {
        map.flyTo([10.411348991998135, 106.29704018005418],11,{
            animate: true,
            duration: 2.0,
            easeLinearity: 0.5, // Điều chỉnh tốc độ chuyển động
            // noMoveStart: false// Thời gian chuyển động (giây)
        }); 
        map.on('zoomend', ()=>{
            map.setZoom( map.getZoom(), { animate: true });
        });    
    }else{

        if(checkdistrict>1)
        {
           map.flyTo([10.411348991998135, 106.29704018005418],11,{
                animate: true,
                duration: 2.0,
                easeLinearity: 0.5, // Điều chỉnh tốc độ chuyển động
                // noMoveStart: false// Thời gian chuyển động (giây)
            }); 
            map.on('zoomend', ()=>{
                map.setZoom( map.getZoom(), { animate: true });
            });  
            // dad.remove();  
        }else{
    
            map.flyTo([inputLayerViewMap[0].valueY, inputLayerViewMap[0].valueX],inputLayerViewMap[0].zoomm,{
                animate: true,
                duration: 2.0,
                easeLinearity: 0.5, // Điều chỉnh tốc độ chuyển động
                // noMoveStart: false// Thời gian chuyển động (giây)
            });
            map.on('zoomend', ()=>{
                map.setZoom( map.getZoom(), { animate: true });
            });       
        }
    }
}
function showLayerMap(inputLayerViewMap)
{
    //remove laye
    for (let t3 = 0; t3 < viewLayerMaps.length; t3++) {
        for(let removeMap  in  viewLayerMaps[t3])
        {
            map.removeLayer(viewLayerMaps[t3][removeMap].layer);
        }  
    }
    viewLayerMaps=[];
    for (let t2 = 0; t2 < inputLayerViewMap.length; t2++) {
        inputLayerViewMap[t2].layer.forEach((inputLayer)=>{
            // console.log(inputLayer);
            try {
                if(viewLayerMaps[t2]==undefined)
                {
                    viewLayerMaps[t2]=[];
                }
                let itemlayer=createLayer(inputLayer,inputLayerViewMap[t2]);   
                viewLayerMaps[t2].push({'layer':itemlayer, 'lable':inputLayer.lable,'proj4text':inputLayer.proj4text});
                if(inputLayer.default)
                {
                    map.addLayer(itemlayer);
                }   
            } catch (error) {
                console.log(error);
            }
        });
    }
    showMenuMap(inputLayerViewMap);
}
function showClickMap(idArray,clickUrl){
    NProgress.start();
    $.ajax({
            type: 'POST',
            url: '{{route("load.map.client")}}',
            url:clickUrl,
            data: {
                id:idArray
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
            },
            success: function(response) {
                // console.log(response);
                inputLayerViewMap=response.data;
                // console.log(response);
                showLayerMap(inputLayerViewMap);
                // console.log(inputLayerViewMap,viewLayerMaps);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                console.error('Status: ' + status);
                console.error('Error: ' + error);
            }
     });
     NProgress.done();
}
var buttonmap = new L.Control.Button('<div style="font-size:15px;line-height:normal;"><i class="material-icons">my_location</i></div>', {
    toggleButton: 'active'
  });
let directmap;
let newMarker;
let iconmap=L.icon({
    iconUrl:'carpoint.png',
    iconSize:[20,20]
})
let iconponit=L.icon({
    iconUrl:'point.png',
    iconSize:[20,20]
})
buttonmap.addTo(map);
let clearinterval;
  buttonmap.on('click', function () {
    if (buttonmap.isToggled()) {
        this._container.innerHTML='<div style="line-height:normal;font-size:15px;"><i class="material-icons">my_location</i></div>';
        this._container.style.background="white";
        if(directmap!=undefined)
        {   
            directmap.remove();
        }
        if(newMarker!=undefined)
        {
            navigator.geolocation.clearWatch(offpoint);
            newMarker.remove();
        }      
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
 