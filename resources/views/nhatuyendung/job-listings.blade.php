@extends('layouts.master')
@section('content')
<!-- DataTables -->

<!-- <link href="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"> -->
<!-- <link href="{{asset('admin/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"> -->

<!-- <link href="{{asset('admin/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"> -->

<!-- Buttons examples -->
<!-- <script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>

<script src="{{asset('admin/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.scroller.min.js')}}"></script> -->

<link href="{{asset('admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

<!-- Required datatable js-->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#datatable-responsive").DataTable({
            fixedHeader: !0,
            dom: "Bfrtip",
            buttons: [{
                extend: "copy",
                className: "btn-primary"
            }, {
                extend: "csv",
                className: "btn-primary"
            }, {
                extend: "excel",
                className: "btn-primary"
            }, {
                extend: "pdf",
                className: "btn-primary"
            }, {
                extend: "print",
                className: "btn-primary"
            }],            
        });
    });
</script>        
<!-- MODAL FORM DELETE -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xoá mẫu hồ sơ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có chắc chắn muốn xoá mẫu hồ sơ này không?
      </div>
      <div class="modal-footer">
        <a id="delete" href="#"><button type="button" class="btn btn-primary">Đồng ý</button></a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Danh sách hồ sơ xin việc</h1>
        <div class="custom-breadcrumbs">
          <a href="#">Home</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong>Hồ sơ xin việc</strong></span>
        </div>
      </div>
    </div>
  </div>
</section>
    
<section class="site-section services-section bg-light block__62849" id="next-section">
  <div class="container">            
      <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">
             <span class="icon-group_add mr-2"></span>Danh sách hồ sơ chờ phê duyệt <span class="icon-group_add">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
              </div>
            @endif
            </h2>
          </div>
        </div>      
      @if($job_listings->count() != 0)
      <div class="row mb-5 justify-content-center">
      <form action="{{route('recruit')}}">
        <table id="datatable-responsive" class="table table-responsive">
          <thead style="font-weight: bold">
          <tr>
            <td>Ngành tuyển dụng</td>
            <td>Số lượng cần tuyển</td>                                  
            <td>Chờ duyệt</td>         
            <td>Đã xử lý</td>         
            <td>Ngày đăng</td>
            <td>Hạn tuyển dụng</td>
            <td>Trạng thái</td>
            <td>Tìm kiếm</td>
            <td>Thao tác</td>          
          </tr>
          </thead>          
          <tbody>
          @foreach($job_listings as $job)
          <tr>
            <td>{{$job->nganh}}</td>
            <td>{{$job->soluong}} người</td>          
            <td>{{$job->hschoduyet}} hồ sơ</td> 
            <td>{{$job->hsdaxuly}} hồ sơ</td> 
            <td>{{date('d/m/Y',strtotime($job->updated_at))}}</td>
            <td>{{date('d/m/Y',strtotime($job->hantuyendung))}}</td>          
            <td>
              @if($job->ad_pheduyet == 0) <span class="badge badge-danger">Chờ duyệt</span>
              @else <span class="badge badge-success">Đã duyệt</span>
              @endif
            </td>
            <td>
              <button type="button" class="btn-small btn-dark"><a target="_blank" href="{{url('/nhatuyendung/tim-kiem-ung-vien',$job->id)}}"><span class="icon-search"></span> Ứng viên</a></button>
            </td>
            <td>
              <!-- Example split danger button -->
              <div class="btn-group">
                <button type="button" class="btn btn-info">Quản lý</button>
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">        
                <a class="dropdown-item" target="_blank" href="{{url('/nhatuyendung/ho-so-cho-duyet',$job->id)}}">Xem hồ sơ chờ duyệt</a>
                <a class="dropdown-item" target="_blank" href="{{url('/nhatuyendung/ho-so-da-xu-ly',$job->id)}}">Xem hồ sơ đã xử lý</a>           
                <a class="dropdown-item" target="_blank" href="{{route('updateJob',$job->id)}}">Cập nhật</a>
                <a class="dropdown-item call-delete" id="{{$job->id}}" data-toggle="modal" data-target="#deleteModal" href="javascript:void(0)">Xoá</a>
                <!-- <a target="_blank" href="{{url('/nhatuyendung/delete-job',$job->id)}}"></a> -->
              </div>
              </div>             
            </td>               
          </tr>          
          @endforeach
          <script>
            $(".call-delete").click(function(){
                // console.log($(this).attr('id'));
                var id = $(this).attr('id');
                          
                $("#delete").attr('href', '/nhatuyendung/delete-job/' + id);
            });
          </script> 
          </tbody>        
        </table>   
      </div>
      @else
      Bạn chưa <a href="{{url('/nhatuyendung/post-job')}}">đăng tin</a> tuyển dụng nào cả! <a href="{{url('/nhatuyendung/post-job')}}">Đăng tin tuyển dụng</a> để nhanh chóng tìm kiếm được nhân lực bạn nhé!
      @endif 
    </div>   
  </div>
</section>

@endsection