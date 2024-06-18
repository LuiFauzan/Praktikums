<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranPraktikum extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function praktikum(){
        return $this->belongsTo(Praktikum::class);
    }
    public function jadwalPraktikum(){
        return $this->belongsTo(JadwalPraktikum::class);
    }
    public function checkout()
    {
        return $this->hasMany(Checkout::class);
    }
    public function daftarPraktikum()
    {
        return $this->belongsTo(DaftarPraktikum::class, 'daftar_praktikum_id');
    }
}
