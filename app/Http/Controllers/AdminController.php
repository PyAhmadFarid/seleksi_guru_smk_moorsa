<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\NilaiKriteriaGuru;
use App\Models\NilaiPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {

        $guru = Guru::all();
        $kriteria_raw = Kriteria::all();
        $kriteria = [];
        foreach ($kriteria_raw as $kr) {
            $kriteria[$kr->id] = $kr;
        }
        $nilai = NilaiKriteriaGuru::all();


        //nili pembagian

        $pembagian = [];
        foreach ($nilai as $n) {
            if (isset($pembagian[$n->kriteria_id])) {
                $pembagian[$n->kriteria_id] += $n->nilai ** 2;
            } else {
                $pembagian[$n->kriteria_id] = $n->nilai ** 2;
            }
        }
        foreach ($pembagian as $i => $p) {
            $pembagian[$i] = sqrt($p);
        }
        // dd($pembagian);

        //normalisasi
        $normalarray = [];
        $cost = [];

        foreach ($nilai as $n) {
            $rum = ($n->nilai / $pembagian[$n->kriteria_id]) * $kriteria[$n->kriteria_id]->bobot;

            if (isset($normalarray[$n->guru_id]) && $cost[$n->guru_id]) {
                $normalarray[$n->guru_id][$n->kriteria_id] = $rum;
                $cost[$n->guru_id][$kriteria[$n->kriteria_id]->maxmin] += $rum;
            } else {
                $normalarray[$n->guru_id] = [$n->kriteria_id => $rum];
                $cost[$n->guru_id] = ['max' => 0, 'min' => 0];
                $cost[$n->guru_id][$kriteria[$n->kriteria_id]->maxmin] += $rum;
            }

            //$cost[$kriteria[$n->kriteria_id]->maxmin]+=$rum;
        }

        $ymaxmin = [];
        foreach ($cost  as $i => $cs) {
            // dd($cs);
            if ($cs['max'] != 0 && $cs['min'] != 0) {
                $ymaxmin[$i] = ($cs['max'] / $cs['min']);
            }else{
                $ymaxmin[$i] = 0;
            }
        }
        arsort($ymaxmin);
        // dd($ymaxmin);






        return view('admin.dashboard', compact('guru', 'kriteria', 'ymaxmin'));
    }
}
