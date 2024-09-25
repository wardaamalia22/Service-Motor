<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function homeuser(){
        $artikel = artikel::all();
        return view('homepengguna.homeuser', compact('artikel'));
    }
     function tentangkami(){
        return view('homepengguna.tentangkami');
     }

     function detailartikel($id)
    {
        $artikel = artikel::findOrFail($id);
        return view('homepengguna.detailartikel', compact('artikel'));
    }

     function home()
    {
        return view('homepengguna.homeuser');
    }

     function homeadmin()
    {
        return view('admin.homeadmin');
    }

    // function profil()
    // {
    //     $booking = booking::all();
    //     return view('homepengguna.profil', compact('booking'));
    // }

        public function profil()
    {
        // Mengambil semua booking untuk pengguna yang sedang login
        $booking = booking::where('user_id', Auth::id())->get();
        
        // Mengirimkan data booking ke view
        return view('homepengguna.profil', compact('booking'));
    }

    
    function kelolapengguna(){
        $pengguna = User::where('role','pengguna')->get();
        return view('homepengguna.kelolapengguna',compact('pengguna'));
    }

    // crudTambah
    function tambahuser(){
        return view('homepengguna.tambahuser');   
    }
    function postTambahUser(Request $request){
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
        return redirect()->route('kelolapengguna')->with('notifikasi','Data Berhasil Ditambahkan');
    }

    // crud edit
    function edituser(User $pengguna){
        return view('homepengguna.edituser',compact('pengguna'));
    }
    function postEditUser(User $pengguna, Request $request){
        $data = $request->validate([
            'name' =>'required',
            'email'=>'required',
            // 'password'=>'required',
            'role'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
        ]);

        $pengguna->update($data);
        return redirect()->route('kelolapengguna')->with('notifikasi','Data Berhasil Diedit');
    }

    //crud hapus
    function hapusUser(User $pengguna){
        $pengguna->delete();
        return redirect()->route('kelolapengguna')->with('notifikasi','Data Berhasil Dihapus');
    }
    
}
