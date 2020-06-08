@extends('front.master')

@section('body')
	<!-- Banner -->
<section id="banner" class="banner">
    <div class="container">
        <h2 class="page-title">Category</h2>
        <ol class="breadcrumb">
            <li class="active">Labour of {{$catName}}</li>
        </ol>
    </div>
</section>

<div class="container main-container category-page">
    @if(count($labCats) > 0)
    <div class="clearfix">
        @foreach($labCats as $labsBycat)
        <div class="featured-item-wrap col-xs-6 col-md-4">
            <figure class="featured-item">
                <a href="#"><img src="/img_upload/labour/{{ $labsBycat->photo }}" alt="Category"></a>
                <figcaption>
                    <div class="icon-container"><img src="{{asset('front/images/features/icon-1.png')}}" alt="Icon"></div>
                    <h3 class="title"><a href="#">{{$labsBycat->name}}</a></h3>
                    <p class="timings">Per Day Tk.<span>{{$labsBycat->price}}/=</span></p>
                    <p class="timings" style="margin: 5px 0">{{$labsBycat->jointype->name}} - {{$labsBycat->joinarea->name}}</p>
                    <a href="{{route('hire',['id' => $labsBycat->_id])}}" class="btn btn-primary delete-confirm">Hire Now</a>
                </figcaption>
            </figure>
        </div>
        @endforeach
    </div>
    <div class="load-more text-center">
        <a href="profile.html" class="btn btn-default btn-lg">Load More</a>
    </div>
    @else
    <h4>Couldn't  find any record</h4>
    @endif
</div>
@endsection