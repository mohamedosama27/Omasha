@extends('bar')

@section('content')
<link href="css/distributor_form.css" rel="stylesheet" type="text/css" media="all" />
<div class="brandcolor text-center form-header">Customize Wristbands Form</div>
<div class="container">
    <p class="center-block">Do you want to customize a Wristband ? You’re in the Right Place
Please complete this form and one of our Sales team member
will contact you shortly.</p>
    <form method="POST" class="center-block" action="{{route('customize.store')}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    

           
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

           

            <input type="Text" class="form-control"  Name="category" placeholder="Category (ex. school seniors, uni student activity, NGO, etc)" value="{{ old('category') }}" required>
            @error('category')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror

            <input type="Text" class="form-control"  Name="quantity" placeholder="Estimated Quantity" value="{{ old('quantity') }}" required>
            @error('quantity')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
        <button type="submit" class="btn brandcolor raleway center-block">SUBMIT</button>

    </form>

</div>
@endsection
