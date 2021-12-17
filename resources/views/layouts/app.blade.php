<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#6366F1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supreme Health Care</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('backend/images/wm.png') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/js/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        input[type="email"],
        input[type="password"] {
            border: none;
            border-radius: 0px;
            outline: none;
        }

        input[type="email"],
        input[type="password"]:focus {
            outline: none;
            border-radius: 0px;
        }

        body {
            background-color: #F1F5F9;
            background: url(https://wallpaperaccess.com/full/136939.jpg);
            background-position-x:left ;
            background-size: 1366px,768px;
            background-repeat: no-repeat;
        }

        .bg-sec {
            background-color: #6366F1;
            color: #ffff;
        }

        .bg-sec:hover {
            color: white;
        }

        .bg-prim {
            background-color: #F1F5F9;
        }

        .text-sec {
            color: #6366F1;
        }

    </style>
</head>

<body>
    <div id="app">
        <main class="py-2">
            @include('sweetalert::alert')
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/popper.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            function disableBack() {
                
                window.history.forward();
            }
            window.onload = disableBack();
            window.onpageshow = function(e) {
                
                if (e.persisted)
                    disableBack();
            }

            $('#myForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },

                    new_pass: {
                        required: true,
                        minlength: 6,
                    },

                    c_pass: {
                        required: true,
                        equalTo: '#newpassword',
                    },
                    password: {

                        required: true,
                        minlength: 6,
                    },

                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    new_pass: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },

                    c_pass: {
                        equalTo: "Password doesn't match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback text-danger');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        $("body").on("contextmenu", function(e) {
            return false;
        });
        $(document).keydown(function(e) {
            if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
                return false;
            }
            if (e.which === 123) {
                return false;
            }
            if (e.metaKey) {
                return false;
            }
            //document.onkeydown = function(e) {
            // "I" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                return false;
            }
            // "J" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                return false;
            }
            // "S" key + macOS
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                return false;
            }
            if (e.keyCode == 224 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                return false;
            }
            // "U" key
            if (e.ctrlKey && e.keyCode == 85) {
                return false;
            }
            // "F12" key
            if (event.keyCode == 123) {
                return false;
            }
        });
    </script>
</body>

</html>
