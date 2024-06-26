var protocol = "https://";
// var protocol = "https://";
// var subdomain_geoserver = "127.0.0.1:8083/";
var subdomain_geoserver = "geo.ttcntnmt.com.vn/";
//var subdomain_geoserver = "192.168.7.15:8083/";
// var subdomain_geoserver = "geo.projgis.link/";
                
/*---- Geoserver ----*/
var host_geoserver = "geoserver/";
var workspace = "tiengiang_tnn";
var workspaceDiemLayMau = "QuanLy_DiemLayMau";
/*** Services for WMTS ***/
var wmts = "gwc/service/wmts?"
var services = "&style=" +
    "&tilematrixset=EPSG:900913" +
    "&Service=WMTS" +
    "&Request=GetTile" +
    "&Version=1.0.0" +
    "&Format=image/png" +
    "&TileMatrix=EPSG:900913:{z}&TileCol={x}&TileRow={y}";
