<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $fillable = ['pemesan_id', 'mobil_id', 'bayar_id', 'tanggal_mulai', 'tanggal_kembali'];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class);
    }
    public function bayar()
    {
        return $this->belongsTo(Bayar::class);
    }
}