@extends('layouts.app')
@php
    $user = Auth::user();
@endphp
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
                <div class="login-wrap px-4 py-4 shadow-lg border-rounded-circle bg-white"
                    style="opacity:.9;height:max-content;">
                    <div class="icon d-flex align-items-center px-3 py-2 justify-content-center  shadow-lg bg-sec"style="color:white;">
                        <h4 class="text-white">{{$dept_id->name}} LOGIN</h4>
                    </div>
                    <div class="icon d-flex align-items-center px-3 py-2 justify-content-center  mt-2">
                        
                        <img class="profile-user-img img-fluid img-circle"
                            style="height:100px; width:100px; border-radius:100%;border:1px solid gray;"
                            src="{{ !empty($user->image) ? url('./upload/user_images/' . $user->image) : url('./upload/user_images/no-user.png') }}"
                            name="image" alt="User profile picture">


                    </div>
                    <h6 class="text-center">{{ $user->name }}</h6>
                    <h6 class="text-center">{{ $user->email }}</h6>
                    <h3 class="text-center mb-4"></h3>
                    <form method="POST" action="{{ route('redirect.dept.user',$dept_id) }}" id="myForm">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control  shadow-none  @error('email') is-invalid @enderror"
                                placeholder="Username" name="email" value="{{ $user->email }}" required autocomplete="off"
                                autofocus style="background-color: inherit; border-bottom:1px solid silver" id="emailid">

                        </div>
                        <div class="form-group">
                            <input type="password" id="password"
                                class="form-control outline-none shadow-none @error('password') is-invalid @enderror"
                                name="password" required autocomplete="off" placeholder="Password" autofocus
                                style="background-color: inherit;border-bottom:1px solid silver">
                            @if (Session::has('msg'))
                                <p class="text-center text-danger" style="font-size: 14px">
                                    {{ Session::get('msg') }}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-lg bg-sec" value="LOGIN" >
                            <a href="{{ route('home') }}" class="btn btn-outline-success btn-block btn-md"> <i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> RETURN TO DASHBOARD</a>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
