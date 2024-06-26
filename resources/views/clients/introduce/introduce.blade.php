

@extends("clients.layouts.app")

@section("content")
<script src="{{asset('assets/vendor/swiffy/slider.min.js')}}" crossorigin="anonymous" defer></script>
<link href="{{asset('assets/vendor/swiffy/slider.min.css')}}" rel="stylesheet" crossorigin="anonymous">

    <div class="container content-d">
        <div class="tab-content-map">
            <div class="row">
                <div class="col-md-9 table-showmap">
                    <div class="header title-news-mini" style="margin-top:10px">
                        <h3>Giới thiệu</h3>
                    </div>         
                    <div class="table-map">
                        <div class="wrapper_tabcontent background-imgae-show">
                            <div class="contentMapCategory ">
                                <div class="tabcontent2">
                        <p>Xây dựng cơ sở dữ liệu và phần mềm hỗ trợ thu thập, quản lý và khai thác cơ sở dữ liệu về tài nguyên và môi trường tỉnh Tiền Giang được tổ chức lưu trữ trong một cơ sở dữ liệu tập trung và hoàn thiện hệ thống thông tin tài nguyên và môi trường của tỉnh Tiền Giang làm cơ sở nền tảng cho các yêu cầu sau:

    Xây dựng cơ sở dữ liệu về tài nguyên và môi trường hiện đang lưu trữ tại Sở Tài nguyên và Môi trường thành một hệ thống và tiến hành xử lý, công bố danh mục dữ liệu theo đúng quy định của Nghị định 102/2008/NĐ-CP và Thông tư số 07/2009/TT-BTNMT cho cộng đồng và doanh nghiệp tra cứu.
    Nâng cao hiệu quả tham mưu quản lý nhà nước về tài nguyên và môi trường trong toàn ngành.
    Đáp ứng yêu cầu sử dụng khai thác thông tin tài nguyên và môi trường của các ngành trong phát triển kinh tế xã hội của tỉnh.
    Tránh lãng phí tiền của cho việc đầu tư điều tra cơ bản mà khai thác một cách rời rạc, không được theo dõi cập nhật kém hiệu quả.
    Tăng cường tính thống nhất về thông tin giữa các cấp trong lĩnh vực tài nguyên và môi trường.
    Nâng cao năng lực của cán bộ ngành tài nguyên và môi trường, hiện đại hóa công tác quản lý đáp ứng yêu cầu cải cách hành chính, thu hút đầu tư.</p>
                                </div>
                            <!-- Tab links -->
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-3 box-list-mini"> 
                     @include("clients.layouts.ads")
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