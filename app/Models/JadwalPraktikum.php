<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktikum extends Model
{
    protected $guarded = ['id'];
    public function daftarPraktikum(){
        return $this->hasMany(DaftarPraktikum::class);
    }
    public function praktikum(){
        return $this->belongsTo(Praktikum::class);
    }
    public function dosen(){
        return $this->belongsTo(Dosen::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function riwayatPraktikum(){
        return $this->hasMany(RiwayatPraktikum::class);
    }
    public function pembayaranPraktikum(){
        return $this->hasMany(PembayaranPraktikum::class);
    }
}
