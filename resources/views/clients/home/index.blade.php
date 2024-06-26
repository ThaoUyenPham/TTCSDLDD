

@extends("clients.layouts.app")

@section("content")
<script src="{{asset('assets/vendor/swiffy/slider.min.js')}}" crossorigin="anonymous" defer></script>
<link href="{{asset('assets/vendor/swiffy/slider.min.css')}}" rel="stylesheet" crossorigin="anonymous">
    <style>
    </style>
    <div class="container content-d">
        <div class="tab-content-map">
            <div class="row">                   
                <div class="col-md-9 table-showmap">
                    @if (session('errors'))
                        <div class="alert alert-danger">
                            {{ session('errors') }}
                        </div>
                    @endif
                    <div class="show-tabs">
                        <div class="header title-news-mini" style="margin-top:10px">
                            <h3>Bản đồ mới nhất</h3>
                        </div>  
                        <div class="tabs">
                            @foreach($categories as $category)
                                <button class="tablinks  {{ $loop->iteration==5 ? 'active' : '' }}" data-electronic="a{{ $category->id }}">{{ $category->name }}</button>
                            @endforeach
                        </div>
                        <!-- Tab content -->
                        <div class="wrapper_tabcontent background-imgae-show">
                            @foreach($categories as $category)
                                <div id="a{{$category->id}}" class="tabcontent {{ $loop->iteration==5 ? 'active' : '' }}">
                                    @if(count($dataMap2[$category->id])>0)
                                         @foreach($dataMap2[$category->id] as $itemMap)
                                         <div class="card">
                                            <div class="card-image-container">
                                                <div class="card-title-overlay-top">
                                                    <h2 class="card-title">{{$itemMap->year}}</h2>
                                                </div>
                                                <img src="{{asset('storage/images/')}}/{{$itemMap->thumbnail}}" alt="Map Image" class="card-image">
                                                <div class="card-title-overlay">
                                                    <h2 class="card-title">{{$itemMap->name}}</h2>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <p class="card-description">{{$itemMap->summary}}</p>
                                            </div>
                                            <div class="card-hover">
                                                <a href="{{route('map',$itemMap->id)}}"><button class="view-map-button">Xem Bản Đồ</button></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                        <!-- Tab links -->
                </div>
                <div class="col-md-3 box-list-mini"> 
                    @include("clients.layouts.ads")
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3 box-list-mini">
                </div>
            </div>
        </div>
    </div>
    <script>
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
    </script>

@endsection("content")