<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\booking;
use App\Models\detailtransaksi;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MekanikController extends Controller
{
    //
    // function kelolamekanik(Request $request){
    //     if($request->has('search')){
    //         $mekanik = User::where('name','LIKE','%' . $request->search . '%')->where('role','Mekanik')->get();
    //     }else{
    //         $mekanik = User::where('role','Mekanik')->get();
    // return view('mekanik.kelolamekanik',compact('mekanik'));
    // }
    // }
    function kelolamekanik()
    {
        $mekanik = User::where('role', 'Mekanik')->get();
        return view('mekanik.kelolamekanik', compact('mekanik'));
    }

    //crud tambah
    function tambahmekanik()
    {
        return view('mekanik.tambahmekanik');
    }
    function postTambahMekanik(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        // dd($data);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request),
            'role' => $request->role,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);
        Auth::login($user);
        return redirect()->route('kelolamekanik')->with('notifikasi', 'Data Berhasil Ditambahkan');
    }

    //crud edit 
    function editmekanik(User $mekanik)
    {
        return view('mekanik.editmekanik', compact('mekanik'));
    }
    function postEditMekanik(User $mekanik, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'password'=>'required',
            'role' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $mekanik->update($data);
        return redirect()->route('kelolamekanik')->with('notifikasi', 'Data Berhasil Diedit');
    }

    //crud hapus
    function hapusMekanik(User $mekanik)
    {
        $mekanik->delete();
        return redirect()->route('kelolamekanik')->with('notifikasi', 'Data Berhasil Dihapus');
    }

    //home mekanik
    function homemekanik()
    {
        $data = User::where('role', 'Mekanik')->get();
        return view('mekanik.homemekanik', compact('data'));
    }
    function pesanan()
    {
        $booking = booking::all();
        $barang = barang::all();
        return view('mekanik.pesanan', compact('booking'));
    }

    // public function profil()
    // {
    //     $user = Auth::user();
    //     return view("homepengguna.profil", compact("detailtransaksi", "user", "booking", "transaksi"));
    // }   
    function barang()
    {
        $user = Auth::user();
        $barang = barang::all();

        return view('Mekanik.barang', compact('barang', 'user'));
    }

        public function tambahBarang(Request $request)
        {
            // Validation
            $request->validate([
                'booking_id' => 'required',
                'nama_barang' => 'required|string',
                'stock_barang' => 'required|numeric',
                'harga' => 'required|numeric',
            ]);

            $user_id = Auth::id();

            if (!$user_id) {
                return redirect()->route('barang')->with('error', 'User not authenticated');
            }

            barang::create([
                'booking_id' => $request->booking_id,
                'nama_barang' => $request->nama_barang,
                'stock_barang' => $request->stock_barang,
                'harga' => $request->harga,
            ]);

            return redirect()->route('barang')->with('notifikasi', 'Barang berhasil ditambahkan');
        }



    public function order($id)
    {
        $booking = Booking::with('User')->get();
        $booking = Booking::find($id);
        $o = Booking::where('user_id', $id)->first();
        return view('mekanik.order', compact('booking'));
    }
    public function editOrder(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status_orderan = $request->input('status_orderan');
        $booking->status_service = $request->input('status_service');
        $booking->save();

        return redirect()->route('homemekanik');
    }
    public function uangpepe()
    {
        // Mengambil semua transaksi dari database
        $transaksi = Transaksi::with('user', 'booking')->get();

        // Menghitung total pemasukan dan pengeluaran
        $totalPemasukan = transaksi::sum('pemasukan');
        $totalPengeluaran = transaksi::sum('pengeluaran');

        return view('mekanik.uangpepe', compact('transaksi', 'totalPemasukan', 'totalPengeluaran'));
        // Mengirim data ke view
        // return view('Mekanik.uangpepe', [
        //     'transaksi' => $transaksi,
        //     'totalPemasukan' => $totalPemasukan,
        //     'totalPengeluaran' => $totalPengeluaran
        // ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'tgl_transaksi' => 'required|date',
        'pemasukan' => 'nullable|numeric',
        'barang_id' => 'nullable|exists:barangs,id',
        'jumlah' => 'nullable|integer',
        'biaya_penanganan' => 'nullable|numeric',
        'booking_id' => 'nullable|exists:bookings,id',
    ]);

    $subtotal = 0;
    $totalPengeluaran = 0;

    if ($validated['barang_id'] && $validated['jumlah']) {
        $barang = Barang::find($validated['barang_id']);
        if ($barang) {
            $subtotal = $barang->harga * $validated['jumlah'];
            $totalPengeluaran = $subtotal;
        }
    }

    $totalPemasukan = $subtotal + ($validated['biaya_penanganan'] ?? 0);

    $transaksi = Transaksi::where('user_id', $validated['user_id'])
        ->whereDate('tgl_transaksi', $validated['tgl_transaksi'])
        ->first();

    if ($transaksi) {
        $transaksi->update([
            'pemasukan' => $totalPemasukan,
            'pengeluaran' => $totalPengeluaran,
            'booking_id' => $validated['booking_id'],
            'keterangan' => 'Updated income and expense',
        ]);

        if ($validated['barang_id']) {
            DetailTransaksi::updateOrCreate(
                ['transaksi_id' => $transaksi->id, 'barang_id' => $validated['barang_id']],
                [
                    'jumlah' => $validated['jumlah'],
                    'biaya_penanganan' => $validated['biaya_penanganan'] ?? 0,
                    'subtotal' => $subtotal + ($validated['biaya_penanganan'] ?? 0),
                ]
            );

            $barang->decrement('stock_barang', $validated['jumlah']);
        }
    } else {
        $transaksi = Transaksi::create([
            'user_id' => $validated['user_id'],
            'tgl_transaksi' => $validated['tgl_transaksi'],
            'pemasukan' => $totalPemasukan,
            'pengeluaran' => $totalPengeluaran,
            'booking_id' => $validated['booking_id'],
            'keterangan' => 'Initial income and expense',
        ]);

        if ($validated['barang_id']) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $validated['barang_id'],
                'jumlah' => $validated['jumlah'],
                'biaya_penanganan' => $validated['biaya_penanganan'] ?? 0,
                'subtotal' => $subtotal + ($validated['biaya_penanganan'] ?? 0),
            ]);
        }
    }

    return redirect()->route('uangpepe')->with('success', 'Income and expense updated successfully');
}


}
