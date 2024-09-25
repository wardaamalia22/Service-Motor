<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\logaktifitas;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function login(){
        return view('admin.login');
    }
    
    function homeadmin(){
        $data = User::where('role','pengguna')->get();
        return view('admin.homeadmin',compact('data'));
    }

    
}


