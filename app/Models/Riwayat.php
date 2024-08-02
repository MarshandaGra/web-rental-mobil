<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayats';
    protected $fillable =  ['pemesan_id', 'mobil_id', 'tanggal_mulai', 'tanggal_kembali', 'harga_total', 'denda'];

    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class);
    }
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
