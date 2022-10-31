<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller{
    public function index(){
    	$bukus = Buku::all();
    	return view('buku.index', ['bukus' => $bukus]);
    }
}
