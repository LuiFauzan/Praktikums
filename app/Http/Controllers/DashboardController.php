<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        // $user = Auth::user();
        // if ($user->role === 'Asisten Lab') {
        //     $praktikum = $user->praktikum;
        // } else {
        //     $praktikum = null;
        // }
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        return view('dashboard',compact('notifications'));
    }
}
