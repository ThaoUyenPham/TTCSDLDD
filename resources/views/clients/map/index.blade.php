

@extends("clients.layouts.app")

@section("content")
<script src="{{asset('assets/vendor/swiffy/slider.min.js')}}" crossorigin="anonymous" defer></script>
<link href="{{asset('assets/vendor/swiffy/slider.min.css')}}" rel="stylesheet" crossorigin="anonymous">
<link href="{{URL::asset('assets/vendor/chosen_v1.8.7/chosen.css')}}" rel="stylesheet"/>
<script src="{{asset('assets/vendor/chosen_v1.8.7/chosen.jquery.min.js')}}"></script>

    <div class="container content-d">
        <div class="tab-content-map">
            <div class="row">
                <div class="col-md-9 table-showmap">
                    <div class="header title-news-mini" style="margin-top:10px">
                        <h3>Bản đồ</h3>
                    </div>               
                    <div class="table-map ">
                        <div class="contentMapCategory">
                            <div class="row">
                                <h2></h2>
                                <div class="col-md-6">
                                    <form class="form-horizontal  pdd-right-30 ">
                                        <div class="form-group row list-ctkt">
                                            <label style="margin-top: 7px" class="col-md-6 control-label">
                                                <b>Cấp</b>
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control input-sm" id="level">
                                                    <option value="">-- Chọn cấp bản đồ --</option>
                                                    <option value="2">Cấp huyện Tiền Giang</option>
                                                    <option value="1">Cấp tỉnh Tiền Giang</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </form>
                                </div>    
                                <div class="col-md-6">
                                    <form class="form-horizontal  pdd-right-30">
                                        <div class="form-group row list-ctkt">
                                            <label style="margin-top: 7px" class="col-md-6 control-label">
                                                <b>Năm</b>
                                            </label>
                                            <div class="col-md-6">
                                                <select multiple  class="form-control input-sm" id="yearSelect" name="year" data-placeholder="-- Lựa Chọn Năm --"></select>
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                            
                            </div>
                            <div class="row">
                                <h2></h2>
                                <div class="col-md-6">
                                    <form class="form-horizontal  pdd-right-30 ">
                                        <div class="form-group row list-ctkt">
                                            <label style="margin-top: 7px" class="col-md-6 control-label">
                                                <b>Huyện/Thị xã/Thành phố</b>
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control input-sm" id="district_id">
                                                    <option value="">-- Lựa Chọn Huyện/Thị xã/Thành phố --</option>
                                                    @foreach($districts as $district)
                                                        <option value="{{$district->id}}">{{$district->tenDVHC}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                        
                                <div class="col-md-6">
                                    <form class="form-horizontal  pdd-right-30">
                                        <div class="form-group row list-ctkt">
                                            <label style="margin-top: 7px" class="col-md-6 control-label">
                                                <b>Danh mục bản đồ</b>
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control input-sm" id="category_id">
                                                    <option value="">-- Chọn Danh Mục --</option>
                                                    @foreach($categoriesload as $category)
                                                        <option value="{{$category->id}}"  {{ $idCategory==$category->id ?'selected':''}} >{{$category->name}}</option>
                                                            @if(count($category->children)>0)
                                                                    @foreach($category->children as $children)
                                                                        <option value="{{$children->id}}"  {{ $idCategory==$children->id ?'selected':''}} >--{{$children->name}}</option>    
                                                                    @endforeach
                                                            @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                            
                            </div>
                        </div>
                        <div class="header" style="margin-top:10px;">
                            <h3>Danh sách bản đồ </h3>
                        </div>     
                        <div class="row" style="min-height:500px">
                            <div class="wrapper_tabcontent background-imgae-show">
                                <div class="tabcontent active " id="loadMapCategory">
                                </div>
                            </div>
                        </div>
                    </div>
                

                    <!-- Tab links -->
                </div>
                <div class="col-md-3 box-list-mini"> 
                    @include("clients.layouts.ads")
                </div>
            </div>
        </div>
    </div>
    <script>
        // $("#yearSelect").chosen({max_selected_options: 5, width:'100%'});   
        $(document).ready(function() {
            const select2 = $('#yearSelect');
            const currentYear = new Date().getFullYear();
            const startYear = 2000; // Năm bắt đầu, bạn có thể thay đổi theo ý muốn
            select2.append(`<option value=""> --Chọn năm-- </option>`);
            for (let year = startYear; year <= currentYear; year++) {
                select2.append(`<option value="${year}">${year}</option>`);
            }
            $("#yearSelect").chosen({max_selected_options: 5, width:'100%'});   
            // Tự động chọn năm hiện tại
            // select2.val('');
        });
        var tabLinks = document.querySelectorAll(".tablinks");
        var tabContent =document.querySelectorAll(".tabcontent");

        tabLinks.forEach(function(el) {
            el.addEventListener("click", openTabs);
        });
        function openTabs(el) {
            var btn = el.currentTarget; // lắng nghe sự kiện và hiển thị các element
            var electronic = btn.dataset.electronic; // lấy giá trị trong data-electronic
            
            tabContent.forEach(function(el) {
                el.classList.remove("active");
            }); //lặp qua các tab content để remove class active

            tabLinks.forEach(function(el) {
                el.classList.remove("active");
            }); //lặp qua các tab links để remove class active

            document.querySelector("#" + electronic).classList.add("active");
            // trả về phần tử đầu tiên có id="" được add class active
            
            btn.classList.add("active");
            // các button mà chúng ta click vào sẽ được add class active
        }
        function ShowMapCategory() {
                let category_id= $("#category_id").val();
                let year= $("#yearSelect").val();
                let level= $("#level").val();
                let district_id= $("#district_id").val();
                $.ajax({
                    type:'POST',
                    url:'{{route("loadlist.map.client")}}',
                    data:{
                                chooseDistrict:district_id,
                                findYear:year,
                                chooseCategory:category_id,
                                chooseLevel:level,
                            } ,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')  },
                    //  dataType: "json",
                    success:function(response){
                        // console.log(response);
                        let htmlCardMap='';
                        $('#loadMapCategory').empty();
                        for (let i = 0; i < response.data.length; i++) {
                            let editUrl = '{{ route("map", ":id") }}';
                            editUrl = editUrl.replace(':id', response.data[i].id);
                            htmlCardMap+=`
                                    <div class="card">
                                        <div class="card-image-container">
                                            <div class="card-title-overlay-top">
                                                    <h2 class="card-title">`+response.data[i].year+`</h2>
                                            </div>
                                            <img src="{{asset('storage/images/')}}/`+response.data[i].thumbnail+`" alt="Map Image" class="card-image">
                                            <div class="card-title-overlay">
                                                <h2 class="card-title">`+response.data[i].name+`</h2>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <p class="card-description">`+response.data[i].summary+`</p>
                                        </div>
                                        <div class="card-hover">
                                            <a href="`+editUrl+`"><button class="view-map-button">Xem Bản Đồ</button></a>
                                        </div>
                                    </div>`;

                        }
                        $('#loadMapCategory').html(htmlCardMap);

                    // console.log(response);
                    },
                    error: function(data){
                        console.log(data.responseText);
                    }
                });

            }
        $(document).ready(function () {
            $.noConflict();
            ShowMapCategory();
           
        });
            $("#category_id").change(function(e){
                ShowMapCategory();
            })
            $("#yearSelect").change(function(e){
                ShowMapCategory();
            })
            $("#level").change(function(e){
                ShowMapCategory();
            })
            $("#district_id").change(function(e){
                ShowMapCategory();
            })
    </script>

@endsection("content")