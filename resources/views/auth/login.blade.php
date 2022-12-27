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
        <legend class="mb-2">{{ __('Welcome, bdMirror Login') }}</legend>
        @endif

        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab">
                </div>
            </div>
            <div class="form-inner">
                <form action="{{ route('citizen.login') }}" class="login" method="post" enctype="multipart/form-data">
                    @csrf
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
                <form action="{{ route('citizen.register') }}" class="signup" method="post" enctype="multipart/form-data">
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
            $("form.login").css("margin-left", "0%");
            $(".title-text .login").css("margin-left", "0%");
            localStorage.setItem('sinupActive', 0);
        });
        $(document).on("click", 'label.signup', function() {
            $("form.login").css("margin-left", "-50%");
            $(".title-text .login").css("margin-left", "-50%");
            localStorage.setItem('sinupActive', 1);
        });

        $(document).on("click", 'form .signup-link a', function(e) {
            e.preventDefault();
            $("form.login").css("margin-left", "-50%");
            $(".title-text .login").css("margin-left", "-50%");
            localStorage.setItem('sinupActive', 1);
        });

        $(document).ready(function() {
            if (localStorage.getItem('sinupActive') == 1) {
                $("form.login").css("margin-left", "-50%");
                $(".title-text .login").css("margin-left", "-50%");
                $(".slider-tab").css("left", "50%");
            } else {
                $("form.login").css("margin-left", "0%");
                $(".title-text .login").css("margin-left", "0%");
                $(".slider-tab").css("left", "0%");
            }
        });
        $(document).ready(function() {
            $('input').attr('autocomplete', 'off');
        });

    </script>
</div>
