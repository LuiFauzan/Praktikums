<?php

namespace Database\Seeders;

use App\Models\Praktikum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PraktikumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Praktikum::create([
            'nama' => 'Pjk',
            'slug' => 'pjk',
            'tahunajaran' => '2023 - 2024 Genap',
            'semester' => '4',
        ]);
        Praktikum::create([
            'nama' => 'Pbd',
            'slug' => 'pbd',
            'tahunajaran' => '2023 - 2024 Genap',
            'semester' => '4',
        ]);
        Praktikum::create([
            'nama' => 'Pwf',
            'slug' => 'pwf',
            'tahunajaran' => '2023 - 2024 Genap',
            'semester' => '4',
        ]);
    }
}
