<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;
    protected $table = 'merks';
    protected $fillable = ['nama_merk'];

    public function mobil()
    {
        return $this->hasMany(Mobil::class);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_merk', 'like', '%' . $query . '%');
    }
}
