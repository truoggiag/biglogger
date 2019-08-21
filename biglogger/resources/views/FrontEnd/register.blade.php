@extends('layout.frontend')

@section('content')
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="/css/login.css">

	<div class="limiter">
		<div class="container-login100">


			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="login100-pic js-tilt" data-tilt>
						<img src="/images/logo.png" alt="IMG">
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<h3 class="panel-title">Please sign up. <small>It's free!</small></h3><br>
					@if(!empty($data['msg']))
						@for ($i=0;$i<count($data['msg']);$i++)
							<p style="color: red;font-size: 20px;">{{$data['msg'][$i]}}</p>
						@endfor
					@endif
					<form role="form" method="post">
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="firstname" id="firstname" class="form-control input-sm"  @if(empty($_SESSION['register'])) placeholder="First Name" @else value="{{$_SESSION['register']['firstname']}}" @endif>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="lastname" id="lastname" class="form-control input-sm"  @if(empty($_SESSION['register'])) placeholder="Last Name" @else value="{{$_SESSION['register']['lastname']}}"  @endif>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="username" name="username" id="username" class="form-control input-sm"  @if(empty($_SESSION['register'])) placeholder="Username" @else value="{{$_SESSION['register']['username']}}" @endif>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control input-sm"  @if(empty($_SESSION['register'])) placeholder="Email Address" @else value="{{$_SESSION['register']['email']}}" @endif>
								</div>
							</div>

						</div>



						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
								</div>
							</div>
						</div>

						<input type="submit" value="Register" name="submit" class="btn btn-info btn-block">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					</form>

				</div>

			</div>





		</div>
	</div>




	<!--===============================================================================================-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->

	<script src="js/bootstrap/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="js/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="js/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
@endsection