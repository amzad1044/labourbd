@extends('front.master')

@section('body')
    <div id="home-search-form" class="home-search-form search-form-section">
    <div class="container">
        <div class="col-xs-12">
            <form id="search-form" class="search-form" action="/src" method="get">
                {{ csrf_field() }}
                <div class="row">

                    <div class="form-group col-sm-4 col-md-5">
                    <select name="type" class="form-control">
                        <option value="">Select Worker Type</option>
                        @foreach($catsdropdown as $cats)
                            <option value="{{$cats->_id}}">{{$cats->name}}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="form-group col-sm-4 col-md-5">
                        <select class="form-control" name="area">
                        <option value="">Select Area</option>
                        @foreach($areas as $area)
                            <option value="{{$area->_id}}">{{$area->name}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-4 col-md-2">
                        <input type="submit" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Categories -->
<section id="home-categories" class="home-categories section-parallax">
    <div class="container">
        <div class="clearfix">
            @foreach($categories as $cat)
            <div class="category-item-wrap col-xs-6 col-md-4 col-lg-3">
                <figure class="category-item">
                    <a href="{{route('LabourByCat',['id' => $cat->_id,'cat_name' => $cat->name])}}"><img src="/img_upload/{{ $cat->photo }}" alt="Category"></a>
                    <figcaption>
                        <h3 class="title"><a href="profile.html">{{$cat->name}}</a></h3>
                    </figcaption>
                </figure>
            </div>
            @endforeach
        </div>

        <div class="load-more text-center">
            <a href="{{route('category')}}" class="btn btn-default btn-lg" style="background-color: #107fc9;color: #fff;">Load More</a>
        </div>

    </div>
    <div class="section-parallax-image">
        <img src="{{asset('front/images/slider/1.jpg')}}" alt="">
    </div>
</section>

<!-- Search Form -->


<!-- Featured -->
@include('front.inc.feature')




<!-- Clients -->
<section id="clients" class="clients" style="padding-bottom: 10px">
    <div class="container">
        <div class="clearfix">
            <div class="clients-items-carousel owl-carousel">
                <div class="carousel-item">
                    <a href="#"><img src="{{asset('front/images/clients/1.png')}}" alt="Client"></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="{{asset('front/images/clients/1.png')}}" alt="Client"></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="{{asset('front/images/clients/1.png')}}" alt="Client"></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="{{asset('front/images/clients/1.png')}}" alt="Client"></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="{{asset('front/images/clients/2.png')}}" alt="Client"></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="{{asset('front/images/clients/3.png')}}" alt="Client"></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="{{asset('front/images/clients/4.png')}}" alt="Client"></a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection