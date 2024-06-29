<?php

namespace App\Http\Controllers;

use App\Models\JadwalPraktikum;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $searchQuery = $request->get('query');
        $currentTime = Carbon::now()->format('H:i');

        $jp = JadwalPraktikum::query()
            ->whereHas('dosen', function ($q) use ($searchQuery) {
                $q->where('nama', 'like', '%'.$searchQuery.'%');
            })
            ->orWhereHas('praktikum', function ($q) use ($searchQuery) {
                $q->where('nama', 'like', '%'.$searchQuery.'%');
            })
            ->orWhere('ruangan', 'like', '%'.$searchQuery.'%')
            ->orWhere('kelas', 'like', '%'.$searchQuery.'%')
            ->latest()
            ->paginate(10);

        $upcomingJadwal = JadwalPraktikum::where('jammulai', '>', $currentTime)
            ->orderBy('jammulai', 'asc')
            ->take(1) // You can change this to display more or fewer upcoming schedules
            ->get();

        return view('welcome', compact('jp', 'upcomingJadwal'));
    }
}
