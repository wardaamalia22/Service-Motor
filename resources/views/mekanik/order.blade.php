<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>
<body>    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h1 class="text-center mb-4">Bayar</h1>
                    <form action="{{ route('editorder', $booking->id) }}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                           <label for="status_service" class="form-label">Orderan</label>
                           <input type="text" name="user_id" value="{{ $booking->user_id }}" required disabled>
                           <input type="text" name="merek_motor" value="{{ $booking->merek_motor}}" required disabled>
                           <input type="text" name="seri_motor" value="{{ $booking->seri_motor }}" required disabled>
                           <input type="text" name="mesin_motor" value="{{ $booking->mesin_motor }}" required disabled>
                           <input type="text" name="no_plat" value="{{ $booking->no_plat }}" required disabled>
                           <input type="text" name="tgl_service" value="{{ $booking->tgl_booking }}" required disabled>
                           <input type="text" name="jenis_service" value="{{ $booking->jenis_service }} "required disabled>
                           <input type="text" name="deskripsi" value="{{ $booking->deskripsi }}" required disabled>
                           <input type="text" name="status_pembayaran" value="{{ $booking->status_pembayaran }}" required disabled>
                           <label for="status_orderan">Status Orderan</label>
                           <select id="status_orderan" name="status_orderan" required class="form-select">
                            <option>belum diterima</option>
                            <option>diterima</option>
                          </select>
                          <label for="status_service">Status Service</label>
                            <select id="status_service" name="status_service" required class="form-select">
                              <option>belum dikerjakan</option>
                              <option>dikerjakan</option>
                              <option>Selesai</option>
                            </select>
                          </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary mt-3">Input</button>
                            <a href="{{ route('homemekanik', $booking->user->id) }}" class="btn btn-danger mt-3">Cancel</a>
                        </div>
                    </form>
                </div>
                <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>