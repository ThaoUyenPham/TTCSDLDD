<div class="show_sieudulieu" >
    <div class="box-news-list-container">
        <h3 class="title-news-mini">Liên kết website</h3>
        <div class="news-container" style="text-align: center">
            @foreach($adsload as $ads)
                <a class="text-decoration-none" target="_blank" href="{{$ads->link}}">
                    <div class="navlinkopen imgbackgroundlink">
                        <img src="{{asset('storage/images/')}}/{{$ads->thumbnail}}" alt="Placeholder Image" class="img-fluid" style="float: left">
                        <div class="text-news heighttext" >
                            <h6>{{$ads->name}}</h6>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>