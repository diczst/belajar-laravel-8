# Belajar Laravel Part 7.3 : CRUD - DELETE (Menghapus Data)

## Menghapus Data (DELETE)
Untuk menghapus data pertama-tama kita perlu untuk merubah href hapus yang terdapat pada `index.blade.php` menjadi sebagai berikut :
```
<a href="/buku/destroy/{{ $book->id }}">Hapus</a>
```

Selanjutnya kita tambahkan kode sebagai berikut pada method destroy di `BookController`:
```
public function destroy($id){
        DB::table('buku')->where('id',$id)->delete();
        return redirect('/');
}
```

Terakhir kita buat routenya di `web.php`
```
Route::get('/buku/destroy/{param}', [BookController::class, 'destroy']);
```

## Link
https://laravel.com/docs/8.x/queries