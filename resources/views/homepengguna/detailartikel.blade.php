<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Detail Artikel</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .detail-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        img.img-fluid {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        img.img-fluid:hover {
            transform: scale(1.05);
        }
        h2 {
            font-weight: bold;
            color: #333333;
        }
        p {
            text-align: justify;
            color: #666666;
            line-height: 1.6;
        }
        .detail-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        @media (min-width: 768px) {
            .detail-content {
                flex-direction: row;
            }
        }
    </style>
</head>
<body>
    @include('template.navbar')

    <div class="container detail-container mt-5">
        <div class="row">
            <!-- Gambar -->
            <div class="col-md-6">
                <img src="{{ asset('img/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid">
            </div>
            <!-- Teks -->
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h2>{{ $artikel->judul }}</h2>
                <p>{{ $artikel->berita }}</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
