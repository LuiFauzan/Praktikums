<?php

// app/Http/Middleware/ShowLoadingPage.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShowLoadingPage
{
    public function handle(Request $request, Closure $next)
    {
        // Menampilkan halaman loading
        return response(view('components.loading'));
        
        // Atau, jika ingin menunggu sebentar sebelum meneruskan permintaan
        // return $next($request)->withHeaders(['Refresh' => '1']);
    }
}

