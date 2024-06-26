
// $(document).ready(function() {
//     //console.log('load');
//     $("#search_map").click(function () {
//         LoadListMap();
//     })
//     $("#delete_map").click(function(){

//     });
//     //console.log('load');
//     LoadListMap();//load lần đầu
// });
// let columns = [ //gán giá trị cho từng cột
//         {//1 id hidden
//             data: null,
//             render: function (data, type, row) {
//                 let id_map = '';
//                 if(row.id != null){
//                     id_map = row.id;
//                 }
//                 return id_map;
//             },
//             visible: false         
//         },
//         {//2
//             data: null,
//             sClass: "text-center action",
//             // targets: 0,
//             //  data: null,
//             //  defaultContent: '',
//             //  orderable: false,
//             //  className: 'select-checkbox'
//             visible: false         
//         },
//         {//3 link tới bản đồ
//             data: null,
//             // render: function (data, type, row) { 
//             //     var id_gieng = '';
//             //     if(row.id_gieng != null){
//             //         id_gieng = row.id_gieng;
//             //     }
//             //     var ma_loaiquantrac = '';
//             //     if(row.ma_loaiquantrac != null){
//             //         ma_loaiquantrac = row.ma_loaiquantrac;
//             //     }
//             //     return '<button class="map_click_ btn-xs btn-outline-info" onclick="hiemthiid('+ id_gieng +','+ ma_loaiquantrac +
//             //             ');"><i class="fa fa-map-marker font-size-12"></i></button>';
//             // },
//             sClass: "text-center action",
//             width: '7%',
//         },

//         // {//Số thứ tự
//         //     data: null,
//         //     render: function (data, type, row) {
//         //         var STT = '';
//         //         if(row.STT != null){
//         //             STT = row.STT;
//         //         }
//         //         return STT;
//         //     },
//         //     sClass: "text-center",
//         //     width: '5%',
//         // },

//         {//Ký hiệu điểm
//             data: null,
//             render: function (data, type, row) {
//                 let name_map = '';
//                 if(row.name != null){
//                     name_map = row.name;
//                 }
//                 let id_map = '';
//                 if(row.id != null){
//                     id_map = row.id;
//                 }
//                 return '<a href="form-ViTriLayMau.php?&id='+ id_map +'">'+ name_map +'</a>';
//             },
//             sClass: "text-center",
//             width: '10%',
//         },
//         {//vị trí điểm
//             data: null,
//             render: function (data, type, row) {
//                 var cap_tinh = '';
//                 if(row.cap_tinh != null){
//                     cap_tinh= row.cap_tinh;
//                 }
//                 return '<a href="form-ViTriLayMau.php?&id='+ row.id +'">'+ cap_tinh +'</a>';
//             },
//             width: '30%',
//         },
//         // {//tọa độ X
//         //     data: null,
//         //     render: function (data, type, row) {
//         //         var toadoX = '';
//         //         if(row.toadoX != null){
//         //             toadoX= row.toadoX;
//         //         }
//         //         return toadoX;
//         //     }, 
//         //     sClass: "text-center"
//         // },
//         // {//tọa độ Y
//         //     data: null,
//         //     render: function (data, type, row) {
//         //         var toadoY = '';
//         //         if(row.toadoY != null){
//         //             toadoY= row.toadoY;
//         //         }
//         //         return toadoY;
//         //     },
//         //     sClass: "text-center"
//         // },
//         // {//Loại quan trắc
//         //     data: null,
//         //     render: function (data, type, row) {
//         //         var LoaiQuanTrac = '';
//         //         if(row.LoaiQuanTrac != null){
//         //             LoaiQuanTrac= row.LoaiQuanTrac;
//         //         }
//         //         return  row.LoaiQuanTrac;
//         //     }, 
//         // },
//         {//số tờ
//             data: null,
//             render: function (data, type, row) {
//             let note = '';
//             if(row.note != null){
//                 note= row.note;
//             }
//             return note;
//         }, 
//         }
// ];

// function LoadListMap() {
//     let choose_district = $("#choose_district").val();
//     let choose_year = $("#choose_year").val();
//     let choose_category = $("#choose_category").val();
//     let choose_level = $("#choose_level").val();
//     let find_name = $("#find_name").val();
//     if ( $.fn.dataTable.isDataTable( '#load_data_map' ) ) {
//         text = "Danh sach Diem";
//         table = $('#load_data_map').DataTable();
//         table.destroy();
//         table = $('#load_data_map').DataTable({
//             columns: columns,     
//             columnDefs: [ {
//                 formatter: "rowSelection",
//                 titleFormatter: "rowSelection",
//                 frozen: true,
//                 hozAlign: "center",
            
//                 headerSort: false,
//                 orderable: false,
//                 className: 'select-checkbox',
//                 targets:   0,
//                 },
//                 {
//                     "defaultContent": "-",
//                     "targets": "_all"
//                 },
//             ],
//             select: {
//                 style: 'multi',
//                 selector: 'td:first-child'
//             },
//             order: [[ 1, 'asc' ]],
//             dom: 'Bfrtip',
//             buttons: [
//                 'copy','print',
//                 {
//                     extend: "excelHtml5",
//                     text: "Xuất Excel",
//                     className: "btn-sm",
//                     init: function (api, node, config) {
//                         //$(node).removeClass("dt-button");
//                     },
//                     filename: function () {
//                         var date_edition = moment().format("YYYY-MM-DD HH[h]mm");
//                         return text + " (" + date_edition + ")" ;
//                     },
//                     sheetName: "sheet1",
//                     title: text,
//                     customize: function (xlsx) {
//                         var sheet = xlsx.xl.worksheets["sheet1.xml"];
//                         $("row c", sheet).attr("s", "25");
//                         $("row:nth-child(2) c", sheet).attr("s", "47");
//                         $('row c[r="A1"]', sheet).attr("s", "51");
//                         var styleSheet = xlsx.xl["styles.xml"];
//                         var tagName = styleSheet.getElementsByTagName("sz");
//                         for (i = 0; i < tagName.length; i++) {
//                             tagName[i].setAttribute("val", "14");
//                         }
//                     },
//                     exportOptions: {
//                         columns: ':visible :not(.action)'
//                     },
//                     messageBottom: null
//                 },
//                 {
//                     extend: "pdfHtml5",
//                     text: "Xuất PDF",
//                     className: "btn-sm",
//                     orientation: "landscape",
//                     title: text,
//                     filename: function () {
//                         var date_edition = moment().format("YYYY-MM-DD HH[h]mm");
//                         //var selected_machine_name = fileNameExport;
//                         return text + " (" + date_edition + ")" ;
//                     },
//                     customize: function (doc) {
                 
//                     },
//                     exportOptions: {
//                         columns: ':visible :not(.action)'
//                     },
//                     messageBottom: null
//                 }, 
//             ],
//             ajax: {
//                 url:"{{ route('load_setmap')}}",
//                 type: 'POST',
//                 data:{
//                     "choose_district": choose_district,
//                     "choose_year": choose_year,
//                     "choose_category": choose_category, 
//                     "choose_level": choose_level, 
//                     "find_name": find_name,
//                 } ,
//                 complete: function(xhr, responseText){
                   
//                 }
//             } 
//         })
//     }
//     $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
// }


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
$.ajax({
    url: 'map/loadsetmap',
    method: 'POST',
    dataType: "json",
    data: $(this).serialize(),

    success: function(response) {
        // Xử lý kết quả trả về
        console.log(response);
    },
    error: function(xhr, status, error) {
        // Xử lý lỗi (nếu có)
        console.error(error);
    }
});
// $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

