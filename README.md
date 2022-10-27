# Belajar Laravel Part 9 : Search

## Search
Fitur search berguna untuk memudahkan pengguna mencari data yang diinginkan. Fitur search sangat dibutuhkan jika sistem kita nantinya memiliki data yang sangat banyak, agar pengguna tidak perlu terus melakukan scroll untuk mencari data yang dicari.

Untuk menerapkan fitur seach, pertama-tama kita buka `BookController`, selanjutnya kita tambahkan function `search()` dengan kode sebagai berikut :
```
public function search(Request $request){
	$search = $request->search;
        $books = DB::table('buku')->where('judul','like',"%".$search."%")->paginate();

        return view('index',['books' => $books]);
}
```
Selanjunya pada `index.blade.php` diatas kode table, kita tambahkan kode sebagai berikut :

```
<form action="/buku/search" method="GET">
	<input type="text" name="search" placeholder="Cari Buku .." value="{{ old('search') }}">
	<input type="submit" value="Cari">
</form>
```
Terakhir tambahkan route baru untuk mencari data sebagai berikut :
```
Route::get('/buku/search', [BookController::class, 'search']);
```

![alt text](https://i.ibb.co/MBfHZ63/image.png)

