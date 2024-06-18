<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{
    //
    public function index(){
        $dosen = Dosen::latest()->paginate(5);
        return view('dosen.index',compact('dosen'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nid' => 'required|numeric',
        ], [
            // Pesan validasi kustom
            'nama.required' => 'Nama diperlukan.',
            'nid.required' => 'NID diperlukan.',
            'nid.numeric' => 'NID harus berupa angka.',
        ]);
    
        try {
            // Buat objek Dosen dengan menggunakan mass assignment
            Dosen::create($validatedData);
    
            // Redirect dengan pesan sukses jika berhasil
            return redirect()->back()->with('success', 'Data Dosen Berhasil Ditambahkan');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan saat menyimpan data
            return redirect()->back()->with('error', 'Gagal menambahkan data Dosen. Silakan coba lagi.');
        }
    }    
    public function update(Request $request,$id){
        $dosen = Dosen::findOrFail($id);
        $dosen->nama = $request->nama;
        $dosen->nid = $request->nid;
        $dosen->save();
        return redirect()->back()->with('success', $dosen->nama . ' Berhasil Diedit');
    }
    public function destroy($id){
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->back()->with(['success' => $dosen->nama . ' Berhasil Dihapus!']);

    }
}
