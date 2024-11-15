<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick permission</title>
    <link rel="stylesheet" href={{ asset("assets/css/permission.css") }}>
</head>

<body>
    <div class="radio-form">
        <form action={{ route('auth.permission.handle') }} method="POST">

            @csrf
            <a href={{ route('home.index') }}><img src={{ asset("assets/images/templatemo-eduwell.png") }} class="logo" alt=""></a>


            <h1>Hi <p style="display: inline; color: #f37134;">{{Auth::user()->name}}</p>, Who you are:</h1>

            <div class="radio-container">

                <label class="radio-control">
                    <input type="radio" name="permission_id" value="1" checked>
                    <div class="radio-input">
                        <i class="fas fa-venus"></i>
                        <span>Student</span>
                    </div>
                </label>

                <label class="radio-control">
                    <input type="radio" name="permission_id" value="2">
                    <div class="radio-input">
                        <i class="fas fa-mars"></i>
                        <span>Lecture</span>
                    </div>
                </label>


            </div>
            <div>
                <button id="logout-btn" type="submit" name="action" value="logout">Log out</button>
                <button type="submit" name="action" value="choose">Choose</button>
            </div>

        </form>
    </div>

</body>

</html>