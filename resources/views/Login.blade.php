<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="shortcut icon" href="{{ URL::asset('img/POS_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/Login.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .lds-dual-ring,
        .lds-dual-ring:after {
            box-sizing: border-box;
        }

        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6.4px solid #a5a5a5;
            border-color: #a5a5a5 transparent #a5a5a5 transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="loader"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.801); z-index: 9999;">
            <div class="lds-dual-ring"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 3rem;">
            </div>
            <div class="text-center"
                style="position: absolute; top: 60%; left: 50%; transform: translate(-50%, 0%); color:#a5a5a5">
                <b>Loading...</b>
            </div>
        </div>
        <form action="{{ URL::asset('/proc_login') }}" method="POST">
            @csrf
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" placeholder="Username" name="txt_username">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="txt_password">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <br>
                    <a href="#">Register</a>
                </p>
            </div>

        </form>

    </div>
    <script>
        var input1 = document.querySelector('.pswrd');
        var show1 = document.querySelector('.show');

        show1.addEventListener('click', active1);

        function active1() {
            if (input1.type === "password") {
                input1.type = "text";
                show1.style.color = "white";
                show1.textContent = "HIDE";
            } else {
                input1.type = "password";
                show1.textContent = "SHOW";
                show1.style.color = "white";
            }
        }
        document.getElementById('form_login').addEventListener('submit', (e) => {
            e.preventDefault(); // Cegah submit form default
            document.querySelector('.loader').style.display = 'block'; // Tampilkan loader
            setTimeout(() => {
                document.getElementById('form_login').submit(); // Lanjutkan submit setelah delay
            }, 1000);
        });
    </script>
    @if (session('error_akses'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error_akses') }}',
            })
        </script>
    @endif
    @if (session('error_belumlogin'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Anda harus login terlebih dahulu.',
            })
        </script>
    @endif
</body>

</html>
