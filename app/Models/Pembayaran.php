<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Pembayaran
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * 
 * Mewakili data transaksi pembayaran yang dilakukan pelanggan terhadap tagihan listrik.
 *
 * Atribut:
 * - id_pembayaran: Primary key
 * - id_tagihan: Relasi ke tagihan yang dibayar
 * - id_pelanggan: Relasi ke pelanggan yang membayar
 * - user_id: Relasi ke admin yang menerima pembayaran
 * - tanggal_pembayaran: Tanggal saat pembayaran dilakukan
 * - bulan_bayar: Bulan yang dibayar
 * - biaya_admin: Biaya tambahan administrasi
 * - total_bayar: Total keseluruhan pembayaran
 *
 * Relasi:
 * - tagihan(): Tagihan yang dibayar
 * - pelanggan(): Pelanggan yang melakukan pembayaran
 * - user(): Admin yang mencatat pembayaran
 */
class Pembayaran extends Model
{
    /**
     * Nama tabel dalam database
     * @var string
     */
    protected $table = 'pembayaran';

    /**
     * Primary key dari tabel pembayaran
     * @var string
     */
    protected $primaryKey = 'id_pembayaran';

    /**
     * Tidak menggunakan timestamps (created_at dan updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom-kolom yang dapat diisi secara massal
     * @var array
     */
    protected $fillable = [
        'id_tagihan',
        'id_pelanggan',
        'user_id',
        'tanggal_pembayaran',
        'bulan_bayar',
        'biaya_admin',
        'total_bayar',
    ];

    /**
     * Relasi ke model Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
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

    /**
     * Relasi ke model User (Admin)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
