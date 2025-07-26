<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Tarif
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 *
 * Mewakili data tarif listrik berdasarkan daya dan biaya per kWh.
 *
 * Atribut:
 * - id_tarif: Primary key
 * - daya: Besar daya listrik (misal: 1300 VA, 2200 VA)
 * - tarifperkwh: Biaya per kWh (dalam satuan rupiah)
 *
 * Digunakan untuk menghitung total tagihan pelanggan berdasarkan konsumsi listrik.
 */
class Tarif extends Model
{
    /**
     * Nama tabel di database
     * @var string
     */
    protected $table = 'tarif';

    /**
     * Primary key dari tabel
     * @var string
     */
    protected $primaryKey = 'id_tarif';

    /**
     * Nonaktifkan kolom timestamps (created_at dan updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom yang dapat diisi secara massal (mass-assignment)
     * @var array
     */
    protected $fillable = ['daya', 'tarifperkwh'];
}
