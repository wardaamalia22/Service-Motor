<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\logaktifitas;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    //
    function homeowner(){
        $data = User::where('role','Owner')->get();
        return view('owner.homeowner',compact('data'));
    }

    // function kelolaowner(){
    //     $pengguna = User::where('role','owner')->get();
    //     return view('owner.kelolaowner');
    // }

    // public function kelolaowner(){
    //     $pengguna = User::where('role', 'owner')->get();
    //     $transaksi = Transaksi::all(); // Asumsi Anda punya model Transaksi
    //     $log = logaktifitas::with('user')->get(); // Mengambil data log aktivitas
        
    //     // Hitung total pemasukan dan pengeluaran
    //     $totalPemasukan = $transaksi->sum('pemasukan');
    //     $totalPengeluaran = $transaksi->sum('pengeluaran');
        
    //     return view('owner.kelolaowner', compact('pengguna', 'transaksi', 'totalPemasukan', 'totalPengeluaran', 'log'));
    // }
    public function kelolaOwner()
    {
        $transaksi = Transaksi::with('booking.user')->get();
        $totalPemasukan = Transaksi::sum('pemasukan');
        $log = Transaksi::sum('pengeluaran');
    
        $servisPerBulan = booking::select(DB::raw('MONTH(tgl_booking) as bulan'), DB::raw('COUNT(*) as jumlahServis'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    
        $labels = $servisPerBulan->pluck('bulan')->map(function ($bulan) {
            return date('F', mktime(0, 0, 0, $bulan, 10));
        })->toArray();
    
        $jumlahServis = $servisPerBulan->pluck('jumlahServis')->toArray();
    
        return view('owner.kelolaOwner', [
            'transaksi' => $transaksi,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $log,
            'labels' => $labels,
            'jumlahServis' => $jumlahServis
        ]);
    }

    public function laporanlog()
    {
        // Mengambil data transaksi dari database
        $transaksi = Transaksi::with('booking.user')->get();
    
        // Cek data transaksi
        // dd($transaksi);
    
        // Menghitung total pemasukan dan pengeluaran
        $totalPemasukan = Transaksi::sum('pemasukan');
        $totalPengeluaran = Transaksi::sum('pengeluaran');
    
        // Cek total pemasukan dan pengeluaran
        // dd($totalPemasukan, $totalPengeluaran);
    
        // Mengambil data log aktivitas
        $log = logaktifitas::with('user')->get();
    
        // Mengambil data jumlah servis per bulan
        $servisPerBulan = booking::select(DB::raw('MONTH(tgl_booking) as bulan'), DB::raw('COUNT(*) as jumlahServis'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    
        // Mengonversi data bulan ke format nama bulan dan jumlah servis
        $labels = $servisPerBulan->pluck('bulan')->map(function ($bulan) {
            return date('F', mktime(0, 0, 0, $bulan, 10)); // Mengubah bulan ke nama bulan (misal, Januari, Februari)
        })->toArray();
    
        $jumlahServis = $servisPerBulan->pluck('jumlahServis')->toArray();
    
        // Mengirim data ke view
        return view('owner.laporanlog', [
            'transaksi' => $transaksi,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'log' => $log,
            'labels' => $labels,
            'jumlahServis' => $jumlahServis
        ]);
    }
    


    // public function laporanlog()
    // {
    //     // Mengambil data transaksi dari database
    //     $transaksi = Transaksi::with('User', 'Booking')->get();
    //     $log = logaktifitas::with('user')->get(); // Mengambil data log aktivitas

    //     // Menghitung total pemasukan dan pengeluaran
    //     $totalPemasukan = $transaksi->sum('pemasukan');
    //     $totalPengeluaran = $transaksi->sum('pengeluaran');

    //     // Mengirim data ke view
    //     return view('owner.laporanlog', compact('transaksi', 'totalPemasukan', 'totalPengeluaran', 'log'));
    // }
    
}
