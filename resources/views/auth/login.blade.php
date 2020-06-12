@extends('bar')
@section('content')

<link rel="stylesheet" href="/css/login.css">



<div class="form center-block">
<p class="text-center raleway formheader" >LOGIN</p>
  <br>
  
    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-envelope formicon"></i></span>
      <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="email" placeholder="Email" name="email" required autocomplete="email" autofocus>
      </div>
      @error('email')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <br>
                                @enderror 
<br>
<div class="input-group">
      <span class="input-group-addon"><i class="fa fa-key formicon"></i></span>
      <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required autocomplete="current-password">
      </div>

      @error('password')
                                    <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <br>
                                @enderror 
    <br>


<a href="reset" class="forget-password-link pull-right"><u>Forget password?</u></a>

  <button type="submit" class= "brandcolor btn btn-block w3-round-xxlarge " style="margin-bottom:10px;">Login</button>
<br>
<div class="text-center create-account-div">
First visit?
<a href="register" class="create-account-link"><u>Create an account</u></a>
</div>
</form>

</div>
<!-- <a class="btn btn-lg btn-primary btn-block" href="{{ url('auth/facebook') }}">
 <strong>Login With Facebook</strong>
 </a> -->

 <!-- <a href="{{ url('/auth/redirect/google') }}" class="btn btn-primary"><i class="fa fa-google"></i> Google</a> -->


@endsection
