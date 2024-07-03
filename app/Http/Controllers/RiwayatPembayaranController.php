<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\DaftarPraktikum;
use App\Http\Controllers\Controller;
use App\Models\JadwalPraktikum;
use Illuminate\Support\Facades\Auth;

class RiwayatPembayaranController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        
        // Mencari semua jadwal praktikum yang dipegang oleh Asisten Lab yang sedang login
        $jadwalPraktikumIds = JadwalPraktikum::where('user_id', $user->id)->pluck('id');
        
        // Mendapatkan riwayat checkout berdasarkan jadwal praktikum yang dipegang oleh Asisten Lab
        $riwayat = Checkout::whereHas('pembayaranPraktikum.jadwalPraktikum', function ($query) use ($jadwalPraktikumIds) {
                $query->whereIn('id', $jadwalPraktikumIds);
            })
            ->with('pembayaranPraktikum.jadwalPraktikum')
            ->get();
        
        return view('riwayat-praktikum.index', compact('user', 'riwayat'));
    }
    
    public function updateTolak(Request $request, $id)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'status' => 'required'
        ]);
    
        try {
            // Temukan data checkout berdasarkan ID
            $checkout = Checkout::findOrFail($id);
    
            // Update status menjadi "sukses"
            $checkout->update([
                'status' => 'Ditolak',
            ]);
            

            // Berikan respon sukses
            return redirect()->back()->with('success','Pembayaran berhasil ditolak');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return redirect()->back()->with('error','Gagal memperbarui status');
        }
    }
    public function updateSukses(Request $request, $id)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'status' => 'required'
        ]);
    
        try {
            // Temukan data checkout berdasarkan ID
            $checkout = Checkout::findOrFail($id);
    
            // Update status menjadi "sukses"
            $checkout->update([
                'status' => 'Sukses',
            ]);
    
            // Berikan respon sukses
            return redirect()->back()->with('success','Pembayaran berhasil disetujui');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return redirect()->back()->with('error','Gagal memperbarui status');
            // return response()->json(['message' => 'Gagal memperbarui status'], 500);
        }
    }
}
