@extends('front.master')

@section('body')
	<!-- Banner -->
<section id="banner" class="banner">
    <div class="container">
        <h2 class="page-title">All Category</h2>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">category</li>
        </ol>
    </div>
</section>

<div class="container main-container category-page">
    <div class="clearfix">
    @foreach($categories as $category)
    <div class="category-item-wrap col-xs-6 col-md-4 col-lg-3">
        <figure class="category-item">
            <a href="{{route('LabourByCat',['id' => $category->_id,'cat_name' => $category->name])}}"><img src="/img_upload/{{ $category->photo }}" alt="Category"></a>

            <figcaption>
                <h3 class="title"><a href="profile.html">{{$category->name}}</a></h3>
            </figcaption>
        </figure>
    </div>
    @endforeach
</div>

</div>
@endsection