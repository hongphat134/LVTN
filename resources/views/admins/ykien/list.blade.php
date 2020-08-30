@extends('admins.layouts.master')
@section('content')
<div class="content-page">
<!-- Start content -->
	<div class="content">

	    <div class="">
	        <div class="page-header-title">
	            <h4 class="page-title">Thu thập ý kiến người dùng</h4>
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
				        	@if(!empty($opinion_list))
				            <div class="card-body">
				                <h4 class="m-b-30 m-t-0">
				                	Danh sách ý kiến người dùng (Tổng cộng có {{$opinion_list->count()}} ý kiến)                                 
				                </h4>
				                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
				                    <thead>
				                    <tr>
				                        <th>ID</th>				                        
				                        <th>Loại</th>
				                        <th>Tên</th>
				                        <th>Ngày tạo</th>
				                        <th>Thao tác</th>
				                    </tr>
				                    </thead>
				                    <tbody>
				                    @foreach($opinion_list as $opinion)
				                    <tr>
				                    	<td>{{$opinion->id}}</td>
				                    	<td>{{$opinion->loai}}</td>
				                    	<td>{{$opinion->ten}}</td>
				                    	<td>{{date('h:i:s d/m/Y',strtotime($opinion->updated_at))}}</td>
				                    	<td>
				                    		<a href="{{url('administrators/thu-thap-y-kien/them',$opinion->id)}}"><button class="btn btn-primary">Thêm vào</button></a>
				                    		<a href="{{url('administrators/thu-thap-y-kien/xoa',$opinion->id)}}"><button class="btn btn-danger">Xoá bỏ</button></a>
				                    	</td>
				                    </tr>
				                    @endforeach				                    
				                	</tbody>
				                </table>
				            </div>
				            @else <h4>Không có ý kiến nào cả!</h4>
				            @endif
				         </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection