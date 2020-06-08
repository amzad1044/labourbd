
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{asset('front/css/signin.css')}}">

</head>
<body>
<div class="login-page">
  <div class="form">
    <form method="POST" action="{{ route('signUp') }}">
      @csrf
        <input type="text" name="name" placeholder="Your Name"/>
        <span style="color:red">{{$errors->has('name') ? $errors->first('name') : ' '}}</span>
	       <input type="text" name="email" placeholder="Email"/>
         <span style="color:red">{{$errors->has('email') ? $errors->first('email') : ' '}}</span>
        <input type="text" name="phone" placeholder="Phone"/>
        <span style="color:red">{{$errors->has('phone') ? $errors->first('phone') : ' '}}</span>
        <input type="password" name="password" placeholder="Password"/>
        <span style="color:red">{{$errors->has('password') ? $errors->first('password') : ' '}}</span>

        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-Type Password">


	       <input type="text" name="address" placeholder="Address"/>
         <span style="color:red">{{$errors->has('address') ? $errors->first('address') : ' '}}</span>
      
      <button type="submit">create</button>
      <p class="message">Already registered? <a href="{{route('client_login')}}">Log in</a></p>
    </form>
  </div>
</div>
	<script src="{{asset('front/js/signin.js')}} "></script>
</body>
</html>