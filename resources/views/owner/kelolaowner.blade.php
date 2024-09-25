<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin Dashboard</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background-color: #343a40;
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

        .sidebar .nav-link {
            color: #ddd;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
            color: #fff;
        }

        .sidebar .text-center {
            margin-bottom: 20px;
        }

        .content {
            flex-grow: 1;
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
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
            background-color: #0056b3;
        }

        .stat-card {
            border-radius: 10px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .stat-card h3 {
            margin: 0;
        }

        .stat-card .icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .stat-card p {
            margin: 0;
            font-size: 1.2rem;
        }

        .table-header th {
            background-color: #343a40;
            color: #000000;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table-striped tbody tr:hover {
            background-color: #e9ecef;
        }

        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3 class="text-center">Dashboard</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homeadmin') }}">Home</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('kelolapengguna') }}">
                    <i class="bi bi-person"></i> Pengguna
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('kelolamekanik') }}">
                    <i class="bi bi-tools"></i> Mekanik
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('kelolakasir') }}">
                    <i class="bi bi-cash"></i> Kasir
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('kelolaowner') }}">
                    <i class="bi bi-building"></i> Owner
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('kelolabooking') }}">
                    <i class="bi bi-calendar-check"></i> Booking
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('keloladetailbooking') }}">
                    <i class="bi bi-file-earmark-text"></i> Detail Booking
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
        <div class="container mt-5">
            <h3>Grafik Penjualan</h3>
            <canvas id="myChart" width="700" height="200"></canvas>
        </div>
    
        {{-- Tabel Transaksi --}}
        <div class="card shadow-sm p-3 mt-5 bg-body rounded">
            <div class="card-body">
                <h5 class="card-title">Riwayat Transaksi</h5>
                <div class="table-responsive table-container">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Transaksi</th>
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
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->User->name }}</td>
                                <td>{{ $item->booking->tgl_booking }}</td>
                                <td>{{ $item->booking->deskripsi }}</td>
                                <td>Rp {{ number_format($item->pemasukan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->pengeluaran, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-info">
                                <th colspan="4" class="text-center">Total</th>
                                <th>{{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                                <th>{{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        {{-- Tabel Log Aktivitas --}}
        {{-- <div class="card shadow-sm p-3 mt-5 bg-body rounded">
            <div class="card-body">
                <h5 class="card-title">Log Aktifitas</h5>
                <div class="table-responsive table-container">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aktifitas login</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($log as $item)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->user->role}}</td>
                        <td>{{ $item->aktifitas_login }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        </div> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels), // Updated to use $labels instead of $months
                datasets: [{
                    label: 'jmlhBooking',
                    data: @json($jumlahServis), // Assuming you want to display the number of services booked per month
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    </script> --}}
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Ubah tipe grafik ke 'line' dan aktifkan area
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Jumlah Booking',
                    data: @json($jumlahServis),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat().format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Booking'
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>
