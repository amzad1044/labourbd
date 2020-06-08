@extends('front.master')

@section('body')
<section id="banner" class="banner">
    <div class="container">
        <h2 class="page-title">All Labour</h2>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Labour</li>
        </ol>
    </div>
</section>

<div class="container main-container category-page">
    @if(count($labour_all) > 0)
    <div class="clearfix">

    @foreach($labour_all as $labour)
    <div class="featured-item-wrap col-xs-6 col-md-4">
        <figure class="featured-item">
            <a href="#"><img src="/img_upload/labour/{{ $labour->photo }}" alt="Category"></a>
            <figcaption>
                <div class="icon-container"><img src="{{asset('front/images/features/icon-1.png')}}" alt="Icon"></div>
                <h3 class="title"><a href="#">{{$labour->name}}</a></h3>
                <p class="timings">Per Day Tk.<span>{{$labour->price}}/=</span></p>
                <p class="timings" style="margin: 5px 0">{{$labour->jointype->name}} - {{$labour->joinarea->name}}</p>
                <a href="{{route('hire',['id' => $labour->_id])}}" class="btn btn-primary delete-confirm">Hire Now</a>
            </figcaption>
        </figure>
    </div>
    @endforeach

    </div>
    @else
    <h4>Couldn't  find any record</h4>
    @endif

</div>

@endsection