function onMapClick(e) {
    let latlng = e.latlng;
    let tabMap=[];
    let layerMap =[];
    // console.log(inputLayerViewMap);
    // console.log(viewLayerMaps);
  for (let i = 0; i < viewLayerMaps.length; i++) {
        for (let j = 0; j < viewLayerMaps[i].length; j++) {
            const url = getFeatureInfoUrl(map,viewLayerMaps[i][j].layer,e.latlng,{'info_format': 'application/json',
                // 'propertyName': 'ALL',
                // 'propertyName': 'RED_BAND,GREEN_BAND,BLUE_BAND',
                },viewLayerMaps[i][j].proj4text,e);
            if (url) {  
                // let data2=await loadTableMap(url,viewLayerMaps[i][j].lable);
                // console.log(data2);
                // console.log(await  loadTableMap(url,viewLayerMaps[i][j].lable));
                // layerMap.push( await loadTableMap(url,viewLayerMaps[i][j].lable));
            }             
        }   
        tabMap.push({
            nameMap:inputLayerViewMap[i].name,
            layer:layerMap
        }); 
        console.log(tabMap); 
    }
    L.popup()
    .setLatLng(latlng)
    .setContent(sample_info(tabMap))
    .openOn(map);
    // console.log(tabmap);
}
 function processAjax2(map,viewLayerMaps2,latlng2,e)
{
    return new Promise((resolve, reject) => {
        
        let responsedata=[];
        for (let j = 0; j < viewLayerMaps2.length; j++) {
            const url = getFeatureInfoUrl(map,viewLayerMaps2.layer,e.latlng,{'info_format': 'application/json',
                // 'propertyName': 'ALL',
                // 'propertyName': 'RED_BAND,GREEN_BAND,BLUE_BAND',
                },viewLayerMaps2[j].proj4text,e);
            if (url) {  
                $.ajax({
                    type: 'POST',
                    url: '{{route("convertCORS")}}',
                    data: {
                        url:url
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                    },
                    success: function(response) {
                        if(response.data.length)
                        {   
                            let dataInforMap=[];
                            response.data.forEach(element => {
                                dataInforMap.push(element.properties);
                            });
                            responsedata.push({nameLayer:viewLayerMaps2[j].lable,data2:dataInforMap}); 
                        }                                   
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        console.error('Status: ' + status);
                        console.error('Error: ' + error);
                    }
                });
            }             
        }
        return responsedata;
    });   
}
async function onMapClick22(e) {
    let latlng = e.latlng;
    let tabMap=[];
  for (let i = 0; i < viewLayerMaps.length; i++) {
    let layerMap= await processAjax(map,viewLayerMaps[i],e.latlng,e);
    console.log(layerMap);
    tabMap.push({
            nameMap:inputLayerViewMap[i].name,
            layer:layerMap
        }); 
  }             
    // console.log(tabmap);
}
function getFeatureInfoUrl(map, layer, latlng, params,proj4Def,e) {
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
        // srs: nativeSRS,
        srs:'EPSG:327677',
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
function loadTableMap(url,inputNameLayer){
    $.ajax({
        type: 'POST',
        url: '{{route("convertCORS")}}',
        data: {
            url:url
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
        },
        success: function(response) {
            if(response.data.length)
            {   
                let dataInforMap=[];
                response.data.forEach(element => {
                    dataInforMap.push(element.properties);
                });
                return {nameLayer:inputNameLayer,data2:dataInforMap}; 
            }                                   
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            console.error('Status: ' + status);
            console.error('Error: ' + error);
        }
    });
}