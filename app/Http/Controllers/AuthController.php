<?php

namespace App\Http\Controllers;

use App\Models\logaktifitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

     function showLoginForm()
{
    return view('admin.login');
}

// Proses login
public function postLogin(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => ['required'],
        'password' => ['required'],
    ]);

    // Coba login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
            $user = Auth::user();

            logaktifitas::create([
                'user_id'=> $user->id,
                'aktifitas_login'=>'Login pada'. now(),
            ]);

            if ($user->role == 'Admin') {
            return redirect()->route('homeadmin');
        } elseif ($user->role == 'Pengguna') {
            return redirect()->route('homeuser');
        } elseif ($user->role == 'Owner') {
            return redirect()->route('homeowner');
        } elseif ($user->role == 'Kasir') {
            return redirect()->route('homekasir');
        } elseif ($user->role == 'Mekanik') {
            return redirect()->route('homemekanik');
        }

        return redirect()->route('homeuser');
    }

    // Kembali ke form login dengan error
    return back()->with('notiferror', 'username atau password salah');
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
    // Tampilkan Form Register
    public function showRegisterForm()
    {
        return view('admin.register'); // Sesuaikan dengan nama file view register kamu
    }

    public function postRegister(Request $request)
    {
        // ARRAY variabel untuk digunakan ke validasi inputan user 
        $credential = [
            'name' => 'required|unique:users,name|min:2|max:10',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ];

        // variabel untuk memvalidasi semua req inputan user dari ketentuan array credential
        $validator = Validator::make($request->all(), $credential);

        //jika inputan user tidak sesuai ketentual credential, maka tidak akan redirect kemanapun dan simpan data req
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        $user = user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);
        
        Auth::login($user);
        return redirect()->route('homeuser')->with('notifikasi', 'Selamat Datang, '. $user->name);
    }

    // public function postRegister(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required|string|unique:users,name|max:255',
    //         'email' => 'required|string|unique:users,email|email|max:255',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     // Buat user baru
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         // 'role' => 'Pengguna', // Atur role default, bisa disesuaikan
    //     ]);

    //     // Login otomatis setelah register
    //     logaktifitas::create([
    //         'user_id' => $user->id,
    //         'aktifitas_login' => 'Register dan Login pada ' . now(),
    //     ]);
        
    //     Auth::login($user);
    //     // Redirect sesuai dengan role
    //     return redirect()->route('homeuser')->with('notifikasi', 'Selamat Datang, '. $user->name);
    // }


// Proses logout

}
