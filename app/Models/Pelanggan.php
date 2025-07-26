<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Model Pelanggan
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * 
 * Digunakan untuk autentikasi dan manajemen data pelanggan listrik.
 *
 * Atribut:
 * - id_pelanggan: Primary key
 * - username: Username login pelanggan
 * - password: Password login pelanggan (hashed)
 * - nomor_kwh: Nomor KWH meter pelanggan
 * - nama_pelanggan: Nama lengkap pelanggan
 * - alamat: Alamat tempat tinggal pelanggan
 * - id_tarif: Relasi ke tabel tarif berdasarkan daya listrik
 *
 * Relasi:
 * - tarif(): relasi ke model Tarif
 */
class Pelanggan extends Authenticatable
{
    /**
     * Nama tabel di database
     * @var string
     */
    protected $table = 'pelanggan';

    /**
     * Primary key tabel
     * @var string
     */
    protected $primaryKey = 'id_pelanggan';

    /**
     * Tidak menggunakan kolom timestamps (created_at dan updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom yang dapat diisi secara massal (mass-assignment)
     * @var array
     */
    protected $fillable = ['username', 'password', 'nomor_kwh', 'nama_pelanggan', 'alamat', 'id_tarif'];

    /**
     * Relasi ke model Tarif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }
}
