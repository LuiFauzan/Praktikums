<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Praktikum;
use Illuminate\Http\Request;
use App\Models\JadwalPraktikum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalAslabController extends Controller
{
    //
    public function index(){
         // Query untuk mendapatkan jadwal praktikum yang terkait dengan user yang memiliki role 'Asisten Lab'
    $jadwalpraktikum = JadwalPraktikum::whereHas('user', function ($query) {
        $query->where('role', 'Asisten Lab')
              ->where('id', Auth::id()); // Sesuaikan dengan user yang sedang login
    })->latest()->paginate(10);
    $dosens = Dosen::all();
    return view('jadwalaslab.index', compact('jadwalpraktikum','dosens'));
    }
}
