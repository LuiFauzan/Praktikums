<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'npm',
        'nama',
        'kelas',
        'tahunmasuk',
        'role',
        'semester',
        'email',
        'password',
    ];
    
    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class);
    }
    public function daftarPraktikum(){
        return $this->hasMany(DaftarPraktikum::class);
    }
    // public function jadwalPraktikum(){
    //     return $this->hasMany(JadwalPraktikum::class);
    // }
    public function riwayatPraktikum(){
        return $this->hasMany(RiwayatPraktikum::class);
    }
    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
