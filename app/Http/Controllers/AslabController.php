<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Praktikum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AslabController extends Controller
{
    //
    public function index(){
        $praktikum = Praktikum::all();
        $aslab = User::where('role','Asisten Lab')->paginate(5);
        return view('aslab.index',compact('praktikum','aslab'));
    }
    public function store(Request $request){
        
    $request->validate([
        'npm' => ['required', 'numeric'],
        'nama' => ['required', 'string', 'max:255'],
        'kelas' => ['required', 'string', 'max:20'],
        'tahunmasuk' => ['required', 'numeric'],
        'semester' => ['required', 'numeric'],
        'role' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        // 'praktikum_id' => ['required_if:role,Asisten Lab'],
    ]);

    $password = Hash::make($request->npm);

    $user = new User([
        'npm' => $request->npm,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'tahunmasuk' => $request->tahunmasuk,
        'semester' => $request->semester,
        'role' => $request->role,
        'email' => strtolower($request->email),
        'password' => $password,
    ]);
    $user->save();

    event(new Registered($user));

    // Auth::login($user);

    return redirect()->back()->with('success','Data Aslab Berhasil Ditambahkan'); // false untuk membuat URL relatif
    }
    public function update(Request $request, $id)
    {
  
        // Update data Asisten Lab
        $aslab = User::findOrFail($id);
        $aslab->nama = $request->nama;
        $aslab->email = $request->email;
        $aslab->npm = $request->npm;
        $aslab->semester = $request->semester;
        $aslab->kelas = $request->kelas;
        $aslab->tahunmasuk = $request->tahunmasuk;
        $aslab->role = $request->role;
        // $aslab->praktikum_id = $request->praktikum_id;
        $aslab->save();

        return redirect()->back()->with('success', $aslab->nama . ' Berhasil diperbarui');
    }
    public function destroy($id){
        $book = User::findOrFail($id);
        $book->delete();
        return redirect()->back()->with(['success' => 'Data Aslab Berhasil Dihapus!']);
    }
    
}
