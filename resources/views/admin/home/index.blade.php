@extends("admin.layouts.app")

@section("content")
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Thông tin điểm lấy mẫu quan trắc 
            </h4>
            <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng số lượng bản đồ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tong}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                           <a href="#"> <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div> </a>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">20%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                   
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Tin góp ý/liên hệ chưa xem
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mailCount}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Số lượng bản đồ qua các năm</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                       
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"style="width: 100%; height:400px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <!-- <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                               
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                             
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart" style="width: 100%; height:330px;"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Tỷ lệ các lớp dữ liệu</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                                <!-- Card Body -->
                                
                                <div class="card-body">
                                <div class="combobox-container">
                                    <select id="yearselect" class="combobox">
                                    <option value="">Tất cả cá<!--  --> Năm</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->year }}">Năm {{ $year->year }}</option>
                                @endforeach
                                    </select>
                                </div>
                               
                                    <div class="chart-pie pt-4 pb-2">
                                    <div id="chartdiv" style="width: 100%; height:300px"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                           

                                    <!-- Project Card Example -->
                                    <!-- <div class="card shadow mb-4" >
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="small font-weight-bold">Server Migration <span
                                                        class="float-right">20%</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h4 class="small font-weight-bold">Sales Tracking <span
                                                        class="float-right">40%</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h4 class="small font-weight-bold">Customer Database <span
                                                        class="float-right">60%</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar" role="progressbar" style="width: 60%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h4 class="small font-weight-bold">Payout Details <span
                                                        class="float-right">80%</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h4 class="small font-weight-bold">Account Setup <span
                                                        class="float-right">Complete!</span></h4>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    -->

                                    <!-- Color System -->
                                

                                <!-- Scroll to Top Button-->
                        </div>
                    </div>
    <!---------------------------------------------------------------------------------------------------->
    <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>    
          <script src="{{asset('assets/admin/js/chartjs.js')}}"></script>
        
        </div>
    </div>
</div>
<script>
    var ctx = document.getElementById("myAreaChart").getContext("2d");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: "Số lượng",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return '' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
    function updateChart(labels, data) {
        myLineChart.data.labels = labels;
        myLineChart.data.datasets[0].data = data;
        myLineChart.update();
    }
            // Example AJAX call to retrieve data
    function createLineChart()
    {
        $.ajax({
            url: '{{route("columnchart.admin")}}', // Replace with your API endpoint
            method: 'GET',
            success: function(response) {

                // Kiểm tra xem dữ liệu nhãn có tồn tại không và có phải là mảng không
                if (Array.isArray(response) && response.length > 0) {
                    var labels = response.map(item => item.year);
                    var data = response.map(item => item.number_of_ids);
            
                    // Cập nhật biểu đồ với dữ liệu mới
                    updateChart(labels, data);
                } else {
                    console.error('Không có dữ liệu nhãn hợp lệ từ API');
                    // Xử lý trường hợp không có dữ liệu nhãn
                }
            },
        });
    }




      //bieu do tron
 $(document).ready(function() {
    createLineChart();
        // createLineChart();
     // Sự kiện khi combobox thay đổi giá trị
     $('#yearselect').change(function() {
         var selectedYear = $(this).val(); // Lấy giá trị của option đã chọn
         // Gửi yêu cầu AJAX để lấy dữ liệu từ server
         $.ajax({
             url: '{{route("piechart.admin")}}',
             type: 'GET',
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data: {
                 year: selectedYear
             },
             success: function(response) {
                 console.log(response);
                 var chartData = response.map(function(item) {
                  return {
                      "category": item.category_name,
                      "count": item.number_of_maps
                  };
              });
                 // Xóa biểu đồ cũ nếu đã tồn tại
                 if (chart) {
                     chart.dispose(); // Giải phóng biểu đồ hiện tại nếu tồn tại
                 }
               
                 chart = drawChart(chartData);
                 console.log('Dữ liệu đã được gửi thành công lên server');
             },
             error: function(xhr, status, error) {
                 console.error('Lỗi khi gửi yêu cầu AJAX:', error);
             }
         });
     });
    //  var selectedYear = $(this).val();
     // AJAX để lấy dữ liệu ban đầu khi trang được tải
     $.ajax({
         url: '{{route("piechart.admin")}}', // Đảm bảo rằng đường dẫn này khớp với đường dẫn trong Laravel Route
         type: 'GET',
         headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            //  data: {
            //      year: selectedYear
            //  },
         success: function(response) {
             // Xử lý dữ liệu nhận được
             var chartData = [];
             response.forEach(function(item) {
                 chartData.push({
                     "category": item.category_name,
                     "count": item.number_of_maps // Thay category bằng tên cột dùng để làm trục X trong biểu đồ
                 });
             });
 
             // Gọi hàm vẽ biểu đồ ban đầu với dữ liệu từ server
             chart = drawChart(chartData);
         },
         error: function(xhr, status, error) {
             console.error('Lỗi khi gửi yêu cầu AJAX:', error);
         }
     });
 
     // Hàm vẽ biểu đồ
    function drawChart(chartData) {
        am4core.useTheme(am4themes_animated);
        //   console.log(chartData)
        // Tạo và cấu hình biểu đồ AmCharts
        var newChart = am4core.create("chartdiv", am4charts.PieChart);
        newChart.data = chartData;
    
        var pieSeries = newChart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "count";
        pieSeries.dataFields.category = "category";
        pieSeries.slices.template.tooltipText = "{category}: {value.value}";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
    
        newChart.legend = new am4charts.Legend();
    
        return newChart;
        }
    });
 // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Direct", "Referral", "Social"],
    datasets: [{
      data: [55, 30, 15],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
    },
    legend: {
      display: false
    },
   
  },
});
</script>
@endsection("content")