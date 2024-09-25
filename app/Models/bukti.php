<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukti extends Model
{
    use HasFactory;
    protected $fillable = ['booking_id', 'user_id','foto'];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function booking(){
        return $this->belongsTo(booking::class);
    }
}
