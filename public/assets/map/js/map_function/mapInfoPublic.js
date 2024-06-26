 /*---- Hiển thị thông tin Công trình (Panel) ----*/
 function feature_detail(feat, layer) {
    layer.on({
        click: function(e) {
            /*** Diem KTSD_NDD ***/
            if (feat.properties.type == "ktsd_ndd") {
                /*** Get Data From Services ***/
                $.post("services/services-map/feat-poi-ndd.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-ctkt-ndd.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                $.post("services/services-map/feat-gp-ndd.php", {
                        "idgieng": feat.properties.idgieng
                    }).done(function(dom_form) {
                        $("#gp").html(dom_form)
                    })
                    /*** Diem XT ***/
            } else if (feat.properties.type == "xt") {
                $.post("services/services-map/feat-poi-xt.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-xt.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                $.post("services/services-map/feat-gp-xt.php", {
                        "idgieng": feat.properties.idgieng
                    }).done(function(dom_form) {
                        $("#gp").html(dom_form)
                    })
                    /*** Diem KTSD_NM ***/
            } else if (feat.properties.type == "ktsd_nm") {
                $.post("services/services-map/feat-poi-nm.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-ctkt-nm.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                $.post("services/services-map/feat-gp-nm.php", {
                        "idgieng": feat.properties.idgieng
                    }).done(function(dom_form) {
                        $("#gp").html(dom_form)
                    })
                    /*** Diem TD ***/
            } else if (feat.properties.type == "td") {
                $.post("services/services-map/feat-poi-td.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-td.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                $.post("services/services-map/feat-gp-td.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#gp").html(dom_form)
                })
            }

            /* pulse_marker = L.marker([feat.geometry.coordinates[1],
                feat.geometry.coordinates[0]], {
                icon: pulsingIcon
            }) */

            if ($("#side-feature").hasClass("side-panel-open") == false) {
                $("#side-feature").toggleClass("side-panel-open")
            }
        }
    })
}
/*---- Hiển thị thông tin vị trí lấy mẫu (Popup) ----*/
function sample_info(feat,thongso) {
    //console.log(feat);
    var content;
    content = '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px" id="popup"><b>'+
        feat.properties.LoaiQuanTrac + '</b></div>';
    content += '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px">' +
        'Ký hiệu điểm: ' + feat.properties.idgieng + '</div>';
    content += '<table class="table table-bordered table-feat-info">';
    content += '<tbody>';

    /*** Tọa độ ***/
    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">Tọa độ X</td>';
    content += '<td class="table-feat-info">' + feat.properties.toadoX + '</td>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">Tọa độ Y</td>';
    content += '<td class="table-feat-info">' + feat.properties.toadoY + '</td>';
    content += '</tr>';

    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">WGS84 X</td>';
    content += '<td class="table-feat-info">' + feat.geometry.coordinates[1] + '</td>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">WGS84 Y</td>';
    content += '<td class="table-feat-info">' + feat.geometry.coordinates[0] + '</td>';
    content += '</tr>';

    content += '<tr>';
    //vị trí
    content += '<tr>'
    content += '<td class="text-bold text-center table-feat-info" colspan="2">' + 'Vị trí lấy mẫu' + '</td>';
    content += '<td class="table-feat-info" colspan="2">' + feat.properties.vitri_mau + '</td>';
    content += '</tr>';


    //Đơn vị hành chính 
    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info" colspan="2">Huyện</td>';
    content += '<td class="table-feat-info" colspan="2">' + feat.properties.huyen + '</td>';
    // ngày lấy mẫu ***/
    //content += '<td class="text-bold text-center table-feat-info">Ngày lấy mẫu</td>';
    //content += '<td class="table-feat-info">' + feat.properties.ngaylay_mau + '</td>';
    content += '</tr>';
    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info" colspan="2">Đơn Vị</td>';
    content += '<td class="table-feat-info" colspan="2">' + feat.properties.ten_donvi + '</td>';
    // ngày lấy mẫu ***/
    //content += '<td class="text-bold text-center table-feat-info">Ngày lấy mẫu</td>';
    //content += '<td class="table-feat-info">' + feat.properties.ngaylay_mau + '</td>';
    content += '</tr>';
    
    content += '<tr>'
    content += `<td class="text-bold text-center table-feat-info" colspan="4">`;
    content +=`
          <button onclick="Routing(`+feat.geometry.coordinates[1]+`,`+feat.geometry.coordinates[0]+`)">Đi đến địa điểm</button>
   `;
    content += ' </td> </tr>';

  
    if(feat.properties.ma_donvi==4||feat.properties.ma_loaiquantrac==10||feat.properties.quiketqua==4)
    {
        
        //nếu thông số thuộc đơn vị trung tâm quan trắc môi trường
        if(thongso.length!=0){ 
            let lastYear = thongso[thongso.length-1].nam_kq;
            content += '<tr>'
            content += '<td class="text-bold text-center table-feat-info" colspan="4"><input   onclick="left_button('+"'KetQua" + feat.properties.idgieng +"'"+');" id="left_button" type="submit" value="<">';
            content +='<input type="number" disabled  style="text-align: center;" id="nam_value1" value="'+ (lastYear) +'"> <input type="submit" id="right_button" onclick="right_button('+"'KetQua" + feat.properties.idgieng +"'"+');" value=">"></td>'
            content += '</tr>';
            content +=  '<table id="KetQua' + feat.properties.idgieng + '" class="display" style="width:100%;  display:none" >  <thead>' ; 
            
            content +=  '<tr style=" background: #F5FFFA" >';
            content += '<th class="text-bold text-center table-feat-info"  rowspan="2">' + "STT" + '</th>';
            content += '<th class="text-bold text-center table-feat-info"  rowspan="2">' + "Thông Số" + '</th>';
            content += '<th class="text-bold text-center table-feat-info" rowspan="1" colspan="5">' + "Kết Quả Đo" + '</th>';
            content += '<th class="table-feat-info"  rowspan="2">' + "Đơn Vị"+ '</th>';
            content += '</tr>';
            content += '<tr> <th rowspan="1" style="width:10px;">I</th> <th>II</th> <th>Năm</th>  <th>III</th> <th>IV</th> </tr> </thead>';
            content += '<tbody>';  
            for(let id=0;id<thongso.length;id++){
                content += '<tr >';
                content += '<td class="text-bold text-center table-feat-info" colspan="1">' + thongso[id].stt + '</td>';
                content += '<td class="text-bold text-center table-feat-info" colspan="1">' + thongso[id].ten_quantrac + '</td>';
                content += '<td class=" text-center table-feat-info" colspan="1">' + thongso[id].KetQua_1 + '</td>';
                content += '<td class=" text-center table-feat-info" colspan="1">' + thongso[id].KetQua_2 + '</td>';
                content += '<td class=" text-center table-feat-info" colspan="1">' + thongso[id].nam_kq + '</td>';
                content += '<td class="table-feat-info text-center" colspan="1">' + thongso[id].KetQua_3 + '</td>';
                content += '<td class="table-feat-info text-center" colspan="1">' + thongso[id].KetQua_4 + '</td>';
                content += '<td class=" text-center table-feat-info" colspan="1">' + thongso[id].donvi_quantrac + '</td>';
                content += '</tr>'; 
            }
            content += '</tbody>'; 
            content += '</table>';
        }
    }else{
        // thông số thuộc các đơn vị khác 
        if(thongso.length!=0){ 
            let lastYear = thongso[thongso.length-1].nam_kq;
            content += '<tr>'
            content += '<td class="text-bold text-center table-feat-info" colspan="4"><input   onclick="left_button('+"'KetQua" + feat.properties.idgieng +"'"+');" id="left_button" type="submit" value="<">';
            content +='<input type="number" disabled  style="text-align: center;" id="nam_value1" value="'+ (lastYear) +'"> <input type="submit" id="right_button" onclick="right_button('+"'KetQua" + feat.properties.idgieng +"'"+');" value=">"></td>'
            content += '</tr>';
            content +=  '<table id="KetQua' + feat.properties.idgieng + '" class="display" style="width:100%;" >  <thead>' ; 
            content +=  '<tr style=" background: #F5FFFA" >';
            content += '<th class="text-bold text-center table-feat-info" colspan="1">' + "STT" + '</th>';
            content += '<th class="text-bold text-center table-feat-info" colspan="1">' + "Thông Số" + '</th>';
            content += '<th class="text-bold text-center table-feat-info" colspan="1">' + "Kết Quả Đo" + '</th>';
            content += '<th class="table-feat-info" colspan="1">' + "Đơn Vị"+ '</th>';
            content += '<th  class="text-bold text-center table-feat-info" colspan="1">' + "Năm" + '</th>';
            content += '</tr> </thead>';
            content += '<tbody>';  
            for(let id=0;id<thongso.length;id++){
                content += '<tr >'  
                content += '<td class="text-bold text-center table-feat-info" colspan="1">' + thongso[id].stt + '</td>';
                content += '<td class="text-bold text-center table-feat-info" colspan="1">' + thongso[id].ten_quantrac + '</td>';
                content += '<td class="text-bold text-center table-feat-info" colspan="1">' + thongso[id].KetQua + '</td>';
                content += '<td class="table-feat-info text-center" colspan="1">' + thongso[id].donvi_quantrac + '</td>';
                content += '<td class="text-bold text-center table-feat-info" colspan="1">' + thongso[id].nam_kq + '</td>';
                content += '</tr>'; 
            }
            content += '</tbody>'; 
            content += '</table>';   
        }
    }
        content += '</tbody>';
        content += '</table>';
  
    return content;
}

