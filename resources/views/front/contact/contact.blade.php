@extends('front.master')

@section('body')
<!-- Banner -->
<section id="banner" class="banner">
    <div class="container">
        <h2 class="page-title">Contact</h2>
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">contact</li>
        </ol>
    </div>
</section>


    <!--Email & Address-->
<section style="padding-top: 50px;padding-bottom: 50px">
    <ul class="contact-methods list-unstyled clearfix">
        <li>
            <div class="icon-container">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </div>
            <div class="content">
                <h4 class="title">Email</h4>
                <p><a href="#">forhad2097@gmail.com</a></p>
                <p><a href="#">ahsanhabibnahid.bd@gmail.com</a></p>
            </div>
        </li>
        <li>
            <div class="icon-container">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="content">
                <h4 class="title">Address</h4>
                <address>
                    Baitul Aman Housing,Adabor <br>
                    R#12,Dhaka-1207
                </address>
            </div>
        </li>
        <li>
            <div class="icon-container">
                <i class="fa fa-phone" aria-hidden="true"></i>
            </div>
            <div class="content">
                <h4 class="title">Phone</h4>
                <p>+088 01684022052</p>
                <p>+088 01681462286</p>
            </div>
        </li>
    </ul>




    <!-- Contact Form -->
    <form id="contact-form" class="contact-form" method="post" action="http://themesinspire.com/templates/inspire-indigo/php/contact.php">
        <div class="clearfix">
            <div class="col-md-4">
                <p><input type="text" name="name" placeholder="Your Name" class="required" title="*Please provide your name"></p>
            </div>
            <div class="col-md-4">
                <p><input type="email" name="email" placeholder="Your Email" class="required email" title="*Please provide your Email Address"></p>
            </div>
            <div class="col-md-4">
                <p><input type="text" name="number" placeholder="Number"></p>
            </div>
            <div class="col-md-10">
                <p><textarea name="message" placeholder="Tell us about your opinion about us..."></textarea></p>
            </div>
            <div class="col-md-2">
                <input type="submit" class="submit-button" value="Send">
                <img id="loader" src="images/ajax-loader.gif" alt="Sending...">
            </div>
            <div class="col-md-12">
                <div class="errors-container"></div>
            </div>
        </div>
    </form>
</div>
</section>
@endsection