<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;
    protected $table = 'pemesans';

    protected $fillable = [
        'nama_pemesan',
        'alamat',
        'no_hp',
        'image',
    ];
    
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_pemesan', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
    }
}
