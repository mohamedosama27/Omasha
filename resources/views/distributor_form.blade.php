@extends('bar')

@section('content')
<link href="css/distributor_form.css" rel="stylesheet" type="text/css" media="all" />

<div class="container">
    <p class="center-block">Are YOU interested in becoming an OMASHA Distributor?
Please complete this form and one of our distributor relations
team members will contact you shortly</p>
    <form method="POST" class="center-block" action="{{route('distributor.store')}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    

            <input type="Text" class="form-control "  Name="business_name" placeholder="Business Name" value="{{ old('business_name') }}" required>
            @error('business_name')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror  
            <input type="Text" class="form-control"  Name="contact_name" placeholder="Contact Name" value="{{ old('contact_name') }}" required>
            @error('contact_name')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror  
            <input type="email" class="form-control"  Name="email" placeholder="Email Address" value="{{ old('email') }}">
            @error('email')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror 

                                
      <input class="form-control @error('phone') is-invalid @enderror" type="text" placeholder="Phone Number" name="phone" required>

   @error('phone')
                                    <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <br>
                                @enderror   

            <input type="Text" class="form-control"  Name="address" placeholder="Store Address" value="{{ old('address') }}" required>
            @error('address')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror

            <input type="Text" class="form-control"  Name="city" placeholder="City , Country" value="{{ old('city') }}" required>
            @error('city')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror

            <input type="Text" class="form-control"  Name="social_media" placeholder="Store Instagram/Facebook Page" value="{{ old('social_media') }}" required>
            @error('social_media')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
        <button type="submit" class="btn brandcolor raleway center-block">SUBMIT</button>

    </form>

</div>
@endsection
