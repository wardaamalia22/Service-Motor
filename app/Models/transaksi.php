<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'booking_id', 'tgl_transaksi', 'total','pemasukan','pengeluaran' ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function detailtransaksi()
    {
        return $this->hasMany(detailtransaksi::class);
    }

    public function booking(){
        return $this->belongsTo(booking::class);
    }

    // Fungsi untuk menjumlahkan seluruh pemasukan
    public static function totalPemasukan()
    {
        return self::sum('pemasukan');
    }

    // Fungsi untuk menjumlahkan seluruh pengeluaran
    public static function totalPengeluaran()
    {
        return self::sum('pengeluaran');
    }


}