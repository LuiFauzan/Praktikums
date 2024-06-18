<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pembayaranPraktikum()
    {
        return $this->belongsTo(PembayaranPraktikum::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jadwalPraktikum()
    {
        return $this->belongsTo(JadwalPraktikum::class, 'jadwal_praktikum_id');
    }
}
