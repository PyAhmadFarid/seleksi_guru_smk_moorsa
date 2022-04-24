<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(){
        // dd("aaa");
        $kriteria = Kriteria::all();

        return view('admin.kriteria',compact('kriteria'));
    }

    public function show_add(){
        return view('admin.formKriteria');
    }
    public function show_edit($id){
        $kriteria = Kriteria::find($id);
        return view('admin.formKriteria',compact('kriteria'));
    }
    public function add(Request $request){
        $cre = $request->validate([
            'nama'=>'required',
            'maxmin'=>'required',
            'bobot'=>'required'
        ]);

        Kriteria::create($request->all());
        return redirect()->route('kriteria');
    }
    public function edit(Request $request,$id){
        $cre = $request->validate([
            'nama'=>'required',
            'maxmin'=>'required',
            'bobot'=>'required'
        ]);

        $kriteria = Kriteria::find($id);
        $kriteria->fill($request->all());
        $kriteria->save();
        return redirect()->route('kriteria');

    }

    public function delete($id){
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return redirect()->route('kriteria');
    }
}
