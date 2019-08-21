@extends('layout.backend')

@section('content')
<style type="text/css">
  .btn-primary:hover {
    color: #fff;
    background-color: #286090;
    border-color: #204d74;
  }
</style>
<h1>Create New App</h1>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title page-title">
      <div class="title_left">
        <h3>Create New App</h3>
        @if(!empty($data['msg']))
          @for ($i=0;$i<count($data['msg']);$i++)
            <p style="color: red;font-size: 20px;">{{$data['msg'][$i]}}</p>
          @endfor
        @endif

      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="x_content">
      <form class="form-horizontal form-label-left" novalidate>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12 form-control" readonly="readonly" name="username" type="text" value="{{ session()->get('auth')->username}}" >
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ten_app">Name Of App <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" name="ten_app" type="text">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" name="website" placeholder="" required="required" type="text">
          </div>
        </div>
        <div class="item form-group">
          <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password" name="password_confirm" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <a type="submit" class="btn btn-primary" href="{{Route('App')}}" name="cancel">Cancel</a>
            <button  type="submit" class="btn btn-success" formmethod="post" name="create" >Create</button>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
  @endsection