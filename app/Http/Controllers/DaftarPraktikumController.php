<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DaftarPraktikum;
use App\Models\JadwalPraktikum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DaftarPraktikumController extends Controller
{
    //
    public function index(Request $request)
{
    $praktikumIdAsistenLab = Auth::user()->praktikum_id;

    // Query untuk mendapatkan daftar kelas, semester, dan tahun masuk yang unik
    $kelasList = User::select('kelas')->distinct()->pluck('kelas');
    $semesterList = User::select('semester')->distinct()->pluck('semester');
    $tahunMasukList = User::select('tahunmasuk')->distinct()->pluck('tahunmasuk');

    $dp = DaftarPraktikum::whereHas('jadwalpraktikum.praktikum', function ($query) use ($praktikumIdAsistenLab) {
        $query->where('id', $praktikumIdAsistenLab);
    })->latest()->paginate(10);

    $query = User::where('role', 'Mahasiswa');

    if ($request->filled('kelas')) {
        $query->where('kelas', $request->kelas);
    }

    if ($request->filled('semester')) {
        $query->where('semester', $request->semester);
    }

    if ($request->filled('tahunmasuk')) {
        $query->where('tahunmasuk', $request->tahunmasuk);
    }

    $users = $query->get();
    $jadwalPraktikums = JadwalPraktikum::whereHas('praktikum', function ($query) use ($praktikumIdAsistenLab) {
        $query->where('id', $praktikumIdAsistenLab);
    })->get();

    return view('daftarpraktikum.index', compact('dp', 'users', 'jadwalPraktikums', 'kelasList', 'semesterList', 'tahunMasukList'));
}

    public function store(Request $request)
    {
        // Ambil nilai user_id dan jadwal_praktikum_id sebagai array
        $userIds = $request->input('user_id');
        $jadwalPraktikumIds = $request->input('jadwal_praktikum_id');
    
        // Looping untuk setiap user_id dan jadwal_praktikum_id
        foreach ($userIds as $userId) {
            foreach ($jadwalPraktikumIds as $jadwalPraktikumId) {
                // Cek apakah sudah terdaftar atau belum
                $daftarPraktikum = DaftarPraktikum::where('user_id', $userId)
                                                  ->where('jadwal_praktikum_id', $jadwalPraktikumId)
                                                  ->first();
    
                if ($daftarPraktikum) {
                    return redirect()->back()->with('error', 'User sudah terdaftar pada jadwal praktikum ini.');
                }
    
                // Simpan ke database
                DaftarPraktikum::create([
                    'user_id' => $userId,
                    'jadwal_praktikum_id' => $jadwalPraktikumId,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'User berhasil ditambahkan ke jadwal praktikum.');
    }
    public function batchDelete(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);

        foreach ($selectedItems as $itemId) {
            $daftarPraktikum = DaftarPraktikum::findOrFail($itemId);

            if ($daftarPraktikum) {
                $daftarPraktikum->delete();
            }
        }

        return redirect()->back()->with('success', 'Daftar praktikum yang dipilih berhasil dihapus.');
    }

    public function destroy($id){
        $dp = DaftarPraktikum::findOrFail($id);
        $dp->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus dari praktikum ini!.');
    }
}
