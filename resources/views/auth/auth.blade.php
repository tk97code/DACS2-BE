<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href={{asset("assets/css/login.css")}}>
    <script src="https://kit.fontawesome.com/e5b75fc3d0.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset("assets/images/favicon.ico") }}>


</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action={{route('auth.register')}} method="POST">

                @csrf
                <a href={{ route('home.index') }}><img src={{ asset("assets/images/templatemo-eduwell.png") }} class="logo" alt=""></a>
                <h1>Create Account</h1>
                <!-- <div class="social-container"> -->
                    <!-- <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a> -->
                    <!-- <a class="btn btn-alt-secondary me-1 my-3 w-100" href="#">
                    <i class="fa-brands fa-google" style="height: 15px; margin-right: 15px;"></i>Register with Google</a>
                </div> -->
                <!-- <span>or use your email for registration</span> -->
                <input type="text" placeholder="Name" name="name"/>
                <input type="email" placeholder="Email" name="email"/>
                <input type="password" placeholder="Password" name="password"/>
                <input type="password" placeholder="Confirm passowrd"/>
                <span>Please choose who you are</span>

                <div>
                    <div class="md-radio md-radio-inline">
                        <input type="radio" name="permission_id" value="1" id="1" required>
                        <label for="1">Student</label>
                    </div>
                    <div class="md-radio md-radio-inline">
                        <input type="radio" name="permission_id" value="2" id="2" required>
                        <label for="2">Lecture</label>
                    </div>
                </div>
                <!-- <input type="submit" value="Sign Up"> -->
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action={{ route('auth.login') }} method="POST">
                @csrf
                <a href={{ route('home.index') }}><img src={{ asset("assets/images/templatemo-eduwell.png") }} class="logo" alt=""></a>
                <h1>Sign in</h1>
                <div class="social-container">
                    <!-- <a href="#" class="social"><i class="fab fa-facebook-f"></i></a> -->
                    <!-- <a href="#" class="social"><i class="fa-brands fa-google"></i></a> -->
                    <a class="btn btn-alt-secondary me-1 my-3 w-100" href={{ route('auth.google') }}>
                    <i class="fa-brands fa-google" style="height: 15px; margin-right: 20px;"></i>Sign in with Google</a>
                    <!-- <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a> -->
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email"/>
                <input type="password" placeholder="Password" name="password"/>
                <a href="#">Forgot your password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Welcome Back!</h1>
                    <p class="quote">To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Hello, Friend!</h1>
                    <p class="quote">Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src={{asset("assets/js/login.js")}}></script>
</body>

</html>