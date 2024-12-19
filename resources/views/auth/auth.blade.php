<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href={{asset("assets/css/login.css")}}>
    <script src="https://kit.fontawesome.com/e5b75fc3d0.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset("assets/images/favicon.ico") }}>
    <style>
        .eggy.top-right {
            z-index: 1000;
        }
    </style>

</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form onsubmit="return false">
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
                <input type="text" placeholder="Name" name="name" id="name-signup" />
                <input type="email" placeholder="Email" name="email" id="email-signup" />
                <input type="password" placeholder="Password" name="password" id="password-signup" />
                <input type="password" placeholder="Confirm passowrd" />
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
                <button id="sign-up-btn">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form onsubmit="return false">
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
                <input type="email" placeholder="Email" name="email" id="email-signin"/>
                <input type="password" placeholder="Password" name="password" id="password-signin"/>
                <a href="#">Forgot your password?</a>
                <button id="sign-in-btn" >Sign In</button>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src={{asset("assets/js/login.js")}}></script>
    <script type="module">
        import * as sR0eggyJs from 'https://esm.run/@s-r0/eggy-js';

        $('#sign-up-btn').click((e) => {
            let data = new FormData();
            data.append('_token', '{{csrf_token()}}');
            data.append('name', $('#name-signup').val());
            data.append('email', $('#email-signup').val());
            data.append('password', $('#password-signup').val());
            data.append('permission_id', document.querySelector('input[name="permission_id"]:checked').value);
            $.ajax({
                type: 'post',
                url: "{{route('auth.register')}}",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: (response) => {
                    sR0eggyJs.Eggy({
                        title: 'Success!',
                        message: 'User registered successfully!',
                        type: 'success'
                    });
                    $('#name-signup').val() = "";
                    $('#email-signup').val() = "";
                    $('#passowrd-signup').val() = "";
                    console.log('Registration successful!');
                },
                error: (xhr) => {
                    if (xhr.status === 422) {
                        // Lấy danh sách lỗi từ phản hồi
                        const errors = xhr.responseJSON.errors;

                        // Hiển thị từng lỗi
                        Object.keys(errors).forEach((field) => {
                            const errorMessage = errors[field][0]; // Lấy thông báo lỗi đầu tiên
                            sR0eggyJs.Eggy({
                                title: 'Validation Error',
                                message: `${field}: ${errorMessage}`,
                                type: 'error'
                            });
                        });
                    } else {
                        // Xử lý lỗi khác nếu có
                        sR0eggyJs.Eggy({
                            title: 'Error!',
                            message: 'An unexpected error occurred.',
                            type: 'error'
                        });
                    }
                }
            });
        });

        $('#sign-in-btn').click((e) => {
            let data = new FormData();
            data.append('_token', '{{csrf_token()}}');
            data.append('email', $('#email-signin').val());
            data.append('password', $('#password-signin').val());
            $.ajax({
                type: 'post',
                url: "{{route('auth.login')}}",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: (response) => {
                    sR0eggyJs.Eggy({
                        title: 'Success!',
                        message: 'User logged in successfully!',
                        type: 'success'
                    });
                    window.location.href =response.route;
                },
                error: (xhr) => {
                    if (xhr.status === 422) {
                        // Lấy danh sách lỗi từ phản hồi
                        const errors = xhr.responseJSON.errors;

                        // Hiển thị từng lỗi
                        Object.keys(errors).forEach((field) => {
                            const errorMessage = errors[field][0]; // Lấy thông báo lỗi đầu tiên
                            sR0eggyJs.Eggy({
                                title: 'Validation Error',
                                message: `${field}: ${errorMessage}`,
                                type: 'error'
                            });
                        });
                    } else {
                        // Xử lý lỗi khác nếu có
                        sR0eggyJs.Eggy({
                            title: 'Error!',
                            message: 'An unexpected error occurred.',
                            type: 'error'
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>