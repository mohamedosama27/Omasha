@extends('bar')
@section('content')
    <style>
        .cardspace {
            margin: 10px;
        }

        .margintop {
            margin-top: 10px;
        }

        .formicon {
            font-size: 20px;
        }

        .formheader {
            font-size: 28px;

        }
        }
    </style>
    <br>
    <div class="w3-card cardspace">

        <div class="cardspace">
            <form method="POST" action="{{ route('addAdmin') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')



                <br>
                <p class="text-center raleway formheader">Add Admin</p>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user formicon"></i></span>
                    <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus>
                </div>
                @error('name')
                    <span role="alert" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror

                <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope formicon"></i></span>
                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" type="email" placeholder="Email" name="email" required
                        autocomplete="email" autofocus>
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
                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                        placeholder="Password" name="password" required autocomplete="current-password">
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
                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                        placeholder="Repeat Password" name="password_confirmation" required autocomplete="current-password">
                </div>

                <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone-square formicon"></i></span>
                    <input class="form-control @error('phone') is-invalid @enderror" type="text"
                        placeholder="Phone Number" value="{{ old('phone') }}" name="phone" required>
                </div>

                @error('phone')
                    <span role="alert" style="color:red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror

                <br>
                <button type="submit" class="w3-btn btn-block w3-round-xxlarge brandcolor">Add Admin</button>
                <br>
                <br>

            </form>
        </div>
    </div>
@endsection
