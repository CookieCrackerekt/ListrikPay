<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->unsignedBigInteger('id_penggunaan');
            $table->foreign('id_penggunaan')->references('id_penggunaan')->on('penggunaan')->onDelete('cascade');
            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->string('bulan', 10);
            $table->year('tahun');
            $table->integer('jumlah_meter');
            $table->enum('status', ['belum bayar', 'lunas'])->default('belum bayar');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
