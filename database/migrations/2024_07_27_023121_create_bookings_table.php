<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('merek_motor');
            $table->string('seri_motor');
            $table->string('mesin_motor');
            $table->string('no_plat');
            $table->date('tgl_booking'); 
            $table->string('jenis_service');
            $table->enum('jenis_pesanan', ['Online', 'Offline'])->default('Online');
            $table->string('deskripsi'); 
            $table->enum('status_orderan', ['belum diterima', 'diterima'])->default('belum diterima');
            $table->enum('status_pembayaran', ['belum dibayar', 'Sedang dikonfirmasi', 'lunas', 'dibatalkan'])->default('belum dibayar');
            $table->enum('status_service', ['belum dikerjakan', 'dikerjakan', 'Selesai'])->default('belum dikerjakan');
            // $table->string('kode_invoice')->unique(); // Tambahkan ini untuk kode invoice
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
