<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $comics = [
            "Naruto - Masashi Kishimoto",
            "One Piece - Eichiro Oda",
            "Dragon Ball Super - Akira Toriyama",
            "Vinland Saga - Makoto Yukimura",
            "Doraemon - Fujio F. Fujiko"
        ];

    	return view('books',[
            'namasaya' => 'Dicky Pratama',
            'comics' => $comics
        ]);
    }

    public function favoritebook($namaBuku){
        return $namaBuku;
    }

    public function formbook(){
        return view('formbook');
    }

    public function showbook(Request $request){
        $nama = $request->input('nama');
     	$penulis = $request->input('penulis');
        return $nama." - ".$penulis;
    }
}
