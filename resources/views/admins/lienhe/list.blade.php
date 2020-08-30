@extends('admins.layouts.master')
@section('content')
<div class="content-page">
<!-- Start content -->
    <div class="content">

        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">Danh sách thông tin liên hệ</h4>
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{session('success')}} <a href="#" class="alert-link">Alert Link</a>.
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{session('error')}} <a href="#" class="alert-link">Alert Link</a>.
                </div>
                @endif
            </div>
        </div>

        <div class="page-content-wrapper">                    
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">                     
                        <div class="card">
                            @if(!empty($contact_list))
                            <div class="card-body">
                                <h4 class="m-b-30 m-t-0">
                                    Danh sách thông tin liên hệ (Tổng cộng có {{$contact_list->count()}} thông tin)                                 
                                </h4>
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email gửi</th>                                 
                                        <th>Họ tên</th>
                                        <th>Tiêu đề</th>                                        
                                        <th>Trạng thái</th>
                                        <th>Ngày gửi</th>
                                        <th>Thao tác</th>
                                        <th>Nội dung</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contact_list as $contact)
                                    <tr>
                                        <td>{{$contact->id}}</td>
                                        <td>{{$contact->from_email}}</td>
                                        <td>{{$contact->ho.' '.$contact->ten}}</td>
                                        <td>{{$contact->tieude}}</td>
                                        
                                        <td>
                                            {{$contact->trangthai == 0 ? 'Chưa xử lý' : 'Đã xử lý'}}
                                        </td>
                                        <td>{{date('d/m/Y',strtotime($contact->created_at))}}</td>
                                        <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn-small btn-light waves-effect" data-toggle="modal" data-target="#feedback{{$contact->id}}-modal">Phản hồi</button>
                                        </div>
                                        </td>
                                        <td>{!! nl2br($contact->noidung) !!}</td>
                                    </tr>
                                    <!-- Feedback Modal -->
                                    <div id="feedback{{$contact->id}}-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="{{route('feedback',$contact->id)}}" method="get">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title m-0" id="custom-width-modalLabel">Phản hồi</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Tiêu đề: {{$contact->tieude}}</h4>
                                                    <p><h5>Nội dung:</h5>{{$contact->noidung}}.</p>
                                                    <hr>

                                                    <h4>Trả lời</h4>
                                                    <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Đóng</button>
                                                    <button type="submit" waves-effect waves-light">Feedback</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                            </form>
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal --> 
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else <h4>Không có thông tin liên hệ nào cả!</h4>
                            @endif
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection