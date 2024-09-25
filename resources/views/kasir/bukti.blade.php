<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Detail Pesanan</title>
</head>
<body>
    @include('template.navbar')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Detail Pesanan dan Informasi Pembayaran yang akan dicetak -->
                <div id="printableArea">
                    <h2>Detail Pesanan</h2>
                    <p>ID Pesanan: {{ $booking->id }}</p>
                    <p>Merek Motor: {{ $booking->merek_motor }}</p>
                    <p>Seri Motor: {{ $booking->seri_motor }}</p>
                    <p>Mesin Motor: {{ $booking->mesin_motor }}</p>
                    <p>No Plat: {{ $booking->no_plat }}</p>
                    <p>Tgl Booking: {{ $booking->tgl_booking }}</p>
                    <p>Jenis Service: {{ $booking->jenis_service }}</p>
                    <p>Deskripsi: {{ $booking->deskripsi }}</p>
                    <p>Status: {{ $booking->status_orderan }}</p>

                    <h3>Barang yang Dibutuhkan</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Stok Barang</th>
                                <th>Harga Barang</th>
                                <th>Jumlah</th>
                                <th>Biaya Penanganan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->barang->stock_barang }}</td>
                                    <td>Rp {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp {{ number_format($item->biaya_penanganan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4>Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h4>

                    <!-- Pilihan Metode Pembayaran -->
                    <h4>Metode Pembayaran</h4>
                    <div class="form-group">
                        <label for="paymentMethod">Pilih Bank:</label>
                        <select id="paymentMethod" class="form-control" onchange="updateBankDetails()">
                            <option value="" disabled selected>Pilih Bank</option>
                            <option value="bca">Bank BCA</option>
                            <option value="bni">Bank BNI</option>
                            <option value="bri">Bank BRI</option>
                            <option value="mandiri">Bank Mandiri</option>
                            <option value="cimb">Bank CIMB</option>
                        </select>
                    </div>

                    <!-- Informasi Pembayaran -->
                    <div id="bankDetails" style="display:none;">
                        <h4 id="bankName"></h4>
                        <p>Nomor Rekening: <strong id="accountNumber"></strong></p>
                        <p>Atas Nama: <strong>WD Service</strong></p>
                    </div>
                </div>

                <!-- Upload Bukti Pembayaran -->
                <h3>Upload Bukti Pembayaran</h3>
                <form action="{{ route('bayar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="bukti">Upload Bukti Transaksi</label>
                        <input type="file" name="bukti" accept="image/jpeg,image/png,image/jpg" class="form-control" required>
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    </div>
                    <!-- Tombol Cetak dan Kirim -->
                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-outline-primary mt-3">Cetak</button>
                    <button type="submit" class="btn btn-outline-success mt-3">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk notifikasi -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // Mengembalikan tampilan setelah print
        }

        function updateBankDetails() {
            var paymentMethod = document.getElementById('paymentMethod').value;
            var bankDetails = {
                'bca': {name: 'Bank BCA', account: '1234567890'},
                'bni': {name: 'Bank BNI', account: '0987654321'},
                'bri': {name: 'Bank BRI', account: '1122334455'},
                'mandiri': {name: 'Bank Mandiri', account: '2233445566'},
                'cimb': {name: 'Bank CIMB', account: '3344556677'},
            };

            if(paymentMethod) {
                document.getElementById('bankName').innerText = bankDetails[paymentMethod].name;
                document.getElementById('accountNumber').innerText = bankDetails[paymentMethod].account;
                document.getElementById('bankDetails').style.display = 'block';
            } else {
                document.getElementById('bankDetails').style.display = 'none';
            }
        }

        @if(session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            document.getElementById('redirectButton').onclick = function() {
                window.location.href = "{{ route('profil') }}";
            };
        @endif
    </script>
</body>
</html>
