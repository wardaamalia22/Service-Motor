<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Home & About Us</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            margin-bottom: 0;
            position: fixed;
            width: 100%;
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.7); /* Optional: To make navbar slightly transparent */
        }

        .about-us-section {
            padding: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .about-us-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .about-us-image {
            flex: 1;
            padding: 50px;
            max-width: 50%;
        }

        .about-us-text {
            flex: 1;
            padding: 45px;
            max-width: 90%;
        }

        .about-us-text h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .about-us-text p {
            font-size: 16px;
            line-height: 1.6;
            text-align: justify;
        }

        .history-section {
            padding: 10px;
            max-width: 100%;
            text-align: justify;
        }

        .history-section h5 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .history-section p {
            font-size: 16px;
            height: 180px;
            line-height: 1.6;
        }

        footer {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>
    @include('template.navbar')

    <!-- About Us Section -->
    <div class="about-us-section">
        <div class="about-us-content">
            <div class="about-us-text">
                <h2>About Us</h2>
                <p>Sepeda motor kini bukan hanya menjadi sarana transportasi produktif bagi masyarakat Indonesia. Sepeda motor sudah menjadi bagian dari hobi dan gaya hidup, bahkan bisa mengantarkan pada prestasi tertentu yang membanggakan. Untuk menemani masyarakat beraktivitas dan menggapai beragam mimpinya, PT Astra Honda Motor menghadirkan solusi mobilitas bagi masyarakat dengan produk dan layanan terbaik. Sejak pertama kali hadir di Indonesia, sepeda motor Honda selalu dicintai dan dipercaya menjadi partner berkendara masyarakat. Berbekal kepercayaan ini, PT Astra Honda Motor secara konsisten melakukan inovasi pada produk dan teknologinya, terus meningkatkan layanan di jaringan penjualan dan purna jual Honda, serta intens beraktivitas dan berkomunikasi dengan masyarakat.</p>
            </div>
            <div class="about-us-image">
                <img src="{{ asset('img/kami.jpg') }}" alt="About Us Image" class="img-fluid">
            </div>
        </div>
        <div class="history-section">
            <h2 style="text-align: center">Sejarah</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">1980-2000</h5>
                            <p class="card-text">Honda mendirikan perusahannya sendiri yang diberikan nama Tokai Seiki yang
                                berfokus pada pembuatan piston Ring untuk Toyota. Namun pada tahun 1944, perusahaan tersebut
                                hancur selama perang dunia ke dua berlangsung, dan 1945 pabrik Tokai seiki juga runtuh akibat gempa
                                bumi. Setelah perang usai Honda menjual sisa perusahaan yang dapat diselamatkan kepada Toyota,
                                yang kemudian uangnya digunakan untuk mendirikan Honda Technical Research Institute pada bulan
                                Oktober 1946.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">2000-2024</h5>
                            <p class="card-text">Honda mulai memproduksi sepeda motor. Motor pertama Honda diberi nama Honda
                                Tipe A, dengan body mirip sepeda gayung namun menggunakan mesin buatan Honda sendiri. Motor ini
                                terjual hingga tahun 1951. Yang kedua ialah Honda Tipe D yang diproduksi tahun 1949, berbeda dari tipe
                                sebelumnya, dimana tipe ini merupakan sepeda motor yang sesungguhnya dan pertama yang
                                menggunakan system semi otomatis di Gearbox.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
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
                        <li><i class="bi bi-telephone"></i> +62 123 456 789</li>
                        <li><i class="bi bi-envelope"></i> info@wadaservice.com</li>
                        <li><i class="bi bi-geo-alt"></i> PT WD Service, Jakarta 14350, Indonesia</li>
                    </ul>
                </div>

                <!-- Social Media Section -->
                <div class="col-md-4">
                    <h5>Ikuti Kami</h5>
                    <div class="social-media">
                        <a href="https://www.instagram.com/wadafolklore?igsh=cXU5bzkybWpsZzRw" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/wadafolklore?igsh=cXU5bzkybWpsZzRw" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2024 Bengkel Kami. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
