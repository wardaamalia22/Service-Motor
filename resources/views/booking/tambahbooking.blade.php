<!DOCTYPE html>
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
            <div class="card">
                <h2 class="text-center mt-3">Tambah Booking</h2>
                <form action="{{ route('postTambahBooking') }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="merek_motor">Merek Motor</label>
                    <input type="text" required name="merek_motor" class="form-control">
                    <label for="seri_motor">Seri Motor</label>
                    <input type="text" required name="seri_motor" class="form-control">
                    <label for="mesin_motor">Mesin Motor</label>
                    <input type="text" required name="mesin_motor" class="form-control">
                    <label for="no_plat">No Plat</label>
                    <input type="text" required name="no_plat" class="form-control">
                    <label for="tgl_booking">Tanggal Booking</label>
                    <input type="date" required name="tgl_booking" class="form-control">
                    <label for="jenis_service">Jenis Service</label>
                    <input type="text" required name="jenis_service" class="form-control">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea required name="deskripsi" class="form-control"></textarea>
                    <label for="status">Status</label>
                    <input type="text" required name="Status" class="form-control">
                    <button class="btn btn-success mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
