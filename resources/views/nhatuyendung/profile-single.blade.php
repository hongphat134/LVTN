@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Thông tin hồ sơ</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Thông tin hồ sơ</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section block__18514" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mr-auto">
            <div class="border p-4 rounded">
          	<ul class="list-unstyled block__47528 mb-0">
                <li><span class="active"><h3>{{$profile->nganh}}</h3></span></li>
                <li>Email liên hệ: <a href="#">{{$profile->emaillienhe}}</a></li>
                <li>Khu vực sinh sống: <a href="#">{{$profile->khuvuc}}</a></li>
                <li>Tình trạng hôn nhân: <a href="#">{{$profile->honnhan}}</a></li>
                <li>Hình thức mong muốn: <a href="#">{{$profile->trangthailv}}</a></li>
                <li>Bằng cấp cao nhất: <a href="#">{{$profile->bangcap}}</a></li>
                <li>Cấp bậc cao nhất: <a href="#">{{$profile->capbac}}</a></li>
                <li>Kinh Nghiệm: <a href="#">{{$profile->kinhnghiem}}</a></li>
    		    </ul>
            </div>    

            <div class="border p-4 rounded">
            <h3>Kĩ năng</h3>
            @foreach(json_decode($profile->kinang) as $kinang)
            <div><span class="icon-hand-o-right">{{$kinang}}</span></div>
            @endforeach
            </div>

            <div class="border p-4 rounded">
            <h3>Ngoại ngữ</h3>
            @foreach(json_decode($profile->ngoaingu) as $ngoaingu)
            <div><span class="icon-language mx-2">{{$ngoaingu}}</span></div>
            @endforeach
            </div>

            <div class="border p-4 rounded">
            <h3>Tin học</h3>
            @foreach(json_decode($profile->tinhoc) as $tinhoc)
            <div><span class="icon-caret-right mr-2">{{$tinhoc}}</span></div>
            @endforeach
            </div>

          </div>
          <div class="col-lg-8">
            <span class="text-primary d-block mb-5">
              <div class="thumbnail">
                <img src="{{url('hinhdaidien/'.$profile->hinh)}}" alt="Không có hình" class="img-thumbnail img-responsive">
                <div class="caption">
                  <p><h3>{{$profile->hoten}} - {{ date('d/m/Y',strtotime($profile->updated_at))}}</h3></p>
                </div>
              </div>
            </span>
            <h2 class="mb-4">Mục tiêu</h2>
           
            <p>{!! nl2br($profile->muctieu) !!}</p>                      
            <h2 class="mb-4">Sở trường</h2>
            <p>{!! nl2br($profile->sotruong) !!}</p>           
            <p>
              <div class="border p-3">
              <span class="icon-asterisk mr-2"></span><strong><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter">Ngỏ ý</a></strong> giúp người tìm việc biết bạn đang quan tâm hồ sơ của họ. <span class="icon-hand-o-right mr-2">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                Ngỏ ý
              </button>
              </div>             
              @if(Auth::user()->theodoi)
                @if(in_array($profile->id,json_decode(Auth::user()->theodoi)))
                <a id="{{$profile->id}}" href="javascript:void(0)" class="btn btn-danger btn-md mt-4 save-profile active">
                  Đã lưu hồ sơ
                </a>
                @else
                <a id="{{$profile->id}}" href="javascript:void(0)" class="btn btn-danger btn-md mt-4 save-profile">
                  Lưu hồ sơ xin việc
                </a>                
                @endif
              @else
              <a id="{{$profile->id}}" href="javascript:void(0)" class="btn btn-danger btn-md mt-4 save-profile">
                Lưu hồ sơ xin việc
              </a>
              @endif
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thư ngỏ ý</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/nhatuyendung/ngo-y')}}" method="post">
          {{csrf_field()}}
        <div class="form-group">
          <label for="comment">Lời nhắn:</label>
          <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
        </div>

        <div class="form-group">
          <label for="comment">Email nhận phản hồi</label> &nbsp;
          <input type="email" name="email" placeholder="Nhập Email..." value="{{Auth::user()->email}}">
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-info">Gửi thông tin</button>
      </div>
      </form>
    </div>
  </div>
</div>

    <script src="{{url('ajax/save-profile.js')}}"></script>
@endsection