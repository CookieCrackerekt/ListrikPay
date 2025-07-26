<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Model User
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * 
 * Digunakan untuk autentikasi admin aplikasi (menggunakan tabel `user`).
 *
 * Atribut:
 * - user_id: Primary Key
 * - id_level: Relasi ke tabel level
 * - username: Nama pengguna admin
 * - password: Kata sandi (hashed)
 * - nama_admin: Nama lengkap admin
 * - foto: Foto profil admin
 *
 * Relasi:
 * - level: Relasi many-to-one ke tabel `level` berdasarkan id_level
 */
class User extends Authenticatable
{
    /**
     * Nama tabel yang digunakan model ini
     * @var string
     */
    protected $table = 'user';

    /**
     * Primary key dari tabel
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Menonaktifkan timestamps (created_at dan updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom-kolom yang dapat diisi secara massal (mass-assignment)
     * @var array
     */
    protected $fillable = ['id_level', 'username', 'password', 'nama_admin', 'foto'];

    /**
     * Relasi ke tabel Level
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }
}
