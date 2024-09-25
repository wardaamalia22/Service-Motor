{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    integrity="sha384-QtKfZyPjpeJH5i9wSruAN9oeFpkoy6CtvYmr/b9mJylT2BjkHw3jMhYvh+ALEWeH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .card-header {
            text-align: center;
            background: none;
            border-bottom: none;
        }

        .card-header h1, .card-header h2 {
            color: #333;
        }

        .card-body p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }

        .btn-outline-success {
            background-color: #28a745;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-outline-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h1>Struk Belanjaan</h1>
        </div>
        <div class="card-body">
            <h2>Pesan</h2>
            <p>ID Pesan: {{ $booking->id }}</p>
            <h2>Detail Transaksi</h2>
            <p>Nama Barang: {{ $barang->nama_barang }}</p>
            <p>Nama Barang: {{ $barang->stok_barang }}</p>
            <p>Harga: {{ $barang->harga_barang }}</p>
            <form action="{{ route('bayar') }}" method="POST" class="form-group" enctype="multipart/form-data">
                @csrf
                <label for="bukti" class="text-dark">Upload Bukti Transaksi</label>
                <input type="file" name="bukti" class="form-control" style="background-color: rgba(255, 255, 255, 0.8);" accept="image/*" required>
                <input type="hidden" name="booking_id" value="{{ $booking->id }}" class="form-control">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" class="form-control">
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/datatable.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YcpvFCfyVt3lH8D6NNkmKs5g9FDVL3E5AA5SDNZDxohy9KdcIkS1eNN76jIEhZ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <title>Detail Transaksi</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Detail Transaksi</h1>
        
        <table class="table table-bordered">
            <tr>
                <th>ID Transaksi</th>
                <td>{{ $transaksi->id }}</td>
            </tr>
            <tr>
                <th>Pengguna</th>
                <td>{{ $transaksi->user->name }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $transaksi->tgl_transaksi }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($transaksi->detailTransaksis->first() && $transaksi->detailTransaksis->first()->confirmed)
                        Dikonfirmasi
                    @else
                        Belum Dikonfirmasi
                    @endif
                </td>
            </tr>
        </table>

        <h2>Detail Item</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Item</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detailTransaksis as $detail)
                    <tr>
                        <td>{{ $detail->barang_id }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ $detail->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

