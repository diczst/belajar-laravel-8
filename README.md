# Belajar Laravel Part 5 : Request Data

## Input Request
Seringkali sistem yang kita buat akan menerima inputan atau `request` dari user. `Request` biasanya dilakukan oleh pengguna untuk melakukan operasi data tertentu seperti `menambah data`, `menghapus data`, `mengubah data` dan `melihat data`. Secara garis besar ada dua jenis cara yang dapat dilakukan oleh user untuk mengirimkan request yaitu:
1. Mengirimkan request melalui URL
2. Mengirimkan request melalui input form

Kita dapat menampilkan atau menerima `request` tersebut untuk melakukan operasi tertentu, baik yang dikirim melalui URL, maupun dari input form.

### Menerima Request dari URL
Agar user dapat mengirimkan `request` melalui URL, maka kita harus menyediakannya terlebih dahulu pada route kita. Pertama-tama kita buka file `BookController` selanjutnya kita tambahkan function baru bernama `favoriteBook()` dengan kode sebagai berikut : 
```
public function favoritebook($namaBuku){
        return $namaBuku;
}
```
Selanjutnya kita buka file `web.php` lalu kita tambahkan route baru sebagai berikut :
```
Route::get('/favoritebook/{namabuku}', [BookController::class, 'favoritebook']);
```
Sekarang coba akses route yang baru kita buat dengan cara membuka `localhost:8000/favoritebook/Mindset`. Jika sudah berhasil, maka akan muncul sebuah teks bertuliskan `Mindset` yang merupakan `request` yang kita kirimkan melalui URL. Jika ingin menambahkan spasi, kita bisa menggunakan `%20` seperti berikut : `localhost:8000/favoritebook/Mindset%20-%20Carol%20Dweck`, maka hasil yang akan ditampilkan adalah `Mindset - Carol Dweck`.

### Menerima Request dari Input Form
Selanjutnya kita akan mencoba menampilkan `request` yang dilakukan user melalui input form. Input form ini akan menggunakan method post. Cara kerja input form method post ini mirip dengan pengiriman `request` melalui URL. Namun, pada input form dengan method post, `request` yang dikirimkan oleh user tidak dikirim melalui URL, sehingga data `request` tidak akan terlihat di alamat URL untuk tujuan keamanan. Hal ini karena data-data sensitif seperti password akan sangat berbahaya apabila diinputkan melalui URL karena dapat terlihat secara langsung maupun secara tidak langsung (dari history browser).

<br>

Langkah pertama untuk menerima `request` dari input form, maka kita butuh halaman formnya terlebih dahulu. Kita buat file view baru `formbook.blade.php`, lalu kita masukkan source code sebagai berikut:
```
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Buku Favorit</title>
</head>
<body>
	<h2>Buku Favorit</h2>
    <form action="/formbook/show" method="post">
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
      
      	Nama Buku :
		<input type="text" name="nama"> <br/>
		Penulis :
		<input type="text" name="penulis"> <br/>
		<input type="submit" value="Simpan">
	</form>
</body>
</html>
```
Kita akan menggunakan `BookController` agar lebih rapi, maka selanjutnya kita buka `BookController` lalu tambahkan function baru `formbook()` dan tambahkan kode sebagai berikut :
```
public function formbook(){
    return view('formbook');
}
```
Jika sudah, maka kita buat route baru di `web.php` dan kita panggil function `formbook` yang berada pada `BookController` untuk menampilkan view `formbook` yang sudah kita buat.
```
Route::get('/formbook', [BookController::class, 'formbook']);
```
Selanjutnya kita buka `http://localhost:8000/formbook` maka akan tampil halaman seperti berikut :
![alt text](https://i.ibb.co/yXyJW8S/Capture.jpg)

Setelah kita membuat view dan input form untuk user, sekarang kita akan menampilkan request yang diinputkan oleh user. Pertama-tama kita buka kembali `BookController`, selanjutnya kita tambah function `showbook()` sebagai berikut :
```
public function showbook(Request $request){
        $nama = $request->input('nama');
     	$penulis = $request->input('penulis');
        return $nama." - ".$penulis;
}
```
Selanjutnya kita tambahkan route baru dengan memanggil function `showbook` yang sudah kita buat selanjutnya
```
Route::post('/formbook/show', [BookController::class, 'showbook']);
```
Kita buka kembali halaman form kita `http://localhost:8000/formbook`, selanjutnya kita coba masukkan data misalnya
- Nama Buku : Bicara itu Ada Seninya
- Penulis : Oh Su Hyang  

Selanjutnya kita tekan tombol submit, maka akan muncul nama buku dan penulis yang sebelumnya sudah kita inputkan yaitu
`Bicara itu Ada Seninya - Oh Su Hyang`. Jika kita perhatikan, data request yang kita inputkan pada input form tidak muncul pada url. URL yang ditampilkan tidak berubah, tetap `http://localhost:8000/formbook` inilah salah satu tujuan dari metode request dengan input form menggunakan method post yaitu mengamankan dan menyembunyikan data.


## Link
https://laravel.com/docs/8.x/requests#main-content




