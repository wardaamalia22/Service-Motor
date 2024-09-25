<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'status_pembayaran',
        'status_orderan',
        'status_service',
        'merek_motor',
        'seri_motor',
        'mesin_motor',
        'no_plat',
        'jenis_service',
        'tgl_service',
        'deskripsi',
        'tgl_booking',
        'jenis_pesanan',
        // 'kode_invoice'
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi(){
        return $this->belongsTo(transaksi::class);
    }

    // public function bukti()
    // {
    //     return $this->belongsTo(bukti::class, 'booking_id');
    // }
        public function bukti()
    {
        return $this->hasOne(Bukti::class);
    }

    public function detailtransaksis()
    {
        return $this->hasMany(detailtransaksi::class);
    }
    public function barang()
    {
        return $this->hasMany(barang::class);
    }
}
