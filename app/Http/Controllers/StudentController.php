<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\DaftarPraktikum;
use App\Models\PembayaranPraktikum;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PembayaranNotification;
use Illuminate\Notifications\NotificationSender;

class StudentController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
    
        // Ambil daftar praktikum yang terhubung dengan user yang login
        $jadwalpraktikum = DaftarPraktikum::where('user_id', $user->id)
            ->with('jadwalPraktikum')
            ->get();
    
        return view('student.index', compact('user', 'jadwalpraktikum'));
    }
    public function pembayaran()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        
        // Ambil daftar praktikum yang terkait dengan user
        $daftarPraktikumIds = $user->daftarPraktikum->pluck('jadwal_praktikum_id');
        
        // Ambil pembayaran praktikum yang jadwal_praktikum_id-nya ada di daftar praktikum user
        $pembayaran = PembayaranPraktikum::whereIn('jadwal_praktikum_id', $daftarPraktikumIds)->get();
        
        // dd($pembayaran);
        return view('student-bayar.index',compact('pembayaran'));
    }
    public function create($id)
    {
        $pembayaranPraktikum = PembayaranPraktikum::findOrFail($id);
        return view('checkout.create', compact('pembayaranPraktikum'));
    }

    /**
     * Menyimpan data checkout.
     */
    public function checkout(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->file('photo')) {
        $fileName = time().'.'.$request->photo->extension();  
        $request->photo->storeAs('photos', $fileName, 'public');

        // Simpan informasi ke database
        $checkout = Checkout::create([
            'user_id' => Auth::id(),
            'pembayaran_praktikum_id' => $request->pembayaran_praktikum_id,
            'photo' => $fileName,
            'status' => 'Pending',
        ]);

        // Mendapatkan praktikum_id dari pembayaranPraktikum yang terkait
        $pembayaranPraktikum = $checkout->pembayaranPraktikum;
        $jadwalPraktikum = $pembayaranPraktikum->jadwalPraktikum;
        
        // Mencari Asisten Lab berdasarkan jadwal_praktikum_id
        $adminPraktikum = User::where('role', 'Asisten Lab')
                              ->whereHas('jadwalPraktikum', function ($query) use ($jadwalPraktikum) {
                                  $query->where('id', $jadwalPraktikum->id);
                              })
                              ->get();

        if ($adminPraktikum->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada Asisten Lab yang ditemukan untuk jadwal praktikum ini.');
        }

        try {
            Notification::send($adminPraktikum, new PembayaranNotification($checkout));
            return redirect()->back()->with('success', 'Foto berhasil di-upload.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim notifikasi: ' . $e->getMessage());
        }
    }

    return redirect()->back()->with('error', 'Gagal meng-upload foto.');
}

    public function riwayat()
    {
        // Ambil data riwayat pembayaran sesuai user yang login
        $user = Auth::user();
        $riwayat = Checkout::where('user_id', $user->id)->with('pembayaranPraktikum')->get();

        return view('student-bayar.riwayat', compact('riwayat'));
    }
    public function destroy($id){
        $checkout = Checkout::findOrFail($id);
        $checkout->delete();
        return redirect()->back()->with('success','Pembayaran berhasil dihapus!');
    }
 
    
}
