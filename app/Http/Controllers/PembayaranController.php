<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DaftarPraktikum;
use App\Models\PembayaranPraktikum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PembayaranNotification;
use App\Notifications\AdaPembayaranNotification;

class PembayaranController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user('praktikum_id');
        $pembayaran = PembayaranPraktikum::with('daftarPraktikum.jadwalPraktikum.praktikum')->paginate(10);
    
        // Ambil daftar praktikum yang unik berdasarkan `jadwal_praktikum_id`
        $daftarPraktikum = DaftarPraktikum::with('jadwalPraktikum.praktikum')
            // ->where('jadwal_praktikum')
            ->get()
            ->unique('jadwal_praktikum_id');
            // dd($daftarPraktikum);
        return view('pembayaran.index', compact('pembayaran', 'daftarPraktikum'));
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_praktikum_id' => 'required|exists:jadwal_praktikums,id',
            'namarek' => 'required|string|max:255',
            'norek' => 'required',
            'harga' => 'required|numeric',
        ]);
    
        $pembayaran = PembayaranPraktikum::create($request->all());
    
        // Mengambil mahasiswa yang terkait dengan jadwal praktikum
        $mahasiswa = User::where('role', 'Mahasiswa')
                         ->whereHas('daftarPraktikum', function ($query) use ($request) {
                             $query->where('jadwal_praktikum_id', $request->jadwal_praktikum_id);
                         })
                         ->get();
    
        // Mengirim notifikasi kepada setiap mahasiswa yang terkait
        foreach ($mahasiswa as $mhs) {
            Notification::send($mhs, new AdaPembayaranNotification($pembayaran));
        }
    
        return redirect()->back()->with('success', 'Data Pembayaran Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        $pembayaran = PembayaranPraktikum::findOrFail($id);
        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data Pembayaran Berhasil Dihapus');
    }
}
