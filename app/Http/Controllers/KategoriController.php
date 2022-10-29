<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
 
    public function index()
    {
        // mengambil semua data kategori
    	$kategoris = Kategori::all();
 
    	// mengirim data-data kategori ke view kategori
    	return view('kategori.index', ['kategoris' => $kategoris]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
