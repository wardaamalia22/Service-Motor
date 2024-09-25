<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailtransaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['transaksi_id', 'barang_id', 'booking_id', 'user_id','jumlah', 'subtotal', 'biaya_penanganan'];
    public function User(){
        return $this->belongsTo(User::class);
    }
    
    public function transaksi(){
        return $this->belongsTo(transaksi::class);
    }
    public function booking(){
        return $this->belongsTo(booking::class);
    }

    public function barang(){
        return $this->belongsTo(barang::class, 'barang_id' );
    }

}
