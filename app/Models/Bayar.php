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

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('jenis_bayar', 'like', '%' . $query . '%');
    }
}
