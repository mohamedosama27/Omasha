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
.sendemail{
    margin-top:30px;
}

</style>


<div class="email-form center-block">

                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

                     
                        <button type="submit" class="w3-btn btn-block w3-round-xxlarge w3-blue sendemail">Send email</button>

                    </form>
</div>
  
@endsection
