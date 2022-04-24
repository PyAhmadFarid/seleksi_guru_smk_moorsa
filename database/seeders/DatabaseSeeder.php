<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'vita',
            'email' => 'vit@gmail.com',
            'password' => Hash::make('qwe'),
        ]);

        $kr = [
            ['simbol' => 'C1', 'nama' => 'Pengalaman mengajar', 'maxmin' => 'max', 'bobot' => 20],
            ['simbol' => 'C2', 'nama' => 'Usia', 'maxmin' => 'max', 'bobot' => 20],
            ['simbol' => 'C3', 'nama' => 'Ijasah terakhir', 'maxmin' => 'max', 'bobot' => 20],
            ['simbol' => 'C4', 'nama' => 'Potensi Akademik dan Prestasi', 'maxmin' => 'max', 'bobot' => 20],
            ['simbol' => 'C5', 'nama' => 'Keterlambatan', 'maxmin' => 'min', 'bobot' => 10],
            ['simbol' => 'C6', 'nama' => 'Sakit atau Ijin', 'maxmin' => 'min', 'bobot' => 10],
        ];

        foreach ($kr as $k) {
            Kriteria::create($k);
        }

        $gr = [
            "Syuhud Immawan,Ss",
            "Subhan, S.PdI",
            "Sumaiyah, S.Pd",
            "Istandi Ajudin, M.Pd",
            "Mudmaiddah, S.Pd",
            "Ratri Suraswati, S.Pd",
            "Rodliyah Yunita, S.Pd",
            "Dwi Kustiyah, S.Pd",
            "Susi Pangestutik, S.Pd",
            "Ismiyanti Handayani, S.Psi",
            "Fachrijal Al-Farisi, S.Ds",
            "Ngaderi Setiawan, M.Pd",
            "Joko Tri Prasetyo",
            "Devi Nurwidya W, S.Pd",
            "Yulia Nur Santi"
        ];

        foreach($gr as $i=>$g){
            Guru::create([
                "name"=>$g,
                "simbol"=>($i+1)."A"
            ]);
        }
    }
}
