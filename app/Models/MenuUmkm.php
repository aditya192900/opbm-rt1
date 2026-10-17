<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUmkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_warga_id', 'nama_menu', 'deskripsi', 'harga',
        'foto', 'kategori', 'is_available'
    ];

    public function umkm()
    {
        return $this->belongsTo(UmkmWarga::class, 'umkm_warga_id');
    }
}