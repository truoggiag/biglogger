
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="/template-admin/production/images/favicon.ico" type="image/ico" />

    <title>{{$data['title']}}</title>

    <!-- Bootstrap -->
    <link href="/template-admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/template-admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/template-admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/template-admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="/template-admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/template-admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="/template-admin/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/template-admin/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Biglogger</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="/template-admin/production/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>

                 <h2>{{session()->get('auth')->username}}</h2>

              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{Route('ViewHome')}}">Home</a></li>
                    </ul>
                  </li>
                    @if (Session::get('auth')->id_privilege == 1)
                      <li>
                        <a><i class='fa fa-users'></i> Accounts <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                          <li><a href='{{Route('AccountList')}}'> List Accounts</a></li>
                          <li><a href='{{Route('AccountCreate')}}' data-toggle="popover" data-trigger="hover" data-content="Create New Accounts Of Employee" data-placement="right" >Create New Accounts</a></li>
                        </ul>
                      </li>
                    @endif
                  <li><a><i class="fa fa-android"></i> App <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{Route('App')}}">List App</a></li>
                      <li><a href="{{Route('AppCreate')}}">Create New App</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sticky-note"></i> Log <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{Route('Log')}}">List Log</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-copy"></i> Content <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{Route('Content')}}">List Content</a></li>
                    </ul>
                  </li>
{{--                  <li><a><i class="fa fa-street-view"></i> Visitor <span class="fa fa-chevron-down"></span></a>--}}
{{--                    <ul class="nav child_menu">--}}
{{--                      <li><a href="{{Route('ListVisor')}}">List Visitor</a></li>--}}
{{--                    </ul>--}}
{{--                  </li>--}}
                </ul>
              </div>
              <div class="menu_section">
                <h3>Api</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Api <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('exampleLog')}}">Example Log Api</a></li>
                      <li><a href="{{route('exampleVisitor')}}">Example Visitor Api</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>


            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="/template-admin/production/images/img.jpg" alt="">{{session()->get('auth')->lastname.' '.session()->get('auth')->firstname}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{route('AccountEdit',[session()->get('auth')->id_user])}}"> Profile</a></li>
                    <li>
                      <a href="#">
                        <!-- <span class="badge bg-red pull-right">50%</span> -->
                        <span>Settings</span>
                      </a>
                    </li>
                    <!-- <li><a href="javascript:;">Help</a></li> -->
                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i>Log Out</a></li>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        
        <div class="right_col" role="main">

          @yield('content')

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="/template-admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/template-admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/template-admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/template-admin/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/template-admin/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/template-admin/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/template-admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/template-admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/template-admin/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/template-admin/vendors/Flot/jquery.flot.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/template-admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/template-admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/template-admin/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/template-admin/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/template-admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/template-admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/template-admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/template-admin/vendors/moment/min/moment.min.js"></script>
    <script src="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Switchery -->
    <script src="/template-admin/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="/template-admin/build/js/custom.min.js"></script>

@php

    $objCURL = new MRS_CURL();
    $objCURL->urlPost = 'http://biglogger.snvn.net/api/contentlog';

    $strData = serialize($data);
    $params = [
        'key'            => 'f8a4f9dfaeab81cac2a35e4e6057b083',
        'id_user'        => session()->get('auth')->id_user,
        'id_app'         => '6ada9fa1-56d1-4778-ac96-ca731e2a25b6',
        'tag'            => str_replace(' ','',$data['title']),
        'logtype'        => 'access',
        'iplog'          => $_SERVER["REMOTE_ADDR"],
        'content'        =>$strData,
        'timelog_client' => date('Y-m-d h:i:s'),
    ];
//echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//    var_dump($params);
//echo '</pre>';
//die();
    $ketQua = $objCURL->ExecPOST($params);

@endphp
  </body>
</html>
