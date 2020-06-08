<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themesinspire.com/templates/inspire-indigo/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jan 2020 08:32:27 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home One</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="{{asset('front/js/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/js/owl.carousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/js/lightcase/css/lightcase.css')}}" rel="stylesheet">
    <link href="{{asset('front/js/slicknav/slicknav.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/js/chosen/chosen.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/toastr.min.css')}}" rel="stylesheet">
</head>
<body>

<!-- Header -->
@include('front.inc.header')



<div>


@yield('body')

<!-- Footer -->

@include('front.inc.footer')


<!-- Modal -->
<div id="sign-in-up" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content indigo-modal-content">
            <div id="indigo-modal" class="indigo-modal">
                <div class="indigo-tabs-container">
                    <ul class="indigo-tabs list-unstyled clearfix">
                        <li class="active">Sign In</li>
                        <li>Sign Up</li>
                    </ul>
                    <div class="indigo-tabs-content">
                        <div class="indigo-tab-content active">
                            <form id="sign-in" class="indigo-forms" action="#" method="post">
                                <input type="text" name="email" class="required" placeholder="Email Address">
                                <input type="password" name="password" class="required" placeholder="Password">
                                <div class="remember-me">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="checkboxes">
                                                <input type="checkbox" id="remember" value="remember">
                                                <label for="remember">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <span class="forget-password">Forgot Password</span><i class="fa fa-question-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Login Now" class="btn btn-primary">
                            </form>
                        </div>
                        <div class="indigo-tab-content">
                            <form id="sign-up" class="indigo-forms" action="#" method="post">
                                <input type="text" name="email" class="required" placeholder="Email Address">
                                <input type="text" name="fname" id="fname" class="required" placeholder="First Name">
                                <input type="text" name="lname" id="lname" class="required" placeholder="Last Name">
                                <input type="text" name="phone" class="required" placeholder="Phone Number">
                                <input type="email" name="email" class="required" placeholder="Email">
                                <input type="text" name="zip" class="required" placeholder="ZIP Code">
                                <div class="remember-me">
                                    <div class="checkboxes">
                                        <input type="checkbox" name="chk2" id="chk2">
                                        <label for="chk2">Consectetur adipisicing elited do eiusmod idunt.</label>
                                    </div>
                                </div>
                                <input type="submit" value="Signup Now" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->


<!-- Scripts -->
<script src="{{asset('front/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('front/js/jquery-migrate.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.js')}}"></script>
<script src="{{asset('front/js/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/lightcase/vendor/jQuery/jquery.events.touch.js')}}"></script>
<script src="{{asset('front/js/lightcase/js/lightcase.js')}}"></script>
<script src="{{asset('front/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('front/js/jquery-countTo/jquery.countTo.js')}}"></script>
<script src="{{asset('front/js/slicknav/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('front/js/chosen/chosen.jquery.min.js')}}"></script>
<script src="{{asset('front/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('front/js/jquery.form.min.js')}}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'Are you sure to hire this worker?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });


</script>

<script src="{{asset('front/js/toastr.min.js')}}"></script>

<script type="text/javascript">
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      @if(Session::has('success'))
        toastr["success"]("{{ Session::get('success') }}")
      @endif
      @if(Session::has('error'))
        toastr["error"]("{{ Session::get('error') }}")
      @endif
      @if(Session::has('warning'))
        toastr["warning"]("{{ Session::get('warning') }}")
      @endif
</script>



</body>

</html>