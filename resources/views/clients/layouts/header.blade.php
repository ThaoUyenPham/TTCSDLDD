 <!-- <div class="content-notification-line">
   <div class="scroll-text">

   </div>
 </div> -->
 <div class="marquee-container">
        <div class="marquee-text"> 
         @foreach($topadsload as $topads)
             {{$topads->describe}}
          @endforeach</div>
    </div>
 <div class="header-pan">
    <div class="container banner-csdl container-ssm">
      <img class="logo" src="https://moitruong.ttcntnmt.com.vn/logo-mt.png" alt="logo">
      <div class="text-header">
         <span class="site_text">HỆ THỐNG THU THẬP, QUẢN LÝ VÀ KHAI THÁC CSDL VỀ TN&MT TỈNH TIỀN GIANG</span>
         <br><span class="site_text_english">(SYSTEM OF COLLECTION, MANAGEMENT AND EXPLOITATION OF DATABASE ON NATURAL RESOURCES AND ENVIRONMENT OF TIEN GIANG PROVINCE)</span>
      </div>
      <!-- <span class="site_text">HỆ THỐNG THU THẬP, QUẢN LÝ VÀ KHAI THÁC CSDL VỀ TN&MT TỈNH TIỀNG GIANG</span> -->
      <div class="language">
         <ul>
            <li> <a href="{{route('lang','en')}}"><img src="{{URL::asset('assets/clients/img/english.png')}}" alt="">English</a></li>
            <li> <a href="{{route('lang','vi')}}"><img src="{{URL::asset('assets/clients/img/vietnamese.png')}}" alt="">Vietnamese</a></li>
         </ul>
         <!-- <div class="form_search">
            <form action="/action_page.php">
               <input type="text" placeholder="Tìm kiếm" name="search">
               <button type="submit"><i class="fa fa-search"></i></button>
             </form>
         </div> -->
      </div>
    </div>
 </div>