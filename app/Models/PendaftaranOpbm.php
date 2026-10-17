<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranOpbm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_kepala_keluarga', 'nik', 'no_hp',
        'alamat', 'zona', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
        public function pembayarans()
    {
        return $this->hasMany(PembayaranOpbm::class, 'pendaftaran_opbm_id');
    }
}