@extends('layout.backend')

@section('content')
<style type="text/css" rel="stylesheet">
    p{
        font-size: 15px;
    }
</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<h1>Api Log</h1>
<p> <strong>Access URL : </strong></p>
<pre>http://biglogger.snvn.net/api/contentlog</pre>

<p><strong>Request example:</strong></p>
<pre>
Array
(
    [id_user] => 1
    [id_app] => 065cf32b-840f-43e4-8b82-d3ceb81859a2
    [key] => 1c2d69919cdc5ba0cc33edf188efb4aa
    [tag] => Login
    [logtype] => access
    [iplog] => 168.65.56.32
    [content] => Logged in successfully
    [timelog_client] => 2019-05-22 08:55:16
)
</pre>
<p><strong>Tôi có thể nhận id_app và key ở đâu?</strong></p>
    <p>Bạn có thể nhận id_app và key <a href="{{route('App')}}" style="color: aqua;">tại đây</a></p>
<p><strong>Tôi có thể nhận id_user ở đâu?</strong></p>
<p>Bạn có thể nhận id_user <a href="{{route('AccountEdit',['id'=>$data['load_one']->id_user])}}" style="color: aqua;">tại đây</a></p>
<p><strong>Các trường bên trên là gì?</strong></p>
    <p>iplog : đỉa chỉ ip public của bạn</p>
    <p>logtype : trạng thái log, ví dụ : access,error ...</p>
    <p>timelog_client: thời gian khi client gửi log, format : y-m-d H-i-s </p>
    <p>tag : thẻ đánh dấu tag , ví dụ : login,logout,register ...</p>
    <p>nội dung : nội dung log mà client gửi lên , ví dụ : đăng nhập thành công</p>
</div>

@endsection
