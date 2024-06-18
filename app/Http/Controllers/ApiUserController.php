<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Praktikum;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    //
    public function user(Request $request)
    {
        // Buat instance Guzzle client
        $client = new Client();
        // Kirim permintaan GET ke API Google Books tanpa parameter pencarian
        $response = $client->request('GET', 'http://localhost:9999/users');
        // Ambil isi respons
        $data = json_decode($response->getBody(), true);
        foreach($data as $item){
            $password = Hash::make($item['npm']);
            $users = new User();
            $users->npm = $item['npm'];
            $users->nama = $item['nama'];
            $users->password = $password;
            $users->email = $item['npm'] . $item['email'];
            $users->semester = $item['semester'];
            $users->tahunmasuk = $item['tahunmasuk'];
            $users->role = $item['role'];
            if($item['role'] == "Asisten Lab"){
                $users->praktikum_id = $item['praktikum_id'];
            }
            $users->kelas = $item['kelas'];
            $users->save();
        }
        return response()->json(['message'=>'Data Mahasiswa Berhasil Dimasukkan']);
        // return response()->json($data);
    }   
    public function dosen(Request $request)
    {
        // Buat instance Guzzle client
        $client = new Client();
        // Kirim permintaan GET ke API Google Books tanpa parameter pencarian
        $response = $client->request('GET', 'http://localhost:9999/dosens');
        // Ambil isi respons
        $data = json_decode($response->getBody(), true);
        foreach($data as $item){
            $users = new Dosen();
            $users->nid = $item['nid'];
            $users->nama = $item['nama'];
            $users->save();
        }
        return response()->json(['message'=>'Data Dosen Berhasil Dimasukkan']);
        // return response()->json($data);
    }   
    public function praktikum(Request $request)
    {
        // Buat instance Guzzle client
        $client = new Client();
        // Kirim permintaan GET ke API Google Books tanpa parameter pencarian
        $response = $client->request('GET', 'http://localhost:9999/praktikums');
        // Ambil isi respons
        $data = json_decode($response->getBody(), true);
        foreach($data as $item){
            $users = new Praktikum();
            $users->nama = $item['nama'];
            $users->slug = $item['slug'] ;
            $users->semester = $item['semester'];
            $users->tahunajaran = $item['tahunajaran'];
           
            $users->save();
        }
        return response()->json(['message'=>'Data Praktikum Berhasil Dimasukkan']);
        // return response()->json($data);
    }   

}
