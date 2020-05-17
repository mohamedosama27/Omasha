@extends('bar')
@section('content')

<style>
    .cardspace{
        margin:10px;
    }
    .margintop{
        margin-top:10px;
    }
    .formicon {
    font-size: 20px;
  }
</style>
<br>
<div class="w3-card cardspace">

<div class="cardspace">
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


<a href="register" class="margintop" style="float:right;margin-bottom:10px;">Create Account</a>

  <button type="submit" class="w3-btn btn-block w3-round-xxlarge w3-light-blue" style="margin-bottom:10px;">Login</button>
<br>
</form>
</div>
</div>
<!-- <a class="btn btn-lg btn-primary btn-block" href="{{ url('auth/facebook') }}">
 <strong>Login With Facebook</strong>
 </a> -->



@endsection
