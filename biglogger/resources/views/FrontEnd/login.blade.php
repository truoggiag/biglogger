@extends('layout.frontend')

@section('content')
	<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/images/logo.png" alt="IMG">
				</div>


				<form class="login100-form validate-form" method="post">
				<span class="login100-form-title">
					Member Login
				</span>
					@if(!empty($data['msg']))
						@for ($i=0;$i<count($data['msg']);$i++)
							<p style="color: red;font-size: 20px;">{{$data['msg'][$i]}}</p>
						@endfor
					@endif
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" name="submit" type="submit" value="Login">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					</div>

					<div class="text-center p-t-12">
					<span class="txt1">
						Forgot
					</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
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
