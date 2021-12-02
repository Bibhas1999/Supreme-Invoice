@extends('layouts.app')

@section('content')
    <style>
        .row {
            margin-top: 5rem;
        }

    </style>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-sm-5">
                <div class="login-wrap px-4 py-4 shadow-lg border-rounded-circle bg-white"
                    style="height:max-content;">
                    <h4 class="text-sec text-center" style="font-family: 'Lobster', cursive;font-size:15px;"> <img src=" {{ asset('backend/images/wm.png') }}" alt="" srcset=""
                        style="height:100px;width:100px"> </h4>
                    <div class="icon d-flex align-items-center px-3 py-2 justify-content-center  shadow-lg bg-sec"style="color:white;">
                        <h4 class="text-white"> <i class="fas fa-user-graduate"></i> Member Login</h4>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}" id="myForm" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <input type="email"
                                class="form-control  shadow-none  @error('email') is-invalid @enderror"
                                placeholder="Username" name="email" value="" required autocomplete="off"
                                autofocus style="background-color: inherit; border-bottom:1px solid silver" id="emailid">
                            @error('email')
                                <span class="invalid-feedback text-center" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <input type="password" id="password"
                                class="form-control outline-none shadow-none @error('password') is-invalid @enderror"
                                name="password" required autocomplete="off" placeholder="Password" autofocus
                                style="background-color: inherit;border-bottom:1px solid silver">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <a href="{{route('get-email')}}" style="font-size:14px">Forgot Password?</a>
                        <div class="form-group mt-2">
                            <input type="submit" class="btn btn-block btn-lg bg-sec shadow-lg" value="LOGIN"  >
                        </div>
                       
                    </form>


                </div>
            </div>
        </div>
    </div>
    
@endsection
