<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
 
    public function index()
    {
        // mengambil semua data kategori
    	$kategoris = Kategori::paginate();
 
    	// mengirim data-data kategori ke view kategori
    	return view('kategori.index', ['kategoris' => $kategoris]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'nama' => 'required',
    	]);
 
        Kategori::create([
    		'nama' => $request->nama,
    	]);
 
    	return redirect('/kategori');
    }


    public function show($id)
    {
        //
    }


    public function edit($id){
        $kategori = Kategori::find($id);
        return view('kategori.edit', ['kategori' => $kategori]);
    }

    public function update(Request $request) {
        $this->validate($request,[
            'nama' => 'required',
         ]);
      
         $kategori = Kategori::find($request->id);
         $kategori->nama = $request->nama;
         $kategori->save();
         return redirect('/kategori');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect('/kategori');
    }
}
