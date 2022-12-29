<div class="container-fluid p-0 login-home">
    <div class="wrapper mb-4">
        <div class="login-logo-wrapper w-100 text-center">
            <img src="{{ asset('img/logo.png') }}" class="login-logo" alt="">
        </div>
        {{-- <div class="title-text">
            <div class="title login">
                Login Form</div>
            <div class="title signup">
                Signup Form</div>
        </div> --}}
        @if(session()->has('warning'))
        <div class="alert alert-warning" role="alert">
            {{ session()->get('warning') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
        @elseif ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @else
        <style>
            .login-heade-title-wrapper {
                width: 200%;
                transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }

        </style>
        <div class="login-heade-title-wrapper d-flex align-items-center">
            <legend class="mb-2 text-center h5">Welcome, bdMirror Login</legend>
            <legend class="mb-2 text-center h5">Welcome, bdMirror Registration</legend>
        </div>
        @endif

        <div class="form-container">
            <div class="slide-controls">
                {{-- <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup"> --}}
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab">
                </div>
            </div>
            <div class="form-inner">
                <form action="{{ route('login') }}" class="login" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="field">
                        <select name="user_type" id="" required>
                            <option value="" selected hidden>Login As..</option>
                            <option value="ctz" @if (old('user_type')=="ctz" ) {{ 'selected' }} @endif>Citizen</option>
                            <option value="lauth" @if (old('user_type')=="lauth" ) {{ 'selected' }} @endif>Legal Authority</option>
                        </select>
                    </div>

                    <div class="field">
                        <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number" autocomplete="off" required>

                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot password?</a></div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" name="login_btn" value="Login">
                    </div>
                    <div class="signup-link">
                        Not a member? <a href="">Signup now</a></div>
                </form>
                <form action="{{ route('register') }}" class="signup" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="field">
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                    </div>
                    <div class="field">
                        <input type="text" name="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}" required>
                    </div>
                    <div class="field">
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>
                    <div class="field">
                        <select name="user_type" id="" required>
                            <option value="" selected hidden>Register As..</option>
                            <option value="ctz" @if (old('user_type')=="ctz" ) {{ 'selected' }} @endif>Citizen</option>
                            <option value="lauth" @if (old('user_type')=="lauth" ) {{ 'selected' }} @endif>Legal Authority</option>
                        </select>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password_confirmation" placeholder="Confirm password" value="{{ old('password_confirmation') }}" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" name="register_btn" value="Signup">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", 'label.login', function() {
            $(".login-heade-title-wrapper").css("margin-left", "0%");
            $("form.login").css("margin-left", "0%");
            $(".title-text .login").css("margin-left", "0%");
            localStorage.setItem('sinupActive', 0);
            $(".slider-tab").css("left", "0%");
            $(".slider-tab").css("transform", "scaleX(1)");
        });
        $(document).on("click", 'label.signup', function() {
            $(".login-heade-title-wrapper").css("margin-left", "-100%");
            $("form.login").css("margin-left", "-50%");
            $(".title-text .login").css("margin-left", "-50%");
            localStorage.setItem('sinupActive', 1);
            $(".slider-tab").css("left", "50%");
            $(".slider-tab").css("transform", "scaleX(-1)");
        });

        $(document).on("click", 'form .signup-link a', function(e) {
            e.preventDefault();
            $(".login-heade-title-wrapper").css("margin-left", "-100%");
            $("form.login").css("margin-left", "-50%");
            $(".title-text .login").css("margin-left", "-50%");
            localStorage.setItem('sinupActive', 1);
            $(".slider-tab").css("left", "50%");
            $(".slider-tab").css("transform", "scaleX(-1)");


        });

        $(document).ready(function() {
            if (localStorage.getItem('sinupActive') == 1) {
                $(".login-heade-title-wrapper").css("margin-left", "-100%");
                $("form.login").css("margin-left", "-50%");
                $(".title-text .login").css("margin-left", "-50%");
                $(".slider-tab").css("left", "50%");
                $(".slider-tab").css("transform", "scaleX(-1)");

            } else {
                $(".login-heade-title-wrapper").css("margin-left", "0%");
                $("form.login").css("margin-left", "0%");
                $(".title-text .login").css("margin-left", "0%");
                $(".slider-tab").css("left", "0%");
                $(".slider-tab").css("transform", "scaleX(1)");

            }
        });
        $(document).ready(function() {
            $('input').attr('autocomplete', 'off');
        });

    </script>
</div>
