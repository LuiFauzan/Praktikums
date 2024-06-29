<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Praktikum;
use Illuminate\Http\Request;
use App\Models\JadwalPraktikum;
use App\Http\Controllers\Controller;

class JadwalPraktikumController extends Controller
{
    //
    public function index(){
        $jadwalpraktikum = JadwalPraktikum::latest()->paginate(10);
        $praktikum = Praktikum::all();
        $dosens = Dosen::all();
        $users = User::where('role', 'Asisten Lab')->get();
        return view('jadwalpraktikum.index',compact(['jadwalpraktikum','dosens','praktikum','users']));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'praktikum_id' => 'required|exists:praktikums,id',
            'dosen_id' => 'required|exists:dosens,id',
            'user_id' => 'required|exists:users,id',
            'hari' => 'required|string',
            'kelas' => 'required|string|max:255',
            'ruangan' => 'required|string',
            'tahunajaran' => 'required|string',
            'jammulai' => 'required|date_format:H:i',
            'jamberes' => 'required|date_format:H:i|after:jammulai',
        ]);

        try {
            // Buat jadwal praktikum baru
            JadwalPraktikum::create($validatedData);

            // Redirect dengan pesan sukses jika berhasil
            return redirect()->back()->with('success', 'Jadwal Praktikum Berhasil Ditambahkan');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan saat menyimpan data
            return redirect()->back()->with('error', 'Gagal menambahkan jadwal praktikum. Silakan coba lagi.');
        }
    }
    public function update(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
      'praktikum_id' => 'required|exists:praktikums,id',
            'dosen_id' => 'required|exists:dosens,id',
            'user_id' => 'required|exists:users,id',
            'hari' => 'required|string',
            'kelas' => 'required|string|max:255',
            'ruangan' => 'required|string',
            'tahunajaran' => 'required|string',
            'jammulai' => 'required|date_format:H:i',
            'jamberes' => 'required|date_format:H:i|after:jammulai',
    ]);

    try {
        // Temukan jadwal praktikum berdasarkan ID
        $jadwalPraktikum = JadwalPraktikum::findOrFail($id);

        // Perbarui jadwal praktikum dengan data yang divalidasi
        $jadwalPraktikum->update($validatedData);

        // Redirect dengan pesan sukses jika berhasil
        return redirect()->back()->with('success', 'Jadwal Praktikum Berhasil Diperbarui');
    } catch (\Exception $e) {
        // Tangani jika terjadi kesalahan saat menyimpan data
        return redirect()->back()->with('error', 'Gagal memperbarui jadwal praktikum. Silakan coba lagi.');
    }
}

    public function destroy($id){
        $jp = JadwalPraktikum::findOrFail($id);
        $jp->delete();
        return redirect()->back()->with('success','Data Jadwal Berhasil Dihapus');
    }
}
