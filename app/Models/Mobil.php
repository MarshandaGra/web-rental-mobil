<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $table = 'mobils';
    protected $fillable = ['nama_m', 'merk_id', 'kursi', 'nomor_polisi', 'tahun', 'harga_per_hari', 'gambar'];

    public function scopeSearch($query, $search)
    {
        return $query->where('nama_m', 'like', '%' . $search . '%')
                    ->orWhere('kursi', 'like', '%' . $search . '%')
                    ->orWhere('nomor_polisi', 'like', '%' . $search . '%')
                    ->orWhere('tahun', 'like', '%' . $search . '%')
                    ->orWhere('harga_per_hari', 'like', '%' . $search . '%');
    }
    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
