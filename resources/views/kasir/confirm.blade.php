<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Konfirmasi Pembayaran</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin-top: 2rem;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .card h1 {
            color: #007bff;
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
            padding: 0.75rem 1rem;
            background-color: #ffffff;
        }

        .form-control:disabled,
        .form-select:disabled {
            background-color: #e9ecef;
            color: #6c757d;
        }

        .btn {
            border-radius: 4px;
            font-size: 1rem;
            padding: 0.75rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #ffffff;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: #ffffff;
            font-weight: 600;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-label {
            font-weight: 500;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <h1 class="text-center mb-4">Konfirmasi Pembayaran</h1>
                    <form action="{{ route('editconfirm', $booking->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="status_pembayaran" class="form-label">Informasi Orderan</label>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="user_id" value="{{ $booking->user_id }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="merek_motor" value="{{ $booking->merek_motor }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="seri_motor" value="{{ $booking->seri_motor }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="mesin_motor" value="{{ $booking->mesin_motor }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="no_plat" value="{{ $booking->no_plat }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="tgl_booking" value="{{ $booking->tgl_booking }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="jenis_service" value="{{ $booking->jenis_service }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" name="deskripsi" value="{{ $booking->deskripsi }}" disabled>
                                </div>
                                <div class="col-12 mb-2">
                                    {{-- <input type="text" class="form-control" value="{{ $booking->bukti->foto }}" disabled> --}}
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                            <select id="status_pembayaran" name="status_pembayaran" required class="form-select">
                                <option value="belum dibayar">Belum Dibayar</option>
                                <option value="Sedang dikonfirmasi">Sedang Dikomfirmasi</option>
                                <option value="lunas">Lunas</option>
                                {{-- <option value="dibatalkan">Dibatalkan</option> --}}
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            <a href="{{ route('homekasir', $booking->user->id) }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
