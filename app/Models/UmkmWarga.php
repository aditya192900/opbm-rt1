<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmWarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_usaha', 'pemilik', 'kategori',
        'deskripsi', 'no_wa', 'foto_produk', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(MenuUmkm::class, 'umkm_warga_id');
    }
}