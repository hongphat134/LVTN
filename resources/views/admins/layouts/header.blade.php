<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Admin Dashboard" name="description">
        <meta content="ThemeDesign" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Trang quản trị viên</title>

        <link rel="shortcut icon" href="{{asset('admin\images\favicon.ico')}}">

        <!--Morris Chart CSS -->
       <!--  <link rel="stylesheet" href="{{asset('admin\plugins\morris\morris.css')}}"> -->

        <link href="{{asset('admin\css\bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin\css\icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin\css\style.css')}}" rel="stylesheet" type="text/css">

        <!-- jQuery  -->
        <script src="{{asset('admin\js\jquery.min.js')}}"></script>

        <!-- DataTables -->
        <link href="{{asset('admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Required datatable js-->
        <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>

        <script src="{{asset('admin/plugins/datatables/jszip.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/pdfmake.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/vfs_fonts.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/buttons.html5.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/buttons.print.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/dataTables.scroller.min.js')}}"></script>

        <!-- Responsive examples -->
        <script src="{{asset('admin/plugins/datatables/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <!-- <script src="{{asset('admin/pages/datatables.init.js')}}"></script> -->
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

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{url('/administrators')}}" class="logo"><img src="{{asset('admin\images\logo.png')}}" alt="logo-img"></a>
                        <a href="{{url('/administrators')}}" class="logo-sm"><img src="{{asset('admin\images\logo_sm.png')}}" alt="logo-img"></a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                

                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                            <li class="hide-phone app-search float-left">
                                <form role="search" class="navbar-form">
                                    <input type="text" placeholder="Search..." class="form-control search-bar">
                                    <a href="" class="btn-search"><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul>
    
                        <ul class="nav navbar-right float-right list-inline">
                            <li class="dropdown d-none d-sm-block">
                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light notification-icon-box" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-bell"></i> <span class="badge badge-xs badge-danger"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="text-center notifi-title">Notification <span class="badge badge-xs badge-success">3</span></li>
                                    <li class="list-group">
                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="media-heading">Your order is placed</div>
                                                <p class="m-0">
                                                <small>Dummy text of the printing and typesetting industry.</small>
                                                </p>
                                            </div>
                                        </a>
                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="media-body clearfix">
                                                <div class="media-heading">New Message received</div>
                                                <p class="m-0">
                                                    <small>You have 87 unread messages</small>
                                                </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="media-body clearfix">
                                                <div class="media-heading">Your item is shipped.</div>
                                                <p class="m-0">
                                                    <small>It is a long established fact that a reader will</small>
                                                </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- last list item -->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <small class="text-primary">See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="d-none d-sm-block">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="mdi mdi-fullscreen"></i></a>
                            </li>
                            
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <img src="{{asset('admin\images\users\avatar-1.jpg')}}" alt="user-img" class="rounded-circle">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0)" class="dropdown-item"> Profile</a></li>
                                    <li><a href="javascript:void(0)" class="dropdown-item"><span class="badge badge-success float-right">5</span> Settings </a></li>
                                    <li><a href="javascript:void(0)" class="dropdown-item"> Lock screen</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a href="#" 
                                        onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();" class="dropdown-item"> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            <!-- Top Bar End -->