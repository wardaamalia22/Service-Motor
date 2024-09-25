<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <title>Mekanik Dashboard</title>
    <style>
               body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background-color: #333333;
            color: #fff;
            height: 100%;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            width: 250px;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        .sidebar h4 {
            background: #444;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .sidebar .nav-link {
            color: #ddd;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            border-radius: 5px;
            padding: 10px;
        }
        .sidebar .nav-link:hover {
            background-color: #555;
            color: #fff;
            transform: scale(1.05);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .content {
            flex-grow: 1;
            margin-left: 250px;
            padding: 20px;
            background: linear-gradient(to right, #8d9cac, #374958);
            overflow: auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            margin-bottom: 1.5rem;
            color: #343a40;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #3a242b;
        }
        .stat-card {
            border-radius: 10px;
            background: linear-gradient(135deg, #201b25 0%, #656d7a 100%);
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: background 0.3s ease, border 0.3s ease;
        }
        .stat-card:hover {
            background: #272635;
            border: 2px solid #f5e8f0;
        }
        .stat-card .icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .stat-card h3 {
            margin: 0;
        }
        .stat-card p {
            margin: 0;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center">Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('pesanan') }}">
                    <i class="bi bi-person"></i> Pesanan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('barang') }}">
                    <i class="bi bi-box"></i> Barang
                </a>
            </li>   
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('homeDT') }}">
                    <i class="bi bi-house-door"></i> Home DT
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('uangpepe') }}">
                    <i class="bi bi-coin"></i> Income & Expense
                </a>
            </li>
            <li class="nav-item mb-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </li>
            
        </ul>
    </div>

    <div class="content">
        <h1 class="mb-4">Income & Expense</h1>
        
        <!-- Form untuk Income dan Expense -->
        <div class="card shadow-sm p-3 bg-body rounded">
            <div class="card-body">
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <input type="number" class="form-control" id="user_id" name="user_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                    </div>
                    <div class="mb-3">
                        <label for="pemasukan" class="form-label">Pemasukan</label>
                        <input type="number" class="form-control" id="pemasukan" name="pemasukan" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Barang ID</label>
                        <input type="number" class="form-control" id="barang_id" name="barang_id">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="biaya_penanganan" class="form-label">Biaya Penanganan</label>
                        <input type="number" class="form-control" id="biaya_penanganan" name="biaya_penanganan" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="booking_id" class="form-label">Booking ID</label>
                        <input type="text" class="form-control" id="booking_id" name="booking_id">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Riwayat Transaksi -->
        <div class="card shadow-sm p-3 bg-body rounded mt-4">
            <div class="card-body">
                <h5 class="card-title">Riwayat Transaksi</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Pengguna</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $item)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->tgl_transaksi }}</td>
                                <td>{{ $item->booking->deskripsi }}</td>
                                <td>{{ number_format($item->pemasukan, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->pengeluaran, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-info">
                                <th colspan="4" class="text-center">Total</th>
                                <td>{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                                <td>{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#pesananTable').DataTable();
        });
    </script>
</body>

</html>
