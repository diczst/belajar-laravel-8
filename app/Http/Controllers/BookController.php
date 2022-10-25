<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function index() {
    	$books = DB::table('buku')->get();
    	return view('buku.index',['books' => $books]);
    }

    public function store(Request $request){
        // insert data ke table buku
        DB::table('buku')->insert([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah
        ]);

	    // alihkan ke halaman utama
	    return redirect('/');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
