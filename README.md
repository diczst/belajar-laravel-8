# Belajar Laravel Part 7 : CRUD - READ (Membaca Data)

## CRUD
CRUD merupakan singkatan untuk Create, Read, Update, dan Delete. CRUD Merupakan fitur atau operasi dasar untuk mengelola data yang ada pada sistem kita. 
- Create : Menambahkan data
- Read : Menampilkan data
- Update : Memperbaruhi data
- Delete : Menghapus data

Seperti yang kita ketahui, untuk mengelola data yang ada di database, kita memerlukan query. Laravel telah menyediakan fitur atau tools yang dapat lebih memudahkan kita untuk melakukan query bernama `Query Builder`.

## Persiapan
Sebelum membuat fitur CRUD kita memerlukan database dan sebuah tabel. Pertama-tama kita buat database baru, bisa dari PhpMyAdmin atau melalui command prompt. Dalam proyek ini kita akan menggunakan studi kasus sistem informasi perpustakaan. Nama database yang akan dibuat adalah `dbperpus`.

Setelah membuat database maka kita buat tabel baru untuk permulaan kita buat tabel `buku` dengan kolom-kolom sebagai berikut :
- id : int (auto increment)
- judul : varchar (255)
- kategori : varchar (50)
- jumlah : int

Setelah membuat tabel, kita inputkan dua data ke tabel `buku` yang sudah kita buat (bisa menggunakan command prompt atau phpmyadmin). Dalam contoh ini kita buat dua data misalnya :

| Judul  | Kategori | Jumlah |
| ------ | -------- | ------ |
| Atomic Habits  | Pengembangan Diri | 100
| Outliers  | Pengembangan Diri | 50

Selanjutnya buka file `.env` lalu ubah
```
DB_DATABASE=laravel
```
menjadi nama dari database yang sudah kita buat sebelumnya
```
DB_DATABASE=dbperpus
```

<br>


## Membaca Data dari Database (Read)
Pertama-tama kita akan membuat controllernya terlebih dahulu. Sebelumnya kita telah belajar cara membuat controller beserta functionnya. Terdapat cara yang lebih cepat dan mudah untuk membuat controller yaitu dengan perintah :
```
php artisan make:controller BookController --resource
```
Sekarang kita buka file `BookController`, dapat kita lihat bahwa secara default controller kita sudah memiliki tujuh function. Ketujuh function inilah yang akan kita gunakan untuk membuat fitur CRUD pada sistem kita. Namun, pada materi ini yang akan kita gunakan hanya method `index()` saja yaitu method yang digunakan untuk menampilkan data. 

Catatan : Jika dirasa menganggu, komentar-komentar default yang ada pada controller juga bisa dihapus.

Sebelumnya kita buat file view terlebih dahulu untuk menampilkan data-data yang akan kita kirimkan melalui `BookController`. Kita buat folder baru dalam folder `resources\views` yaitu `buku`. Selanjutnya dalam folder buku kita buat file view `index.blade.php` lalu tambahkan kode sebagai berikut :
```
<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
</head>
<body>
 
	<h3>Data Buku</h3>
 
	<a href="#"> + Tambah Buku Baru</a>
	
	<br/>
	<br/>
 
	<table border="1">
		<tr>
			<th>Judul</th>
			<th>Kategori</th>
			<th>Jumlah</th>
			<th>Aksi</th>
		</tr>
		@foreach($books as $book)
		<tr>
			<td>{{ $book->judul }}</td>
			<td>{{ $book->kategori }}</td>
			<td>{{ $book->jumlah }}</td>
			<td>
				<a href="#">Ubah</a>
				|
				<a href="#">Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>
</body>
</html>
```
Karena kita belum akan membuat fitur tambah buku baru, ubah data buku, dan hapus buku, maka untuk hrefnya bisa kita isi dengan `#` saja ini menandakan bahwa saat di klik maka tidak akan terjadi apa-apa.

Selanjutnya Perhatikan pada `@foreach` terdapat variabel `$books`. Kita belum mengisi data `$books`, oleh karena itu kita kembali ke `BookController` lalu tambahkan kode seperti berikut : 
```
public function index() {
    	$books = DB::table('buku')->get();
    	return view('buku.index',['books' => $books]);
}
```
Pada kode diatas kita menggunakan `Query Builder` untuk mendapatkan data dari database. Sederhananya saat kita mengetikkan `DB::table('namatabel')->get();` maka kita melakukan query 
```
select * from namatabel
```
Data-data ini nantinya akan kita simpan dalam variabel `$books` untuk kita kirimkan ke view. pada saat kita melakukan `return view()` kita memasukkan `buku.index`, hal ini karena kita membuat file view `index.blade.php` yang berada dalam folder `views\buku`.

Terakhir kita buat route baru pada `web.php` dengan menambahkan kode sebagai berikut :
```
Route::get('/','BookController@index');
```
Sekarang kita coba akses halaman utama yaitu `localhost:8000` atau `localhost:8000/` Jika sudah tepat maka data-data yang sebelumnya sudah kita tambahkan secara manual di database. Akan tampil pada view Laravel yang sudah kita buat seperti berikut :
![alt text](https://i.ibb.co/KsKQSyq/Capture.jpg)




## Link
https://laravel.com/docs/8.x/queries




