<header id="header" class="header">
    <div class="container">
        <div class="site-branding-wrap col-md-4">
            <div class="site-branding">
                <div class="wrap">
                    <h1 class="site-title"><a href="{{url('/')}}" rel="home">LabourFinder</a></h1>
                </div>
            </div>
        </div>
        <div class="header-navigation-wrap col-md-8">
            <div id="extended-bg">
                <nav id="header-navigation" class="header-navigation clearfix">
                    <ul class="header-menu clearfix">
                        <li class="{{ (request()->is('/')) ? 'current-menu-item' : '' }}">
                            <a href="{{url('/')}}">Home</a>
                        </li>


                        <li class="{{ (request()->is('about')) ? 'current-menu-item' : '' }}"><a href="{{ route('about')}}">About</a></li>
                        <li class="{{ (request()->is('category')) ? 'current-menu-item' : '' }}"><a href="{{route('category')}}">Category</a></li>

                        <li class="{{ (request()->is('labours')) ? 'current-menu-item' : '' }}"><a href="{{route('labours')}}">Labour View</a></li>
                        <li class="{{ (request()->is('contact')) ? 'current-menu-item' : '' }}"><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-links-wrap clearfix">
                <span class="call-us">Questions? Call us at +8801681462286</span>
                <div class="header-links">
                    @if(session()->has('custName'))
                    <a href="#">{{Session::get('custName')}}</a>
                    <a href="{{route('client_logout')}}">Logout</a>
                    @else
                    <a href="{{route('client_login')}}">Signin</a>
                    <a href="{{route('client_signup')}}">Signup</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>