<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Register</title>
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

        .register-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        .register-container {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.5), rgba(255, 255, 255, 0.1)), rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            position: relative;
        }

        .register-header {
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

        .btn-register {
            background-color: #011447;
            color: white;
            border-radius: 10px;
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #415ae7;
        }

        .alert {
            margin-top: 10px;
        }

        .login-link {
            margin-top: 20px;
            color: #ffffff;
        }

        .login-link a {
            color: #17a2b8;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('template.navbar')

    <div class="container register-wrapper">
        <div class="register-container">
            <div class="register-header">
                <h4>Daftar Akun</h4>
            </div>
            @if (Session::has('notiferror'))
                <div class="alert alert-danger">
                    {{ Session::get('notiferror') }}
                </div>
            @endif
            <form action="{{ route('postRegister') }}" method="POST" class="form-group">
                @csrf
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>

                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>

                <label for="no_hp" class="form-label">No. HP</label>
                <input type="no_hp" name="no_hp" class="form-control" required>

                <label for="alamat" class="form-label">Alamat</label>
                <input type="alamat" name="alamat" class="form-control" required>

                {{-- <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required> --}}

                <button type="submit" class="btn btn-register mt-3">Daftar</button>
            </form>
            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
