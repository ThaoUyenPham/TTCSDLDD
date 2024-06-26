@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Chi tiết huyện thuộc địa phận
            </h4>
            <div class="row">
                <div class="col-md-12">
                
                </div>
            </div>
            <div class="row"> <!-- khung tìm kiếm -->
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên DVHC</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforDistricts->tenDVHC}}" id="tenDVHC" placeholder="Tên DVHC" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Thuộc địa phận</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="{{$inforDistricts->note}}" id="note" placeholder="Tên thuộc địa phận" type="text">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tọa Độ X</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" value="{{$inforDistricts->valueX}}" class="form-control input-sm" id="valueX" placeholder="Tọa độ X">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tọa Độ Y</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" value="{{$inforDistricts->valueY}}" class="form-control input-sm" id="valueY" placeholder="Tọa độ Y">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Zoomm</b>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" value="{{$inforDistricts->zoomm}}" class="form-control input-sm" id="zoom" placeholder="Zoom">
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-12">
                    
                 </div>
            </div> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm" id="updateDistrict">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Cập nhật</span>
                        </a>
                        <a href="{{route('index.district.admin')}}" class="btn btn-primary btn-sm" id="">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Quay về</span>
                        </a>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#updateDistrict').click(function(){

        let tenDVHC=$('#tenDVHC').val();
        let note=$('#note').val();
        let valueX=$('#valueX').val();
        let valueY=$('#valueY').val();
        let zoom=$('#zoom').val();
        let nativeSRS = "{{ $inforDistricts->id }}";
        let editUrl = '{{ route("update.district.admin", ":id") }}';
            editUrl = editUrl.replace(':id', nativeSRS);
        if(confirm("Bạn có muốn cập nhật "))
        {
            if(tenDVHC==""||note==""){
                Swal.fire(
                    'Thông báo',
                    'Cảnh báo tên không được để trống',
                    'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                );
            }else{
                $.ajax({
                    type: 'PUT',
                    url: editUrl,
                    data: {
                        tenDVHC:tenDVHC,
                        note:note,
                        valueX:valueX,
                        valueY:valueY,
                        zoom:zoom,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                    },
                    success: function(response) {
                        if(response.success=1)
                        {
                            Swal.fire(
                                'Thông báo',
                                'Cập nhật thành công',
                                'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                            // window.location.href = backUrl;
                        }else {
                            Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            );
                            console.log(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng kiểm tra lại',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            );
                        console.error(xhr.responseText);
                        console.error('Status: ' + status);
                        console.error('Error: ' + error);
                    }
                });
            }  
        }
    })
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")