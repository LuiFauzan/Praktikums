<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPraktikum extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function jadwalPraktikum(){
        return $this->belongsTo(Jadwalpraktikum::class,'jadwal_praktikum_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
