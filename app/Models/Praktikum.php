<?php

namespace App\Models;

use App\Models\JadwalPraktikum;
use App\Models\PembayaranPraktikum;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;


class Praktikum extends Model
{
    use HasFactory,sluggable;
    protected $fillable = ['nama', 'semester','tahunajaran'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function jadwalPraktikum(){
        return $this->hasMany(JadwalPraktikum::class);
    }
    public function pembayaranPraktikum(){
        return $this->hasMany(PembayaranPraktikum::class);
    }
}
