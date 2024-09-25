<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = ['nama_barang', 'harga', 'stock_barang'];
    // Model Barang
    protected $fillable = [
        'user_id',
        'booking_id',
        'nama_barang',
        'stock_barang',
        'harga',
    ];


    public function User(){
        return $this->belongsTo(User::class);
    }

    public function booking(){
        return $this->belongsTo(booking::class);
    }

    public function detailtransaksi() 
    {
        return $this->belongsTo(detailtransaksi::class);    
    }

    public function kurangiStok($jumlah)
    {
        $this->stock -= $jumlah;
        $this->save();
    }
}
