<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pengguna'];

    public function roles(){
        return $this->belongsToMany(Role::class,'pengguna_role','pengguna_id','role_id')->withTimestamp();
    }
}
