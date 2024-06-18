<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = ['nama','nid'];
    public function jadwalPraktikum(){
        return $this->hasMany(JadwalPraktikum::class);
    }
}
