<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
    body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            background-color: #ffffff; /* Background putih */
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            white-space: nowrap;
            scroll-behavior: smooth;
            padding: 20px 0;
        }

        .card-wrapper {
            flex: 0 0 auto;
            width: 300px;
            margin: 0 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-wrapper:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .section {
            background: #f8f9fa;
            padding: 40px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 30px;
            text-align: center;
        }

        .section h5 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
        }

        .section p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .section .btn-dark {
            background: #000;
            border: none;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        .section .btn-dark:hover {
            background: #555;
            transform: scale(1.05);
        }

        .section i {
            font-size: 2rem;
            color: #000;
            margin-bottom: 10px;
        }

        .image-text-section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        .image-text-section img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .text-section {
            color: #333;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            flex: 1;
            margin-left: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 40px 0;
            width: 100%;
            position: relative;
            left: 0;
            bottom: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .footer-container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .social-media a {
            font-size: 1.5rem;
            margin-right: 10px;
            color: white;
            transition: color 0.3s, transform 0.3s;
        }

        .social-media a:hover {
            color: #ddd;
            transform: scale(1.2);
        }

        .hero {
            background: url('{{ asset('img/hero-background.jpg') }}') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            z-index: 1;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 20px;
            z-index: 1;
        }

        .hero .btn-primary {
            background: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 1.1rem;
            margin-top: 20px;
            transition: background 0.3s, transform 0.3s;
            z-index: 1;
        }

        .hero .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .section-dark {
            background: #333;
            color: white;
            padding: 40px 20px;
            border-radius: 10px;
            margin-top: 30px;
        }

        .section-dark h5 {
            color: white;
        }

        .section-dark p {
            color: #ddd;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-in-left {
            opacity: 0;
            animation: fadeInLeft 3s forwards;
        }

        .fade-in-right {
            opacity: 0;
            animation: fadeInRight 3s forwards;
        }

        .animated {
            opacity: 1 !important;
        }
    </style>
</head>
<body>
    @include('template.navbar')
    @csrf
    <div class="container">
        <div class="row align-items-center image-text-section">
            <div class="col-md-6">
                <img src="{{ asset('img/kami.jpg') }}" alt="Welcome Image" class="img-fluid">
            </div>
            <div class="col-md-6 text-section">
                <h3 class="text-center font-weight-bold">Selamat Datang di Bengkel!</h3>
                <p style="text-align: justify">Service motor adalah proses pemeliharaan dan perbaikan sepeda motor untuk memastikan kinerjanya tetap optimal dan umur panjang. Service motor sangat penting untuk menjaga agar motor tetap dalam kondisi baik dan aman digunakan. Lakukan service secara berkala di bengkel terpercaya hanya di WD Service aja. Ayo Booking Sekarang !!</p>
            </div>  
        </div>

        <!-- Booking Section -->
        <div class="section fade-in-left">
            <i class="bi bi-calendar-check"></i>
            <h5>Anda bingung Service Motor terbaik dimana?</h5>
            <p>Yang Pasti Cuma di Wada Service Aja</p>
            <p>Ayo Booking sekarang !!!</p>
            <a href="{{ route('booking') }}" class="btn btn-dark">Booking</a>
        </div>

        <!-- Guarantee Section -->
        <div class="section-dark fade-in-right">
            <i class="bi bi-shield-check"></i>
            <h5>Garansi Kualitas</h5>
            <p>Kami menjamin kualitas terbaik untuk setiap layanan yang kami berikan. Di Wada Service, kepuasan pelanggan adalah prioritas utama kami.</p>
            <ul style="list-style: none; padding-left: 0;">
                <li><i class="bi bi-wrench-adjustable-circle"></i> Perbaikan Profesional</li>
                <li><i class="bi bi-check-circle"></i> Penggunaan Suku Cadang Asli</li>
                <li><i class="bi bi-clock"></i> Pelayanan Cepat dan Tepat Waktu</li>
                <li><i class="bi bi-shield-fill-exclamation"></i> Garansi Pengerjaan 100%</li>
            </ul>
        </div>

        <!-- Artikel Section -->
        <h3 class="mt-5">Artikel ></h3>
        <div class="card-container">
            @foreach ($artikel as $item)
            <div class="card-wrapper">
                <a href="{{ route('detailartikel', $item->id) }}" class="card-link">
                    <div class="card">
                        <img src="{{ asset('img/'.$item->gambar) }}" alt="Article Image" class="card-img-top">
                        <div class="card-body">
                            <p class="card-text">{{ $item->judul }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-white mt-5 py-4">
        <div class="footer-container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4">
                    <h5>Tentang Kami</h5>
                    <p>Service Motor Terbaik Hanya Ada di WD Service</p>
                </div>

                <!-- Contact Section -->
                <div class="col-md-4">
                    <h5>Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-telephone"></i> +62 857 2129 5652</li>
                        <li><i class="bi bi-envelope"></i> info@wadaservice.com</li>
                        <li><i class="bi bi-geo-alt"></i> PT WD Service, Jakarta 14350, Indonesia</li>
                    </ul>
                </div>

                <!-- Social Media Section -->
                <div class="col-md-4">
                    <h5>Ikuti Kami</h5>
                    <div class="social-media">
                        <a href="https://www.instagram.com/wadafolklore?igsh=cXU5bzkybWpsZzRw" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/wardafolklore?igsh=cXU5bzkybWpsZzRw" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2024 Bengkel Kami. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Load Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
