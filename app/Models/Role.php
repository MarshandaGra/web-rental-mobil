<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nama_role'];

    public function penggunas(){
        return $this->belongsToMany(Pengguna::class,'pengguna_role','role_id','pengguna_id')->withTimestamp();
    }
}
