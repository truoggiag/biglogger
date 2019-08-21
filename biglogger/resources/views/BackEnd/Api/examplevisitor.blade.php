@extends('layout.backend')

@section('content')
<style type="text/css" rel="stylesheet">
    p{
        font-size: 15px;
    }
</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<h1>Api Visitor</h1>
<p> <strong>Access URL : </strong></p>
<pre>http://biglogger.snvn.net/api/contentvisitor</pre>
<p><strong>jQuery CDN</strong></p>
<div style="margin-left: 15px;">Google CDN : <pre>https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js</pre></div>
<div style="margin-left: 15px;">Microsoft CDN : <pre>https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js</pre></div>
<p><strong>Request example:</strong></p>
<pre>
$(document).ready(function(){
    var data = 'id_app=f1f4927e-e0d4-4703-8680-93d1450480f9&key=36cdad7877164be3ee9740dadb762ae9';
    $.ajax({
        type: 'GET',
        url: 'http://biglogger.snvn.net/api/contentvisitor',
        data: data
    });
});
</pre>
    <p><strong>Tôi có thể nhận id_app và key ở đâu?</strong></p>
    <p>Bạn có thể nhận id_app <a href="{{route('App')}}" style="color: aqua;">tại đây</a></p>

</div>
@endsection
