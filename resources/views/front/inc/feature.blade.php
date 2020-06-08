<section id="home-featured" class="home-featured">
    <div class="container">
        <div class="col-xs-12">
            <header class="section-head">
                <div class="section-head-inner">
                    <h4 class="section-sub-title">Best Workers</h4>
                    <h3 class="section-title">Featured Labour</h3>
                </div>
            </header>
        </div>
        <div class="clearfix">
            @foreach($labourFeature as $feature)
            <div class="featured-item-wrap col-xs-6 col-md-4">
                <figure class="featured-item">
                    <a href="#"><img src="/img_upload/labour/{{ $feature->photo }}" alt="Category"></a>
                    <figcaption>
                        <div class="icon-container"><img src="{{asset('front/images/features/icon-2.png')}}" alt="Icon"></div>
                        <h3 class="title"><a href="#">{{$feature->name}}</a></h3>
                        <p class="timings">Per Day Tk.<span>{{$feature->price}}/=</span></p>
                        <p class="timings" style="margin: 5px 0">{{$feature->jointype->name}} - {{$feature->joinarea->name}}</p>
                        <a href="{{route('hire',['id' => $feature->_id])}}" class="btn btn-primary delete-confirm">Hire Now</a>
                    </figcaption>
                </figure>
            </div>
            @endforeach
        </div>
    </div>
</section>