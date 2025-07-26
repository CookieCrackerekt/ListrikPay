<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Penggunaan
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * 
 * Mewakili data penggunaan listrik oleh pelanggan untuk setiap bulan dan tahun tertentu.
 *
 * Atribut:
 * - id_penggunaan: Primary key
 * - id_pelanggan: Relasi ke tabel pelanggan
 * - bulan: Bulan penggunaan
 * - tahun: Tahun penggunaan
 * - meter_awal: Meteran awal bulan
 * - meter_akhir: Meteran akhir bulan
 *
 * Relasi:
 * - pelanggan(): relasi many-to-one ke tabel pelanggan
 */
class Penggunaan extends Model
{
    /**
     * Nama tabel yang digunakan oleh model
     * @var string
     */
    protected $table = 'penggunaan';

    /**
     * Primary key tabel
     * @var string
     */
    protected $primaryKey = 'id_penggunaan';

    /**
     * Nonaktifkan timestamps (created_at dan updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom-kolom yang dapat diisi secara massal
     * @var array
     */
    protected $fillable = ['id_pelanggan', 'bulan', 'tahun', 'meter_awal', 'meter_akhir'];

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
