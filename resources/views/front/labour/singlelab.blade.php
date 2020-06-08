@extends('front.master')

@section('body')

<div class="container main-container category-page">

    <div class="clearfix">
    	<div class="col-xs-4 col-md-4">
		    <div class="featured-item-wrap col-xs-6 col-md-4">
		        <figure class="">
		            <a href="#"><img src="/img_upload/labour/{{ $singlelab->photo }}" alt="Category"></a>
		        </figure>
		    </div>
    	</div>
	    <div class="col-xs-8 col-md-8">
	    	<h2>Please wait.Admin will contact you soon</h2>
	    	<p><label>Worker Name</label> : {{$singlelab->name}}</p>
	    	<p><label>Work Per Day</label> : Tk.{{$singlelab->price}}</p>
	    	<p><label>Area</label> : {{$singlelab->joinarea->name}}</p>
	    	<p><label>Work Category</label> : {{$singlelab->jointype->name}}</p>
	    </div>
    </div>

</div>


@endsection