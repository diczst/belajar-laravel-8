<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function index() {
    	$books = DB::table('buku')->paginate(10);
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

    public function show($id){
        
    }

    public function edit($id){
        $book = DB::table('buku')->where('id',$id)->get()->first();
        return view('buku.edit',['book' => $book]);
    }

    public function update(Request $request) {
        DB::table('buku')->where('id',$request->id)->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah
        ]);
        return redirect('/');
    }

    public function destroy($id){
        DB::table('buku')->where('id',$id)->delete();
        return redirect('/');
    }
}
