<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;
    protected $table = 'pemesans';

    protected $fillable = ['nama_pemesan', 'alamat', 'no_hp', 'alamat', 'image'];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}