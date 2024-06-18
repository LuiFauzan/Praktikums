<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MahasiswaController extends Controller
{
    //
    public function index(){
        $mahasiswa = User::where('role','Mahasiswa')->latest()->paginate(15);
        return view('mahasiswa.index',compact('mahasiswa'));
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'npm' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'tahunmasuk' => 'required|string|max:255',
            'semester' => 'required|numeric',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed',
        ]);
        
        // Buat user baru dengan role 'Mahasiswa'
        $user = User::create([
            'npm' => $validatedData['npm'],
            'nama' => $validatedData['nama'],
            'kelas' => $validatedData['kelas'],
            'tahunmasuk' => $validatedData['tahunmasuk'],
            'semester' => $validatedData['semester'],
            'role' => $validatedData['role'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['npm']),
        ]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}
