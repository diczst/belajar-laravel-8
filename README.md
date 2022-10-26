# Belajar Laravel Part 7.2 : CRUD - UPDATE (Mengubah Data)

## Mengubah Data (UPDATE)
Pada materi sebelumnya kita telah belajar cara membuat fitur create untuk menambahkan data ke dalam database. Pada materi ini kita akan membuat fitur update untuk mengubah data yang sudah ada pada database. Langkah pertama yang akan dilakukan adalah kita perlu untuk membuat file view baru untuk halaman update data.Pada `resources\views\buku` kita buat file baru bernama `edit.blade.php` lalu tambahkan kode sebagai berikut :
```
<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <h3>Edit Buku</h3>

    <a href="/"> Kembali</a>

    <br />
    <br />

    <h2>Tambah Buku Baru</h2>
    <form action="/buku/update" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $book->id }}"> <br/>
        
        <label for="judul">Judul : </label><br>
        <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" required> <br><br>

        <label for="kategori">Kategori : </label><br>
        <input type="text" name="kategori" value="{{ old('kategori', $book->kategori) }}" required> <br><br>

        <label for="jumlah">Jumlah : </label><br>
        <input type="text" name="jumlah" value="{{ old('jumlah', $book->jumlah) }}" required> <br><br>

        <input type="submit" value="Edit Data">
    </form>


</body>

</html>
```

Pada `BookController` terdapat function `edit`. Function `edit` digunakan untuk menampilkan file view `edit` yang sudah kita buat sebelumnya. Kita tambahkan pada function `edit` di `BookController` dengan kode sebagai berikut :
```
public function edit($id){
        $book = DB::table('buku')->where('id',$id)->get()->first();
        return view('buku.edit',['book' => $book]);
}
```

Selanjutnya buka `web.php` tambahkan route untuk menampilkan view `edit` yang sudah kita buat dengan kode sebagai berikut :
```
Route::get('/buku/edit/{param}',[BookController::class, 'edit']);
```
{param} merupakan request yang dikirimkan melalui URL


Selanjutnya, kita tambah kode untuk mengupdate data, yaitu saat tombol ubah data ditekan. Tambahkan kode sebagai berikut pada function `update` yang terdapat pada `BookController` :
```
public function update(Request $request) {
        DB::table('buku')->where('id',$request->id)->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah
        ]);
        return redirect('/');
}
```

Terakhir tambahkan route baru untuk memperbaruhi data sebagai berikut :
```
Route::post('/buku/update', [BookController::class, 'update']);
```

## Catatan :
Pada bagian kode `required="required"` dapat disederhanakan menjadi `required`

## Link
https://laravel.com/docs/8.x/queries