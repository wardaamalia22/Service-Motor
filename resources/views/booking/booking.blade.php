{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Booking</title>
</head>
<body>
    @include('template.navbar')
    <div class="container mt-5">
        <div class="row">
            <p style="font-family: 'Times New Roman', Times, serif">Isi Data Reservasimu !!!</p>
            <div class="card">

                <!-- Tampilkan pesan sesi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('postBooking') }}" method="POST" class="form-group">
                    @csrf
                    <label for="merek_motor">Merek Motor</label>
                    <input type="text" name="merek_motor" class="form-control">
                    <label for="seri_motor">Seri Motor</label>
                    <input type="text" name="seri_motor" class="form-control">
                    <label for="mesin_motor">Mesin Motor</label>
                    <input type="text" name="mesin_motor" class="form-control">
                    <label for="no_plat">No Plat</label>
                    <input type="text" name="no_plat" class="form-control">
                    <label for="tgl_booking">Tanggal Booking</label>
                    <input type="date" name="tgl_booking" class="form-control">
                    <label for="jenis_service">Jenis Service</label>
                    <input type="text" name="jenis_service" class="form-control">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
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
    <title>Booking</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .booking-container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header {
            background-color: #3b5979;
            color: white;
            font-size: 1.75rem;
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid #ccc;
        }
        .card-body {
            padding: 30px;
        }
        .form-label {
            font-weight: bold;
            color: #2b343d;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #a8bdd3;
            box-shadow: 0 0 5px rgba(0, 86, 179, 0.5);
        }
        .btn-submit {
            background-color: #2a3f57;
            color: #fff;
            border-radius: 5px;
            width: 100%;
            padding: 12px;
            font-size: 1.2rem;
            border: none;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-submit:hover {
            background-color: #748eac;
            transform: translateY(-2px);
        }
        .alert {
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    @include('template.navbar')

    <div class="container booking-container">
        <div class="card shadow-sm">
            <div class="card-header">
                Isi Data Reservasimu
            </div>
            <div class="card-body">
                <!-- Tampilkan pesan sesi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('postBooking') }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="merek_motor" class="form-label">Merek Motor</label>
                    <input type="text" name="merek_motor" class="form-control">

                    <label for="seri_motor" class="form-label">Seri Motor</label>
                    <input type="text" name="seri_motor" class="form-control">

                    <label for="mesin_motor" class="form-label">Mesin Motor</label>
                    <input type="text" name="mesin_motor" class="form-control">

                    <label for="no_plat" class="form-label">No Plat</label>
                    <input type="text" name="no_plat" class="form-control">

                    <label for="tgl_booking" class="form-label">Tanggal Booking</label>
                    <input type="date" name="tgl_booking" class="form-control">

                    <label for="jenis_service" class="form-label">Jenis Service</label>
                    <input type="text" name="jenis_service" class="form-control">

                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"></textarea>

                    <button type="submit" class="btn btn-submit mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
