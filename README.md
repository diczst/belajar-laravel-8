# Belajar Laravel Part 2 : Route dan View

## Route dasar laravel
Untuk mengelola route aplikasi laravel web, bisa dilakukan pada routes\web.php
Berikut adalah contoh dari route paling dasar dalam Laravel
```
Route::get('/', function () {
    return view('welcome');
});
```
Kode diatas adalah contoh dari sebuah route untuk halaman utama saat user memasukkan base url `localhost:8000` atau `localhost:8000/`

Maka sistem akan menampilkan file bernama welcome yang terletak di `resources\views\welcome.blade.php`


## Membuat route baru tanpa file view
Kita juga bisa membuat route baru yang menampilkan teks saja, tidak menampilkan file apapun
seperti berikut :
```
Route::get('/hello', function () {
    return "Hello World";
});
``` 

## Membuat route baru dengan file view baru

Untuk membuat route baru yang menampilkan halaman dari file bereksentensi blade.php pertama-tama kita buat terlebih dahulu file barunya di folder `resources\views\` dalam contoh ini file view baru yang dibuat adalah `about.blade.php`. Selanjutnya kita tambahkan kode sederhana html pada file view `about.blade.php` : 
```
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tentang Saya</title>
</head>
<body>
    Nama : Dicky Pratama<br>
    Hobi : Berkebun, membaca, dan pemrograman<br>
</body>
</html>
```
Selanjutnya kita buat route baru untuk menampilkan sebuah halaman yang berasal dari file view `about.blade.php` yang sudah kita buat sebelumnya. Untuk menambah route baru kita buka kembali file `web.php` yang berada di folder `routes` lalu kita tambahkan kode berikut : 
```
Route::get('/about', function () {
    return view('about');
});
```

## Mengirimkan data dari route ke view
pertama-tama kita buat terlebih dahulu file barunya di folder `resources\views\` dalam contoh ini file view baru yang dibuat adalah `favoritequote.blade.php`. Selanjutnya kita tambahkan kode sederhana html pada file view `favoritequote.blade.php` : 
```
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Favorite Quote</title>
</head>
<body>
</body>
</html>
```
Selanjutnya kita buat route baru pada `web.php` dengan menambahkan kode sebagai berikut :
```
Route::get('/favoritequote', function () {
    return view('favoritequote',[
        "quote" => "Stay Hungry, Stay Foolish",
        "by" => "Steve Jobs"
    ]);
});
```
Jika kita membuka `localhost:8000/favoritequote` pada web browser, maka tidak akan tampil apa-apa. Kita akan coba menampilkan data-data yang sudah kita buat di router. Data yang dibuat pada router berbentuk pasangan key value. Untuk mendapatkan valuenya kita harus menuliskan keynya dalam tanda double kurung kurawal sebagai berikut :
```
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Favorite Quote</title>
</head>
<body>
    {{ $quote }}<br>
    {{ $by }}
</body>
</html>
```
Sekarang kita coba buka `localhost:8000/favoritequote` kembali maka yang akan tampil adalah nilai dari key `$quote` dan nilai dari key `$by`.


