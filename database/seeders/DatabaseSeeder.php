<?php

namespace Database\Seeders;

use App\Models\artikel;
use App\Models\barang;
use App\Models\booking;
use App\Models\detailtransaksi;
use App\Models\rating;
use App\Models\transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name'=>'wada',
            'email'=>'wada@gmail.com',
            'password'=> bcrypt('123'),
            'role'=>'Admin',
            'no_hp'=>'0812345678', 
            // 'profil' => 'img/anjai1.png',
            'alamat'=>'sukabumi', 
        ]);
        User::create([
            'name'=>'oliv',
            'email'=>'olivia@gmail.com',
            'password'=> bcrypt('321'),
            'role'=>'Pengguna',
            'no_hp'=>'0887654321',
            // 'profil' => 'img/anjai1.png',
            'alamat'=>'cisaat',  
        ]);
        User::create([
            'name'=>'lala',
            'email'=>'lala@gmail.com',
            'password'=> bcrypt('432'),
            'role'=>'Kasir',
            'no_hp'=>'0898765432', 
            // 'profil' => 'img/anjai1.png',
            'alamat'=>'cigunung', 
        ]);
        User::create([
            'name'=>'lost',
            'email'=>'lost@gmail.com',
            'password'=> bcrypt('543'),
            'role'=>'Mekanik',
            'no_hp'=>'08098765', 
            // 'profil' => 'img/anjai1.png',
            'alamat'=>'cipoho', 
        ]);
        User::create([
            'name'=>'betty',
            'email'=>'betty@gmail.com',
            'password'=> bcrypt('654'),
            'role'=>'Owner',
            'no_hp'=>'088976543', 
            // 'profil' => 'img/anjai1.png',
            'alamat'=>'bandung', 
        ]);
        booking::create([
            'user_id'=>1,
            'merek_motor'=>'honda',
            'seri_motor'=>'vario',
            'mesin_motor'=>'150cc',
            'no_plat'=>'F 4ABC UBD', 
            'tgl_booking'=>'2024-07-10', 
            'jenis_service'=>'Ganti Oli Mesin', 
            'deskripsi'=>'Mau ganti oli baru', 
            'status_orderan' => 'diterima', 
            // 'kode_invoice' => 'INV-' . strtoupper(uniqid()), // Generate kode invoice
        ]);
        barang::create([
            // 'user_id'=>1,
            'booking_id'=>1,
            'nama_barang'=>'oli mesin yamaha blue',
            'stock_barang'=>'20',
            'harga'=>'50000',
        ]);
        // barang::create([
        //     // 'user_id'=>2,
        //     'booking_id'=>1,
        //     'nama_barang'=>'Kanvas',
        //     'stock_barang'=>100,
        //     'harga'=>70000,
        // ]);
        
        transaksi::create([
            'user_id' => 1,
            'booking_id' => 1,
            'tgl_transaksi' => Carbon::now()->subDays(10),
            'keterangan' => 'Service Oli Mesin dan Gardan',
            'pemasukan' => 100000,
            'pengeluaran' => 0,
        ]);
        detailtransaksi::create([
            'user_id' => 2,
            'booking_id' => 1,
            'transaksi_id' => 1,
            'barang_id' => 1,
            'jumlah' => 1,
            'biaya_penanganan' => 20000,
            'subtotal' => 70000
        ]);
        artikel::create([
            'user_id'=>1,
            'gambar'=>'kel1.jpg',
            'judul'=>'Cara Merawat Motor Dengan Baik',
            'berita'=>'Motor menjadi moda transportasi yang lebih lincah dibandingkan dengan mobil karena mampu menerjang kemacetan dan lebih efisien digunakan untuk keperluan jarak dekat. Tak jarang juga bagi Anda yang sudah memiliki mobil tetap melengkapi isi garasi Anda dengan memiliki motor. Seperti halnya jenis alat transportasi lain, merawat motor juga harus dilakukan dengan baik agar performanya tidak mengalami penurunan.',
        ]);
        artikel::create([
            'user_id'=>1,
            'gambar'=>'kel2.jpg',
            'judul'=>'Cara Memasang Oli',
            'berita'=>'Penggantian oli motor dapat bervariasi tergantung pada faktor seperti jenis motor dan kondisi penggunaannya. Pabrik biasa merekomendasikan penggantian oli motor setiap 3.000 hingga 10.000 kilometer atau setiap 3 hingga 6 bulan. Untuk mengetahui interval penggantian oli yang spesifik untuk motor, sangat penting untuk merujuk pada buku panduan pemilik yang disediakan oleh pabrik motor.',
        ]);
        artikel::create([
            'user_id'=>1,
            'gambar'=>'mtr1.png',
            'judul'=>'Tips Service Motor Dengan Baik',
            'berita'=>'Merawat motor penting  dilakukan secara rutin. Ada beberapa langkah mudah dan bisa dilakukan secara rutin  di rumah sambil sekaligus melakukan pengecekan.  Ada yang perlu dibawa ke bengkel untuk tindak  lanjut penanganan. ',
        ]);
        artikel::create([
            'user_id'=>1,
            'gambar'=>'mtr2.jpg',
            'judul'=>'Pentingnya Service Motor !!!',
            'berita'=>'https://planetban.com/blog/pentingnya-service-motor-secara-berkala',
        ]);
        artikel::create([
            'user_id'=>1,
            'gambar'=>'mtr3.jpg',
            'judul'=>'Cara Merawat Motor Listrik',
            'berita'=>'https://www.kompasiana.com/liliagandjar/6329db6a08a8b577801388a3/6-cara-merawat-motor-listrik',
        ]);

    }
}
