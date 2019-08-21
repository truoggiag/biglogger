@extends('layout.backend')

@section('content')
<!-- Datatables -->
<link href="/template-admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/template-admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="/template-admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="/template-admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="/template-admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="/template-admin/build/css/custom.min.css" rel="stylesheet">
<style type="text/css" rel="stylesheet">
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    padding-top: 12px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
  }
</style>
<h1>List Content</h1>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title page-title">
      <div class="title_left">
        <h3>List Content  </h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

            <form method="get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." name="search" style="width: 65%" value="{{$data['search']}}">
                    <select name="option-search" class="form-control" style="width: 35%;padding-left: 5px">
                        <option value="1">chọn</option>
                        <option value="2" @if(Session::get('selected')==2) selected @else @endif>Log Type</option>
                        <option value="3" @if(Session::get('selected')==3) selected @else @endif>Content</option>
                        <option value="4" @if(Session::get('selected')==4) selected @else @endif>Ip Log</option>
                        <option value="5" @if(Session::get('selected')==5) selected @else @endif>Tag</option>
                    </select>
                    <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Go!" style="border-radius: 0 25px 25px 0;">
              </span>
                </div>
            </form>
        </div>
      </div>      
    </div>
      Tổng số bản ghi : 10/{{$data['count']}}
<div class="clearfix"></div>
    <div class="x_content">
      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Log Type</th>
            <th>Content</th>
            <th>Ip Log</th>
            <th>Tag</th>
            <th>Timelog Client</th>
            <th>Timelog Server</th>
          </tr>
        </thead>
        <tbody>
        @php
            foreach ($data['list'] as $row){
                  echo "<tr>
                  <td>".$row['logtype']."</td>
                  <td style='height:400px'>";
                  echo "<pre style='height:400px'>";
                  print_r(unserialize($row['content']));
                  echo '</pre>';
                  echo "</td>
                  <td>".$row['iplog']."</td>
                  <td>".$row['tag']."</td>
                  <td>".$row['timelog_client']."</td>
                  <td>".$row['timelog_server']."</td>
                  </tr>";
                  }
        @endphp

        </tbody>
      </table>
        @if(!$data['list']->isLastPage())
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{route('Content')}}?pg_st={{bin2hex($data['list']->pagingStateToken())}}@if(session()->has('search') && session()->has('selected'))&search={{$data['search']}}&option-search={{$data['option-search']}} @endif" aria-label="Next">
                            <span aria-hidden="true">Xem Thêm</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        @else
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="{{route('Content')}}}}">Home</a></li>
                </ul>
            </nav>
        @endif
    </div>
  </div>
</div>
<!-- jQuery -->
<script type="text/javascript" src="/template-admin/vendors/jquery/dist/jquery.min.js"></script>
<!-- Datatables -->
<script type="text/javascript" src="/template-admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script type="text/javascript" src="/template-admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/jszip/dist/jszip.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/pdfmake/build/pdfmake.min.js"></script>
<script type="text/javascript" src="/template-admin/vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- Custom Theme Scripts -->
<script type="text/javascript" src="/template-admin/build/js/custom.min.js"></script>
  @endsection