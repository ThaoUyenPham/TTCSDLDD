 /*---- Hiển thị thông tin Công trình (Panel) ----*/

/*---- Hiển thị thông tin vị trí lấy mẫu (Popup) ----*/
function sample_info(layerMap) {
    console.log(layerMap);
    let content;
    let stt=0;
    content=`
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-6">
                <div class="menu-tab">
                    <ul class="nav flex-column nav-pills">
                    <li class="" ><h6 class="" ></h6></li>`;
                    for (let i = 0; i < layerMap.length; i++) {
                        content+=`<li class="nav-item" ><h6 class="" >`+layerMap[i].nameMap+`</h6></li>`;
                        for (let j = 0; j < layerMap[i].layer.length; j++) {
                            if(stt==0)
                            {
                                stt++;
                                content+=`<li class="nav-item"><a class="nav-link active" href="#tab`+i+j+`">Lớp: `+layerMap[i].layer[j].nameLayer+`</a></li>`;      
                            }else{
                                content+=`<li class="nav-item"><a class="nav-link" href="#tab`+i+j+`">Lớp: `+layerMap[i].layer[j].nameLayer+`</a></li>`; 
                            }         
                        }
                    }
                    content+=`
                </ul>
            </div>
        </div>
      <div class="col-md-6">
        <div class="tab-content">
        `;
        stt=0;
        for (let i = 0; i < layerMap.length; i++) {
            // content+=`<li class="nav-item"><h6 class="" >`+layerMap[i].nameMap+`</h6></li>`;
            for (let j = 0; j < layerMap[i].layer.length; j++) {
                if(stt==0)
                {
                    let breakmulti=0;
                    stt++
                    content+=`
                    <div id="tab`+i+j+`" class="tab-pane fade show active">
                        <h4>Lớp: `+layerMap[i].layer[j].nameLayer+`</h4>`;
                        //load datathong so
                        layerMap[i].layer[j].data.forEach(item => {
                            if (breakmulti>0) return;
                            breakmulti++;
                            content+=`<h6>Thông số lớp `+breakmulti+`</h6>`;
                            Object.keys(item).forEach(key => {
                                if(!(item[key]==""||item[key]==null))
                                {
                                    content+=`<div class="row2 row">`+key+' : '+item[key]+`</div>`;   
                                }
                            });
                        });  
                    content+=`</div>`;
                }else{
                    let breakmulti=0;
                    stt++
                    content+=`
                    <div id="tab`+i+j+`" class="tab-pane fade show ">
                        <h4>Lớp: `+layerMap[i].layer[j].nameLayer+`</h4>`;
                        layerMap[i].layer[j].data.forEach(item => {
                            if (breakmulti>0) return;
                            breakmulti++;
                            content+=`<h6>Thông số lớp `+breakmulti+`</h6>`;
                            Object.keys(item).forEach(key => {
                                if(!(item[key]==""||item[key]==null))
                                {
                                    content+=`<div class="row2 row">`+key+' : '+item[key]+`</div>`;   
                                }
                            });
                        });  
                    content+=`</div>`;
                }
            }
        }
        content+=`
        </div>
      </div>
    </div>
  </div>`;
    return content;
}

