<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\booking;
use App\Models\detailtransaksi;
use App\Models\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //
    function booking()
    {
        $user = Auth::user();
        return view('booking.booking', compact('user'));
    }

    function kelolabooking(){
        $booking = booking::all();
        return view('booking.kelolabooking', compact('booking'));
    }   

    function keloladetailbooking()
    {
        $user = Auth::user();
        $detail = detailtransaksi::with(['user', 'booking', 'barang', 'transaksi'])->get();

        return view('Booking.keloladetailbooking', compact('detail', 'user'));
    }
    //     function kelolabooking(){
    //     $user = Auth::user();
    //     $booking = Booking::where('user_id', $user->id)->get();
    //     return view('booking.kelolabooking', compact('booking'));
    // } 
    
    // function postBooking(Request $request)
    // {
    //     $data = $request->validate([
    //         'merek_motor' => 'required',
    //         'seri_motor' => 'required',
    //         'mesin_motor' => 'required',
    //         'no_plat' => 'required',
    //         'tgl_booking' => 'required|date',
    //         'jenis_service' => 'required',
    //         'deskripsi' => 'required',
            // 'status_service' => 'required',
            // 'status_pembayaran' => 'required',
            // 'status_orderan' => 'required',
        // ]);
        // $booking = new booking();
        // $booking->user_id = Auth::user()->id;
        // $booking->merek_motor = $request->merek_motor;
        // $booking->seri_motor = $request->seri_motor;
        // $booking->mesin_motor = $request->mesin_motor;
        // $booking->no_plat = $request->no_plat;
        // $booking->tgl_booking = $request->tgl_booking;
        // $booking->jenis_service = $request->jenis_service;
        // $booking->deskripsi = $request->deskripsi;
        // $booking->status_service = $request->status_service;
        // $booking->status_pembayaran = $request->status_pembayaran;
        // $booking->status_orderan = $request->status_orderan;
    //     $booking->save();
    //     $transaksi = new transaksi();
    //     $transaksi->user_id = Auth::id();
    //     $transaksi->pesan_id = $booking->id;
    //     $transaksi->tgl_transaksi = Carbon::now();
    //     $transaksi->save();
    //     return redirect()->route('profil')->with('notifikasi','Data Berhasil Ditambahkan');
    // }

    function postBooking(Request $request)
    {
        $data = $request->validate([
            'merek_motor' => 'required',
            'seri_motor' => 'required',
            'mesin_motor' => 'required',
            'no_plat' => 'required',
            'tgl_booking' => 'required',
            'jenis_service' => 'required',
            'deskripsi' => 'required',
            // 'status_service' => 'required',
            // 'status_pembayaran' => 'required'
        ]);

        // dd($data);

        $booking = booking::create([
            'user_id' => Auth::id(),
            'merek_motor' => $request->merek_motor,
            'seri_motor' => $request->seri_motor,
            'mesin_motor' => $request->mesin_motor,
            'no_plat' => $request->no_plat,
            'tgl_booking' => $request->tgl_booking,
            'jenis_service' => $request->jenis_service,
            'deskripsi' => $request->deskripsi,
            // 'status' => $request->status
        ]);
        $booking->save();

        $transaksi = new transaksi();
        $transaksi->user_id = Auth::id();
        $transaksi->booking_id = $booking->id;
        $transaksi->tgl_transaksi = Carbon::now();
        $transaksi->save();

        return redirect()->route('profil')->with('notifikasi', 'Berhasil Memesan');
    }

//     public function store(Request $request)
// {
//     $booking = new Booking;
//     // Isi data booking dari request
//     $booking->kode_invoice = 'INV-' . strtoupper(uniqid()); // Generate kode invoice
//     $booking->save();

//     return redirect()->route('bookings.show', $booking);
// }


    // $user = Auth::user();
    //     $booking = Booking::create([
    //         'merek_motor' =>$request->merk_motor,
    //         'seri_motor'=>$request->seri_motor,
    //         'mesin_motor'=>$request->mesin_motor,
    //         'no_plat'=>$request->no_plat,
    //         'tgl_booking'=>$request->tgl_booking,
    //         'jenis_service'=>$request->jenis_service,
    //         'deskripsi'=>$request->deskripsi,
    //         'status'=>$request->status,
    //         'status_service' => $request->status_service,
    //         'status_pembayaran' => $request->status_pembayaran,
    //         'status_orderan' => $request->status_orderan,
    //         'user_id' => Auth::id(),
    //         ]);

//     return redirect()->route('profil')->with('success', 'Pesanan berhasil dibuat, lihat detail pesanan anda di profil untuk pembayaran.');
// }


}
