@extends('front.master')

@section('body')
<!-- Banner -->
<section id="banner" class="banner">
    <div class="container">
        <h2 class="page-title">About Us</h2>
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">about</li>
        </ol>
    </div>
</section>

<!-- What We DO -->
<section id="what-we-do" class="what-we-do">
    <div class="container">
        <div class="col-xs-12">
            <header class="section-head">
                <div class="section-head-inner">
                    <h4 class="section-sub-title">Euismod iaculis</h4>
                    <h3 class="section-title">what we do</h3>
                </div>
            </header>
        </div>
        <div class="clearfix">
            <div class="col-md-6">
                <ul class="what-we-do-list list-unstyled">
                    <li>
                        <div class="icon-container"><img src="{{asset('front/images/features/icon-1.png')}}" alt="Icon"></div>
                        <div class="detail">
                            <h4 class="title">Plumber</h4>
                            <div class="bar"></div>
                            <p>
                                Sed fermentum euismod iaculis. Praesent quis dictum ipsum. Phasellus consectetur enim
                                efficitur.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="icon-container"><img src="{{asset('front/images/features/icon-5.png')}}" alt="Icon"></div>
                        <div class="detail">
                            <h4 class="title">Car Washer</h4>
                            <div class="bar"></div>
                            <p>
                                Sed fermentum euismod iaculis. Praesent quis dictum ipsum. Phasellus consectetur enim
                                efficitur.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="icon-container"><img src="{{asset('front/images/features/icon-2.png')}}" alt="Icon"></div>
                        <div class="detail">
                            <h4 class="title">Electrician</h4>
                            <div class="bar"></div>
                            <p>
                                Sed fermentum euismod iaculis. Praesent quis dictum ipsum. Phasellus consectetur enim
                                efficitur.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 img-side">
                <a href="#"><img class="img-responsive" src="{{asset('front/images/about/1.png')}}" alt="Image"></a>
            </div>
        </div>
    </div>
</section>

@endsection