@extends('layout.frontend')
{{--@dd($data)--}}
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="banner-content col-lg-8 col-md-8">
            <div class="content-tt">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="title-items">
                            Your IP address is:
                        </div>
                        <div class="text-1">
                            <img src="/images/globe_network.png" class="icon">
                            <span id="ip">{{$data['ip']}}</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="title-items">
                            Country:
                        </div>
                        <div class="text-1">
                            <img src="/images/link.png" class="icon">
                            <span id="host">{{$data['country']}}</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="title-items">
                            Datetime Now:
                        </div>
                        <div class="text-1">
                            <img src="/images/time.png" class="icon">
                            <span id="ip">{{$data['date']}}</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="title-items">
                            City:
                        </div>
                        <div class="text-1">
                            <img src="/images/location.png" class="icon">
                            <span id="ip">{{$data['city']}}</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="title-items">
                            Hệ điều hành:
                        </div>
                        <div class="text-1">
                            <img src="/images/Operatingsystem.png" class="icon">
                            <span id="ip">{{$data['strSystem']}}</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="title-items">
                            Browser:
                        </div>
                        <div class="text-1">
                            <img src="/images/1e6d06069c.png" class="icon">
                            <span id="ip">{{$data['strBrowser']}}</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="title-items">
                            Số lượng user:
                        </div>
                        <div class="text-1">
                            <img src="/images/count-user.png" class="icon">
                            <span id="ip">{{$data['count']}}</span>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
        <div class="banner-img col-lg-2 col-md-2">

        </div>
    </div>
    <div class="row">

    </div>
</div>

<section class="feature-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 pb-40 header-text text-center">
                <h1 class="pb-10 text-white">Services</h1>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title d-flex flex-row">
                        <span class="lnr lnr-user"></span>
                        <h4>Expert Technicians</h4>
                    </a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title d-flex flex-row">
                        <span class="lnr lnr-license"></span>
                        <h4>Professional Service</h4>
                    </a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title d-flex flex-row">
                        <span class="lnr lnr-phone"></span>
                        <h4>Great Support</h4>
                    </a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title d-flex flex-row">
                        <span class="lnr lnr-rocket"></span>
                        <h4>Technical Skills</h4>
                    </a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title d-flex flex-row">
                        <span class="lnr lnr-diamond"></span>
                        <h4>Highly Recomended</h4>
                    </a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title d-flex flex-row">
                        <span class="lnr lnr-bubble"></span>
                        <h4>Positive Reviews</h4>
                    </a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
