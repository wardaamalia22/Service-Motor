<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\booking;
use App\Models\bukti;
use App\Models\detailtransaksi;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function detailtransaksi(Request $request)
    {
        // Validasi data transaksi
        $request->validate([
            'transaksi_id' => 'required|exists:barangs,id',
            'booking_id' => 'required|exists:barangs,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Buat transaksi baru
        $transaksi = new detailtransaksi();
        $transaksi->transaksi_id = $request->transaksi_id;
        $transaksi->booking_id = $request->pesan_id;
        $transaksi->barang_id = $request->barang_id;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->save();

        // Kurangi stok barang
        $barang = barang::findOrFail($request->barang_id);
        $barang->kurangiStok($request->jumlah);

        return redirect()->route('homemekanik')->with('success', 'Transaksi berhasil ditambahkan dan stok barang dikurangi.');
    }
    //
    function homeDT()
    {
        $user = Auth::user();
        $detail = detailtransaksi::with(['user', 'booking', 'barang', 'transaksi'])->get();

        return view('Mekanik.homeDT', compact('detail', 'user'));
    }
    // function DT($id)
    // {
    //     $user = User::find($id);
    //     $booking = booking::find($id);
    //     $transaksi = transaksi::find($id);
    //     return view('Mekanik.DT', compact('user', 'booking', 'transaksi'));
    // }

    // public function bayar(Request $request)
    // {
    //     $request->validate([
    //         'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    //     ]);

    //     $booking = booking::where('id', $request->booking_id)->first();

    //     $bukti = bukti::create([
    //         'booking_id' => $request->booking_id,
    //         'foto' => $request->file('foto')->store('img'),
    //         'user_id' => Auth::id()
    //     ]);

    //     $booking->update(['status_pembayaran' => 'Sedang dikonfirmasi']);

    //     $user = Auth::user();
    //     return redirect()->route('profil', $user->id)->with('notifikasi', 'Berhasil Mengupload Bukti, Menunggu dikonfirmasi Kasir');
    // }

    public function bayar(Request $request)
{
    // Validasi input bukti pembayaran
    $request->validate([
        'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Cek apakah file bukti pembayaran diunggah
    if ($request->hasFile('bukti')) {
        // Ubah nama file dan simpan ke folder 'uploads'
        $fileName = time() . '.' . $request->bukti->extension();
        $request->bukti->move(public_path('uploads'), $fileName);

        // Simpan bukti pembayaran ke dalam database
        $bukti = Bukti::create([
            'booking_id' => $request->booking_id,
            'foto' => 'uploads/' . $fileName,
        ]);

        // Update status pembayaran pada booking
        $booking = Booking::find($request->booking_id);
        $booking->status_pembayaran = 'Sedang dikonfirmasi';
        $booking->save();

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah');
    }

    // Kembalikan ke halaman sebelumnya dengan pesan error jika upload gagal
    return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran');
}

    
    public function DT($id)
    {
        $user = Auth::user(); // Atau ambil berdasarkan id
        $booking = booking::find($id);
        $transaksi = transaksi::where('booking_id', $booking->id)->first();

        if (!$booking || !$transaksi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        return view('mekanik.DT', compact('user', 'booking', 'transaksi'));
    }

    //     public function DT($id)
    // {
    //     $transaksi = transaksi::find($id);

    //     if (!$transaksi) {
    //         return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
    //     }

    //     $user = $transaksi->user;
    //     $booking = $transaksi->booking;

    //     return view('mekanik.DT', compact('user', 'booking', 'transaksi'));
    // }

    public function tambahDT(Request $request)
    {
        // Validasi data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'biaya_penanganan' => 'required|numeric',
        ]);
    
        // Ambil data barang berdasarkan ID
        $barang = Barang::find($request->input('barang_id'));
    
        // Jika barang tidak ditemukan
        if (!$barang) {
            return redirect()->back()->withErrors(['barang_id' => 'Barang tidak ditemukan.']);
        }
    
        // Perhitungan subtotal
        $harga_barang = $barang->harga;
        $jumlah = $request->input('jumlah');
        $biaya_penanganan = $request->input('biaya_penanganan');
        $subtotal = ($harga_barang * $jumlah) + $biaya_penanganan;
    
        // Debugging log
        Log::info('Perhitungan Subtotal:', [
            'harga_barang' => $harga_barang,
            'jumlah' => $jumlah,
            'biaya_penanganan' => $biaya_penanganan,
            'subtotal' => $subtotal
        ]);
    
        // Cek apakah stok barang mencukupi
        if ($barang->stock_barang < $request->jumlah) {
            return back()->with('error', 'Stok barang tidak mencukupi');
        }
    
        // Kurangi stok barang
        $barang->stock_barang -= $request->jumlah;
        $barang->save();
    
        // Buat detail transaksi baru
        DetailTransaksi::create([
            'user_id' => $request->input('user_id'),
            'booking_id' => $request->input('booking_id'),
            'transaksi_id' => $request->input('transaksi_id'),
            'barang_id' => $request->input('barang_id'),
            'jumlah' => $jumlah,
            'biaya_penanganan' => $biaya_penanganan,
            'subtotal' => $subtotal,
        ]);
    
        // Redirect ke halaman detail transaksi dengan pesan sukses
        return redirect()->route('homeDT')->with('success', 'Detail Transaksi berhasil ditambahkan');
    }
    
    
}
