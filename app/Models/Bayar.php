<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;
    protected $table = 'bayars';

    protected $fillable = [
        'jenis_bayar'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
