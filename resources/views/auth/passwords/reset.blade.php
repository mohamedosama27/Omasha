@extends('bar')

@section('content')
<style>
@media (min-width:768px) {

.email-form{
    width:50%;
}
.sendemail{
    margin-bottom:50px;
}
}
@media (max-width:768px) {

.email-form{
    width:80%;
}

}
.email-form{
    margin-top:50px;
}

.formicon {
    font-size: 20px;
  }
  .formheader{
    font-size: 28px;

  }
</style>


<div class="email-form center-block">
            <p class="text-center raleway formheader" >RESET PASSWORD</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

               


                        <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-envelope formicon"></i></span>
      <input class="form-control @error('email') is-invalid @enderror" name="email" vvalue="{{ $email ?? old('email') }}" type="email" placeholder="Email" name="email" required autocomplete="email" autofocus>
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

    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-key formicon"></i></span>
      <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Repeat Password" name="password_confirmation" required autocomplete="current-password">
    </div>

<br>
  

<br>
  <button type="submit" class="w3-btn btn-block w3-round-xxlarge w3-blue">{{ __('Reset Password') }}</button>
 

                       
                    </form>

</div>
@endsection
