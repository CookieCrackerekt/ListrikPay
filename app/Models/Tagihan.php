<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Tagihan
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 *
 * Mewakili tagihan listrik yang harus dibayar oleh pelanggan berdasarkan penggunaan listrik bulanan.
 *
 * Atribut:
 * - id_tagihan: Primary Key
 * - id_penggunaan: Relasi ke tabel penggunaan
 * - id_pelanggan: Relasi ke tabel pelanggan
 * - bulan: Bulan tagihan
 * - tahun: Tahun tagihan
 * - jumlah_meter: Total meter yang digunakan
 * - status: Status pembayaran (Belum Lunas / Lunas)
 *
 * Relasi:
 * - penggunaan(): relasi ke tabel penggunaan
 * - pelanggan(): relasi ke tabel pelanggan
 */
class Tagihan extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     * @var string
     */
    protected $table = 'tagihan';

    /**
     * Primary key tabel
     * @var string
     */
    protected $primaryKey = 'id_tagihan';

    /**
     * Menonaktifkan kolom timestamps (created_at & updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom yang dapat diisi massal
     * @var array
     */
    protected $fillable = ['id_penggunaan', 'id_pelanggan', 'bulan', 'tahun', 'jumlah_meter', 'status'];

    /**
     * Relasi ke model Penggunaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan', 'id_penggunaan');
    }

    /**
     * Relasi ke model Pelanggan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
