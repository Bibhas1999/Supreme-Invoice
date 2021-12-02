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
                    style="opacity:.9;height:max-content;">

                    <div class="icon d-flex align-items-center px-3 py-2 justify-content-center  shadow-lg bg-sec"
                        >
                        <h4 class="text-white">Set New Password</h4>

                    </div>

                    <div class="icon d-flex align-items-center px-3 py-3 justify-content-center  ">

                        <img class="profile-user-img img-fluid img-circle"
                            style="height:100px; width:100px; border-radius:100%;border:1px solid gray;"
                            src="{{ !empty($user->image) ? url('./upload/user_images/' . $user->image) : url('./upload/user_images/no-user.png') }}"
                            name="image" alt="User profile picture">


                    </div>


                    <h6 class="text-center">{{ $user->name }}</h6>
                    <h6 class="text-center">{{ $user->email }} <span><a href="{{route('get-email')}}" style="font-size: 13px;text-decoration:underline;" >Not You?</a></span> </h6>

                    <form method="POST" action="{{ route('set-new-pass', $user->id) }}" id="myForm">
                        @csrf

                        <div class="form-group ">
                            <input type="password" id="newpassword" class="form-control outline-none shadow-none "
                                name="new_pass" required autocomplete="off" placeholder="New Password" autofocus
                                style="background-color: inherit;border-bottom:1px solid silver">

                        </div>
                        <div class="form-group ">
                            <input type="password" class="form-control outline-none shadow-none" name="c_pass" required
                                autocomplete="off" placeholder="Confirm Password" autofocus
                                style="background-color: inherit;border-bottom:1px solid silver">
                        </div>

                        <div class="form-group mt-2">
                            <input type="submit" class="btn btn-block btn-lg bg-sec" value="SUBMIT" >
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
