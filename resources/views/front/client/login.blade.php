
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="{{asset('front/css/signin.css')}}">

</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" method="post" action="{{route('loginPost')}}">
      @csrf
      <input type="text" name="email" placeholder="Email"/>
       <span style="color:red">{{$errors->has('email') ? $errors->first('email') : ' '}}</span>
      <input type="password" name="password" placeholder="Password"/>
       <span style="color:red">{{$errors->has('password') ? $errors->first('password') : ' '}}</span>
      <button type="submit">login</button>
      <p class="message">Not registered? <a href="{{route('client_signup')}}">Registered</a></p>
    </form>

  </div>
</div>
	<script src="{{asset('front/js/signin.js')}} "></script>
</body>
</html>
