<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <title>Profile</title>
    <style>
        .table-container {
            margin-top: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #007bff;
            color: #000000;
            text-align: center;
            padding: 12px;
        }

        tbody td {
            text-align: center;
            padding: 12px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #ffffff;
        }
    </style>
</head>

<body>
    @include('template.navbar')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Hello</h2>
                <p>Welcome, {{ Auth::user()->name }}!</p>
                <!-- Informasi profil lainnya -->
            </div>
        </div>

        <div class="row">
            <h5>Detail Pesanan Anda</h5>

            @if (Session::has('notifikasi'))
                <div class="alert alert-success" role="alert">
                    <p>{{ Session::get('notifikasi') }}</p>
                </div>
            @endif

            <div class="table-container">
                <table class="table table-striped" id="example">
                    <thead>
                        <tr>
                            <th>Merek Motor</th>
                            <th>Seri Motor</th>
                            <th>Mesin Motor</th>
                            <th>No Plat</th>
                            <th>Tgl Booking</th>
                            <th>Jenis Service</th>
                            <th>Deskripsi</th>
                            <th>Status Orderan</th>
                            <th>Status Pembayaran</th>
                            <th>Status Service</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($booking as $item)
                            <tr>
                                <td>{{ $item->merek_motor }}</td>
                                <td>{{ $item->seri_motor }}</td>
                                <td>{{ $item->mesin_motor }}</td>
                                <td>{{ $item->no_plat }}</td>
                                <td>{{ $item->tgl_booking }}</td>
                                <td>{{ $item->jenis_service }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->status_orderan }}</td>
                                <td>{{ $item->status_pembayaran }}</td>
                                <td>{{ $item->status_service }}</td>
                                <td>
                                    @if ($item->status_pembayaran == 'belum dibayar')
                                        <a href="{{ route('bukti', $item->id) }}" class="btn btn-outline-primary">Bayar</a>
                                    @else
                                        <button class="btn btn-success" disabled>Sudah Bayar</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk notifikasi -->
    {{-- <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda berhasil membayar. Klik OK untuk kembali ke profil.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="redirectButton">OK</button>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        $(document).ready(function() {
            @if(session('notifikasi'))
                $('#successModal').modal('show');
            @endif

            $('#redirectButton').click(function() {
                window.location.href = "{{ route('profil') }}";
            });
        });
    </script>
</body>

</html>
