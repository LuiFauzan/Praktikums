<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class PraktikumController extends Controller
{
    //
    public function index(){
        $praktikum = Praktikum::latest()->paginate(5);
        return view('praktikum.index',compact('praktikum'));
    }
    public function store(Request $request){
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255',
            'semester' => 'required|numeric',
            'tahunajaran' => 'required|string|max:255',
        ]);
    
        try {
            // Buat objek Dosen dengan menggunakan mass assignment
            Praktikum::create($validatedData);

            // Redirect dengan pesan sukses jika berhasil
            return redirect()->back()->with('success', 'Data Praktikum Berhasil Ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error creating Praktikum: '.$e->getMessage());

            // Tangani jika terjadi kesalahan saat menyimpan data
            return redirect()->back()->with('error', 'Gagal menambahkan data Praktikum. Silakan coba lagi.');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'semester' => 'required|numeric',
            'tahunajaran' => 'required|string|max:255',
        ]);

        $praktikum = Praktikum::findOrFail($id);
        $praktikum->update($request->all());

        return redirect()->back()->with('success', 'Praktikum berhasil diperbarui.');
    }
    public function destroy($id){
        $praktikum = Praktikum::findOrFail($id);
        $praktikum->delete();
        return redirect()->back()->with('success','Data Praktikum Berhasil Dihapus');
    }
}
