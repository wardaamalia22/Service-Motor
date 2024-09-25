<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\booking;
use App\Models\detailtransaksi;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KasirController extends Controller
{

    // function homekasir(){
    //     $data = User::where('role','Kasir')->get();
    //     return view('kasir.homekasir',compact('data'));
    // }
    function homekasir() {
        $data = User::where('role', 'Kasir')->get();
        $user = Auth::user(); // Contoh: mendapatkan pengguna yang sedang login
        return view('kasir.homekasir', compact('data', 'user'));
    }

    function kelolakasir(){
        $kasir = User::where('role','Kasir')->get();
        return view('kasir.kelolakasir',compact('kasir'));
    }  

    //crud tambah
    function tambahkasir(){
        return view('kasir.tambahkasir');   
    }
    function postTambahKasir(Request $request){
        $data = $request->validate([
            'name' =>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
        ]);

        // dd($data);
        $user = User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request),
            'role'=>$request->role,
            'no_hp'=>$request->no_hp,
            'alamat'=>$request->alamat,
        ]);
        Auth::login($user);
        return redirect()->route('kelolakasir')->with('notifikasi','Data Berhasil Ditambahkan');
    }

    //crud edit 
    function editkasir(User $kasir){
        return view('kasir.editkasir',compact('kasir'));
    }
    function postEditKasir(User $kasir, Request $request){
        $data = $request->validate([
            'name' =>'required',
            'email'=>'required',
            // 'password'=>'required',
            'role'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
        ]);

        $kasir->update($data);
        return redirect()->route('kelolakasir')->with('notifikasi','Data Berhasil Diedit');
    }

     //crud hapus
     function hapusKasir(User $kasir){
        $kasir->delete();
        return redirect()->route('kelolakasir')->with('notifikasi','Data Berhasil Dihapus');
    }

    public function bukti($id)
    {
        $booking = booking::with('bukti')->findOrFail($id);
        $detail = detailtransaksi::with('barang')->where('booking_id', $id)->get();
        $totalHarga = $detail->sum('subtotal');
    
        return view('kasir.bukti', compact('booking', 'detail', 'totalHarga'));
    }

    // public function pesananuser($id)
    // {
    //     $user = User::findOrFail($id);
    //     $barang = barang::all();
    //     $booking = booking::with(['User', 'bukti'])->where('user_id', $id)->get();
        
    //     return view('Kasir.pesananuser', compact('user', 'booking'));
    // }
        public function pesananuser()
    {
        // Ambil data booking beserta relasi User dan bukti
        $booking = Booking::with(['User', 'bukti'])->get();
        
        // Ambil data barang jika diperlukan (contoh tambahan)
        $barang = Barang::all();
        
        // Menyediakan view dengan data booking
        return view('Kasir.pesananuser', compact('booking', 'barang'));
    }

    public function pesananoffline()
    {
        // Mengambil semua booking untuk pengguna yang sedang login
        $booking = booking::where('user_id', Auth::id())->get();
        
        // Mengirimkan data booking ke view
        return view('kasir.pesananoffline', compact('booking'));
    }
    // public function tambahPesanan(Request $request)
    // {
    //     // Validate the incoming data
    //     $request->validate([
    //         // 'user_id' => 'required|string|max:255',
    //         // 'name' => 'required|string|max:255',
    //         'merek_motor' => 'required|string|max:255',
    //         'seri_motor' => 'required|string|max:255',
    //         'mesin_motor' => 'required|string|max:255',
    //         'no_plat' => 'required|string|max:255',
    //         'tgl_booking' => 'required|date',
    //         'jenis_service' => 'required|string|max:255',
    //         'deskripsi' => 'nullable|string',
    //         // Validasi lainnya jika diperlukan
    //     ]);

    //     // Tambahkan user_id dari auth
    //     $data = $request->all();
    //     $data['user_id'] = auth()->id(); // Menambahkan user_id ke data

    //     // Create a new booking
    //     Booking::create($data);

    //     // Redirect back with a success message
    //     return redirect()->route('pesananoffline')->with('success', 'Pesanan berhasil ditambahkan');
    // }

    
    public function confirm($id)
    {
        $booking = booking::with('User')->get();
        $booking = booking::find($id);
        // $o = booking::where('user_id', $id)->first();
        return view('Kasir.confirm', compact('booking','booking'));
    }
    
    public function editconfirm(booking $booking, Request $request)
    {
        $data = $request->validate([
            'status_pembayaran' => 'required|string'
        ]);
        $booking->update($data);
        dump($data);
        return redirect()->route('homekasir', ['id' => $booking->user_id])->with('notifikasi', 'berhasil dikonifrmasi');
    }
    
    
}
