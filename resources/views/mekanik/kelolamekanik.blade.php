<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> <!-- Load Bootstrap Icons -->
    <title>Admin Dashboard</title>
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
        <div class="card shadow-sm p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">Tabel Mekanik</h5>
                <a href="{{ route('tambahmekanik') }}" class="btn btn-primary">Tambah Mekanik</a>
                <div class="mb-3 text-end">
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead class="table-header">
                            <tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mekanik as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td class="actions">
                                    <a href="{{ route('editmekanik', $item->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('hapusMekanik', $item->id) }}" class="btn btn-danger" onclick="return confirm('Yakin Mau Hapus?')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
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
            $('#example').DataTable();
        });
    </script>
</body>

</html>
