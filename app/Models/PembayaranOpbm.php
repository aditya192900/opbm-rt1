<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranOpbm extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran_opbm_id', 'bulan', 'tahun',
        'jumlah', 'status', 'tanggal_bayar', 'catatan',
        'rt_confirmed_by', 'rt_confirmed_at',
        'bendahara_confirmed_by', 'bendahara_confirmed_at',
        'cancelled_by', 'cancelled_role', 'cancelled_at',
        'metode_bayar', 'bukti_bayar', 'jumlah_bayar'
    ];

    protected $casts = [
        'rt_confirmed_at' => 'datetime',
        'bendahara_confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'tanggal_bayar' => 'date',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranOpbm::class, 'pendaftaran_opbm_id');
    }

    public function rtConfirmer()
    {
        return $this->belongsTo(User::class, 'rt_confirmed_by');
    }

    public function bendaharaConfirmer()
    {
        return $this->belongsTo(User::class, 'bendahara_confirmed_by');
    }

    public function canceller()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
}