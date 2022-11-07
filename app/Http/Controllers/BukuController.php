<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index(){
        // mengambil semua data kategori
    	$bukus = Buku::paginate(5);
        $kategoris = Kategori::get();
    	return view('admin.buku.index', [
            'nomor' => 1,
            'bukus' => $bukus,
            'kategoris' => $kategoris
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'image|file|max:1024',
    		'judul' => 'required',
            'jumlah' => 'required'
        ], [
            'judul.required' => "Judul wajib diisi",
            'jumlah.required' => "Jumlah wajib diisi"
        ]);
            

        $image = $request->file('image');
        if($request->file('image')){
            $image = $image->store('images');
        }

        if ($validator->fails()) {
            Alert::error('Gagal','Data buku baru gagal ditambahkan');
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        } else {
            Buku::create([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'jumlah' => $request->jumlah,
                'gambar' => $image
            ]);
            Alert::success('Berhasil','Data buku baru berhasil ditambahkan');
            return redirect('/');
        }
    }

    public function edit($id){
        $buku = Buku::find($id);
        $kategoris = Kategori::get();
        return view('admin.buku.edit', [
            'buku' => $buku,
            'kategoris' => $kategoris
        ]);
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

    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/');
    }
    
}
