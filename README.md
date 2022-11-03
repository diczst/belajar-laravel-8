# Belajar Laravel Part 18 : Login dan Register

## Persiapan
Laravel sudah menyediakan file migration untuk membuat tabel `users` oleh karena itu kita langsung dapat melakukan migration seperti berikut:

php artisan migrate:fresh

## Membuat Fitur Login dan Register
Pertama-tama kita memerlukan library laravel UI, perlu diingat bahwa versi laravel yang digunakan pada materi ini adalah laravel versi `8.x`. Berdasarkan dokumentasi Laravel UI, versi laravel ui yang dapat digunakan pada laravel `8.x` adalah laravel ui `3.x` oleh karena itu kita jalankan perintah sebagai berikut:
```
composer require laravel/ui "^3.x"
```
 
Selanjutnya jalankan perintah sebagai berikut:
```
php artisan ui bootstrap --auth
```
Setelah menjalankan perintah diatas, laravel akan membuat sebuah controller baru beserta dengan routenya pada `web.php`. Buka `web.php` maka secara default akan ada kode sebagai berikut:
```
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
```
Ubah route pada `web.php` menjadi sebagai berikut:
```
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
```
Selanjutnya coba buka halaman utama `localhost:8000` maka dapat dilihat bahwa tampilan web kita masih belum terintegrasi dengan CSS. Untuk memperbaikinya maka kita dapat tambahkan kode sebagai berikut pada bagian <!-- Styles --> file `app.blade.php` :
```
<!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script> 
```
Sekarang tampila halaman login kita sudah terintegrasi dengan bootstrap. Coba lakukan register untuk membuat akun selanjutnya lakukan login. Jika berhasil maka pembuatan fitur login sudah berhasil dilakukan


## Links
https://github.com/laravel/ui