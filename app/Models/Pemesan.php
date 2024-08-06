<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesan extends Model
{
    use SoftDeletes;
    protected $table = 'pemesans';

    protected $fillable = ['nama_pemesan', 'alamat', 'no_hp', 'alamat', 'image'];

    protected $dates = ['deleted_at'];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
    public function riwayat()
    {
        return $this->hasMany(Riwayat::class);
    }
}