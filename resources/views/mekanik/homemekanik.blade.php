<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                    <i class="bi bi-house-door"></i> Incom & Expence
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
        <div class="container">
            <h1 class="mb-4">Welcome to the Mekanik Dashboard</h1>
            {{-- <div class="row">
                <div class="col-md-4">
                    <div class="stat-card"> --}}
                        {{-- <div class="icon"><i class="bi bi-person-check"></i></div>
                        <h3>123</h3>
                        <p>Users</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="icon"><i class="bi bi-tools"></i></div>
                        <h3>45</h3>
                        <p>Mekanik</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="icon"><i class="bi bi-cash-stack"></i></div>
                        <h3>Rp. 10.000.00</h3>
                        <p>Pemasukkan</p>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="card mt-4">
                <div class="card-header">
                    Recent Activity
                </div>
                <div class="card-body">
                    <p>No recent activity.</p>
                </div>
            </div> --}}
        </div>
    </div>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
