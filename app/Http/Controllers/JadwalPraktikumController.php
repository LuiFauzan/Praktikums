<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JadwalPraktikum;
use App\Models\Praktikum;
use Illuminate\Http\Request;

class JadwalPraktikumController extends Controller
{
    //
    public function index(){
        $jadwalpraktikum = JadwalPraktikum::latest()->paginate(10);
        // $praktikum = Praktikum::all();
        $dosens = Dosen::all();
        $user = auth()->user(); // Ambil pengguna yang sedang login

        // Ambil praktikum yang dimiliki oleh asisten lab tertentu
        if ($user->role === 'Asisten Lab') {
            // Ambil praktikum yang terkait dengan user
            $praktikum = Praktikum::where('id', $user->praktikum_id)->get();
        } else {
            $praktikum = []; // Atau kosongkan jika tidak ditemukan
        }
        return view('jadwalpraktikum.index',compact(['jadwalpraktikum','dosens','praktikum']));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'praktikum_id' => 'required|exists:praktikums,id',
            'dosen_id' => 'required|exists:dosens,id',
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
    public function update(Request $request,$id){
        
    }
    public function destroy($id){
        $jp = JadwalPraktikum::findOrFail($id);
        $jp->delete();
        return redirect()->back()->with('success','Data Jadwal Berhasil Dihapus');
    }
}
