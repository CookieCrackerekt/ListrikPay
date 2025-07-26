<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Level
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * 
 * Menyimpan informasi hak akses atau peran (role) pengguna dalam sistem.
 * Contoh level: Admin, Petugas, Super Admin, dll.
 *
 * Atribut:
 * - id_level: Primary key
 * - nama_level: Nama atau label dari level pengguna
 */
class Level extends Model
{
    /**
     * Nama tabel yang digunakan
     * @var string
     */
    protected $table = 'level';

    /**
     * Primary key dari tabel
     * @var string
     */
    protected $primaryKey = 'id_level';

    /**
     * Menonaktifkan timestamps (created_at dan updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom yang dapat diisi secara massal
     * @var array
     */
    protected $fillable = ['nama_level'];
}
