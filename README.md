# Belajar Laravel Part 13 : Eloquent

## Eloquent 
Sebelumnya kita telah membuat fitur `CRUD` menggunakan `query buider`. Terdapat sebuah fitur canggih lainnya yang dimiliki Laravel untuk membuat fitur `CRUD` tersebut menjadi lebih mudah yaitu `Eloquent`. Berdasarkan dokumentasi Laravel, `Eloquent` adalah sebuah ORM (object-relational maper) dimana tiap-tiap tabel yang ada di database  memiliki sebuah model yang mewakilinya. Model inilah yang memungkinkan kita untuk melakukan CRUD pada tabel dalam database kita.

## Persiapan
Pertama-tama, jika teman-teman belum memiliki file migration yang sudah kita generate pada materi sebelumnya, maka masukkan perintah ini terlebih dahulu :
```
php artisan make:migration create_kategori_table
```
Selanjutnya masukkan kode sebagai berikut pada function `up()`:
```
public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
        });
}
```
Selanjutnya kita lakukan migration dengan perintah
```
php artisan migrate
```

## Menampilkan Data dengan Eloquent
Sekarang pada database terdapat tabel kategori. Selanjutnya untuk menerapkan `Eloquent` maka kita perlu membuat suatu model untuk merepresentasikan table kita. Teman-teman bisa membuat model dengan menjalankan perintah :
```
php artisan make:model Kategori
```
Selanjutnya buka folder `app\Models` lalu buka file model kita bernama `Kategori.php` yang sudah digenerate oleh Laravel melalui perintah yang kita jalankan sebelumnya. Lalu tambahkan kode sebagai berikut :
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // use HasFactory; 
    protected $table = "kategori";
}
```
`HasFactory` dapat dihilangkan atau dikomentari karena tidak akan kita gunakan karena ini akan dipakai jika kita ingin menambahkan fake data untuk testing. Sebelumnya perlu diingat bahwa penamaan table default pada laravel adalah jamak. Jadi table `kategori` akan diketahui sebagai table `kategoris` sehingga perlu untuk menuliskan `protected $table = "kategori"` agar Laravel mengetahui table tersebut bernama kategori bukan `kategoris`.

Agar lebih rapi, kita perlu membuat sebuah controller terlebih dahulu. Gunakan perintah
```
php artisan make:controller KategoriController --resource
```
`--resource` berarti kita akan membuat fungsi-fungsi yang kita butuhkan untuk CRUD secara otomatis saat file `KategoriController` digenerate. Selanjutnya pada `KategoriController.php` tambahkan kode sebagai berikut :
```
public function index()
    {
        // mengambil semua data kategori
    	$kategoris = Kategori::all();
 
    	// mengirim data-data kategori ke view kategori
    	return view('kategori.index', ['kategoris' => $kategoris]);
    }
```
Sebelumnya kita belum membuat file view index untuk kategori. Maka kita buat terlebih dahulu file view index atau file view untuk menampilkan data-data kategori ini. Buat folder baru di `resources\views` berni nama folder `kategori` lalu didalamnya kita buat file view baru lagi bernama `index.blade.php` lalu kita tambahkan kode sebagai berikut :
```
<!DOCTYPE html>
<html>
<head>
	<title>Eloquent</title>
</head>
<body>
 
<h1>Data Kategori</h1>
 
<ul>
	@foreach($kategoris as $kategori)
		<li>{{ "Kategori : ". $kategori->nama}}</li>
	@endforeach
</ul>
 
</body>
</html>
```
Terakhir kita tambahkan route baru di `web.php` untuk menampilkan data kategori kita
```
Route::get('/kategori',[KategoriController::class, 'index']);
```
Jika belum ada data yang tampil, tambahkan beberapa data secara manual melalui Phpmyadmin. Jika sudah tampil, maka kita sudah berhasil menampilkan data dengan menggunakan Eloquent atau class Model untuk mewakili tabel dari database.


## Links
- https://laravel.com/docs/8.x/eloquent

