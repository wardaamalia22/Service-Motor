{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Document</title>
</head>
<body>
    @include('template.navbar')
    <div class="container mt-5">
        <div class="row">
            <p style="font-family: 'Times New Roman', Times, serif">Login Terlebih Dahulu !!</p>
            <div class="card">
                <form action="{{ route('postLogin') }}" method="POST" class="form-group">
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                    <label for="password">password</label>
                    <input type="password" name="password" class="form-control">
                    
                    @if (Session::has('notiferror'))
                    <p style="color: red">{{ Session::get('notiferror') }}</p>
                    @endif

                    <button type="submit" class="btn btn-success mt-3">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('img/bgmotor.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            filter: blur(3px); /* Efek blur */
            z-index: -1;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        .login-container {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.5), rgba(255, 255, 255, 0.1)), rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            position: relative;
        }

        .login-header {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #ffffff;
        }

        .form-control {
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: rgba(54, 51, 63, 0.85);
            color: #ffffff;
            border: none;
            text-align: center;
        }

        .form-control:focus {
            background-color: rgba(68, 68, 68, 0.85);
            color: #ffffff;
            outline: none;
            box-shadow: none;
        }

        .btn-login {
            background-color: #011447;
            color: white;
            border-radius: 10px;
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #415ae7;
        }

        .alert {
            margin-top: 10px;
        }

        .image-container img {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }

        .register-link {
            margin-top: 20px;
            color: #ffffff;
        }

        .register-link a {
            color: #17a2b8;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('template.navbar')

    <div class="container login-wrapper">
        <div class="login-container">
            <div class="login-header">
                <div class="image-container">
                    <img src="{{ asset('img/wd2.png') }}" alt="Motor Icon">
                </div>
            </div>
            @if (Session::has('notiferror'))
                <div class="alert alert-danger">
                    {{ Session::get('notiferror') }}
                </div>
            @endif
            <form action="{{ route('postLogin') }}" method="POST" class="form-group">
                @csrf
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>

                <button type="submit" class="btn btn-login mt-3">Login</button>
            </form>
            <div class="register-link">
                Belum punya akun? <a href="{{ route('ShowRegisterForm') }}">Daftar terlebih dahulu</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
