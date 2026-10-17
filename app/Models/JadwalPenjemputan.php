<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPenjemputan extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari', 'jam_mulai', 'jam_selesai', 'zona', 'keterangan'
    ];
}