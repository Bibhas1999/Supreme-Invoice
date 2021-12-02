@extends('layouts.app')

@section('content')
    <style>
        .row {
            margin-top: 5rem;
        }
     .btn:focus{
        border: none;
        outline: none;
     }
        

    </style>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-sm-5">
                <div class="login-wrap px-4 py-4 mt-5 shadow-lg border-rounded-circle bg-white"
                    style="opacity:.9;height:max-content;">
                    
                        <div class="icon d-flex align-items-center px-3 py-2 justify-content-center  shadow-lg bg-sec">
                            <h5 class="text-white"></i>Email Verify</h5>
                        </div>
                    <form method="POST" action="{{route('set-pass')}}" id="myForm">
                        @csrf
                        
                        <div class="form-group mt-3">
                            <input type="email" id="email"
                                class="form-control outline-none shadow-none @error('password') is-invalid @enderror"
                                name="email" required autocomplete="off" placeholder="Enter Email ID" autofocus
                                style="background-color: inherit;border-bottom:1px solid silver">
                            @if (Session::has('msg'))
                                <p class="text-center text-danger font-weight-bold " style="font-size: 14px">
                                    {{ Session::get('msg') }}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-md bg-sec" value="VERIFY" >
                             <a href="{{ route('login') }}" class="btn btn-outline-success btn-block btn-md"> <i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> RETURN TO LOGIN</a>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
