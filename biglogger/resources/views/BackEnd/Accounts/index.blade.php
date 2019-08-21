@extends('layout.backend')

@section('content')
<script src="https:/ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/ajaxSearch.js"></script>
<script src="https://kit.fontawesome.com/9f16c108d4.js"></script>
<style type="text/css" rel="stylesheet">
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    padding-top: 12px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
  }
  .table>thead:first-child>tr:first-child>th {
    border-top: 0;
    width: calc(100% / 6);
  }
</style>
<h1>List Accounts</h1>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title page-title">
      <div class="title_left">
        <h3>List Accounts  <small><a href="{{Route('AccountCreate')}}" data-toggle="popover" data-trigger="hover" data-content="Create New Accounts" style="color:aqua">Create New Accounts</a></small></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <form method="get">
            <input type="text" name="keyword" class="form-control" placeholder="Search for..." style="width: 140%;"  @if(Session::has('keyword')) value="{{$data['keyword']}}" @endif>
            <span class="input-group-btn" style="display: inherit">
              <button formmethod="get" class="btn btn-default" type="submit" style="border-radius: 0 25px 25px 0;"><i class="fa fa-search"></i></button>
{{--              <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
            </span>
            </form>
          </div>
        </div>
      </div>      
    </div>
    Tổng số user : {{$data['count']}}
<div class="clearfix"></div>
    <div id="content" class="x_content">

      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th><a href="{{$data['linkhref']}}firstname">First name<i class="fas fa-sort-amount-up" style="float: right;"></i> </a></th>
            <th><a href="{{$data['linkhref']}}lastname">Last name<i class="fas fa-sort-amount-up" style="float: right;"></i></a></th>
            <th><a href="{{$data['linkhref']}}username">UserName<i class="fas fa-sort-amount-up" style="float: right;"></i></a></th>
            <th><a href="{{$data['linkhref']}}email">E-mail<i class="fas fa-sort-amount-up" style="float: right;"></i></a></th>
            <th><a href="{{$data['linkhref']}}name_privilege">Name Of Privilege<i class="fas fa-sort-amount-up" style="float: right;"></i></a></th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="tableList">
{{--        @dd($data)--}}
            @foreach($data['account-list'] as $row)
            <tr>
              <td>{{$row->firstname}}</td>
              <td>{{$row->lastname}}</td>
              <td>{{$row->username}}</td>
              <td>{{$row->email}}</td>
              <td>{{$row->name_privilege}}</td>
              <td style='width: 200px;'>
                <a href='{{route('AccountList')}}' data-toggle="popover" data-trigger="hover" data-content="View Accounts" data-placement="top" class='btn btn-primary btn-xs'><i class='fa fa-folder'></i> View </a>
                <a href='{{route('AccountEdit',[$row->id_user])}}' data-toggle="popover" data-trigger="hover" data-content="Edit Accounts" data-placement="top" class='btn btn-info btn-xs'><i class="fas fa-edit"></i> Edit </a>
{{--                <div class="" style="display: inline;">--}}
                  <label  data-toggle="popover" data-trigger="hover" data-content="Enable Accounts" data-placement="top" >
                    <input type="checkbox" class="js-switch" checked /> Enable
                  </label>

{{--                </div>--}}
              </td>
            </tr>
              @endforeach

        </tbody>

      </table>
      {{$data['account-list']->links()}}


    </div>
  </div>
</div>

@endsection