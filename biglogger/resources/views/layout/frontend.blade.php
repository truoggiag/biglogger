<?php


//$objCURL = new \MRS_CURL();
//
//$objCURL->urlPost = 'http://biglogger.snvn.net/api/contentlog';
//
//$params = [
//		'id_user'        => 2,
//		'id_app'         => 'f1f4927e-e0d4-4703-8680-93d1450480f9',
//		'tag'            => 'Login',
//		'logtype'        => 'access',
//		'iplog'          => $_SERVER["REMOTE_ADDR"],
//		'content'        => 'Dang nhap thanh cong',
//		'timelog_client' => date('Y-m-d h:i:s'),
//];
//
//$ketQua = $objCURL->ExecPOST($params);
?>
<!DOCTYPE html>
<html lang="en">		
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="/images/logo.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">  
   <title>{{$data['title']}}</title>
   <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="/css/linearicons.css">
			<link rel="stylesheet" href="/css/font-awesome.min.css">
			<link rel="stylesheet" href="/css/bootstrap.css">
{{--			<link rel="stylesheet" href="/css/magnific-popup.css">--}}
			<link rel="stylesheet" href="/css/nice-select.css">
			<link rel="stylesheet" href="/css/hexagons.min.css">
			<link rel="stylesheet" href="/css/animate.min.css">
			<link rel="stylesheet" href="/css/owl.carousel.css">
			<link rel="stylesheet" href="/css/main.css">
			<link rel="stylesheet" type="text/css" href="/css/login.css">
	<!--===============================================================================================-->
</head>
<body>
  <header>
 	<header id="header" id="home">
			    <div class="container main-menu">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="{{route('ViewHome')}}"><img src="/images/logo.png" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="{{env('APP_URL')}}">Home</a></li>
				          <li><a href="#">About Us</a></li>
				          <li><a href="#">Services</a></li>			          
				          <li><a href="">Contact</a></li>
				          @if (!empty(session()->get('auth')))
				          	<li><a href='{{Route('App')}}'>{{session()->get('auth')->username}}</a></li>
				          	<li><a href='/logout'>logout</a></li>
				          @else
				          	<li><a href='/login'>Login</a></li>
				          	<li><a href='/register'>Register</a></li>
				          @endif
				          
				     				              
				        </ul>
				      </nav>	    		

			    	</div>
			    </div>
			  </header>
	</header>

@yield('content')

<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-12">
							<div class="single-footer-widget">
								<h6>Top Products</h6>
								<ul class="footer-nav">
									<li><a href="#">Managed Website</a></li>
									<li><a href="#">Manage Reputation</a></li>
									<li><a href="#">Power Tools</a></li>
									<li><a href="#">Marketing Service</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6  col-md-12">
							<div class="single-footer-widget newsletter">
								<h6>Newsletter</h6>
								<p>You can trust us. we only send promo offers, not a single spam.</p>
								<div id="mc_embed_signup">
									<form target="_blank" novalidate="true" action="" method="get" class="form-inline">

										<div class="form-group row" style="width: 100%">
											<div class="col-lg-8 col-md-12">
												<input name="email" placeholder="Enter Email" required="" type="email">
											</div> 
										
											<div class="col-lg-4 col-md-12">
												<button class="nw-btn primary-btn">Subscribe<span class="lnr lnr-arrow-right"></span></button>
											</div> 
										</div>		
										<div class="info"></div>
									</form>
								</div>		
							</div>
						</div>
						<div class="col-lg-3  col-md-12">
							<div class="single-footer-widget mail-chimp">
								
							</div>
						</div>						
					</div>

					<div class="row footer-bottom d-flex justify-content-between">
						<p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
						<div class="container">
							<div class="row">
								<span class="col-lg-12">
									Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
								</span>
							</div>
							

						</div>

						<div class="col-lg-12 col-sm-12 footer-social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</footer>
			

			<script src="/js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="/js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="/js/easing.min.js"></script>			
			<script src="/js/hoverIntent.js"></script>
			<script src="/js/superfish.min.js"></script>	
			<script src="/js/jquery.ajaxchimp.min.js"></script>
			<script src="/js/jquery.magnific-popup.min.js"></script>	
			<script src="/js/owl.carousel.min.js"></script>	
			<script src="/js/hexagons.min.js"></script>							
			<script src="/js/jquery.nice-select.min.js"></script>	
			<script src="/js/jquery.counterup.min.js"></script>
			<script src="/js/waypoints.min.js"></script>							
			<script src="/js/mail-script.js"></script>	
			<script src="/js/main.js"></script>		
</body>
</html>
