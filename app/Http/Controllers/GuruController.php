<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\NilaiKriteriaGuru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    function index(){
        $guru = Guru::all();
        $kriteria = Kriteria::all();

        $nilai_raw = NilaiKriteriaGuru::all();

        $nilai = [];
        foreach($nilai_raw as $ni){
            $nilai[$ni->guru_id.':'.$ni->kriteria_id] = $ni->nilai;
        }
        // dd($nilai);//
        return view('admin.guru',compact('guru','kriteria','nilai'));

    }

    function save(Request $request){
        foreach($request->data as $i=>$dt){
            if($dt){
                $idd = explode(':',$i);
                $nilai = NilaiKriteriaGuru::where('guru_id','=',$idd[0])->where('kriteria_id','=',$idd[1])->first();
                if($nilai){
                    $nilai->nilai = $dt; 
                }else{
                    NilaiKriteriaGuru::create([
                        'nilai'=>$dt,
                        'guru_id'=>$idd[0],
                        'kriteria_id'=>$idd[1],
                    ]);
                }

            }
        }

        foreach($request->name as $i=>$nm){
            $guru = Guru::find($i);
            $guru->name = $nm;
            $guru->save();
        }

        return redirect()->route('guru');

    }

    function show_add(){
        return view('admin.formGuru');
    }
    function add(Request $request){
        $cre = $request->validate([
            'name'=>'required'
        ]);
        Guru::create($request->all());

        return redirect()->route('guru');
    }


    function delete($id){
        $guru = Guru::find($id);
        $guru->delete();
        return redirect()->route('guru');

    }
}
