<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riwayat extends Model
{
    use SoftDeletes;

    protected $table = 'riwayats';
    protected $fillable =  ['pemesan_id', 'mobil_id', 'tanggal_mulai', 'tanggal_kembali', 'kembali_sebenarnya', 'harga_total', 'denda', 'keterlambatan_hari'];

    protected $dates = ['deleted_at'];

    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class);
    }
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}