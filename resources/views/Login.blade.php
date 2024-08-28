<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/Login.css') }}">
</head>
<body>

    <div class="wrapper">
        <form action="{{ URL::asset('/proc_login') }}" method="POST">

            @csrf
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" placeholder="Username" name="txt_username">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="txt_pw">
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <br>
                <a href="#">Register</a></p>
            </div>

        </form>

    </div>

</body>
</html>
