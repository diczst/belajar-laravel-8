# Belajar Laravel Part 3 : Controller

## Pengertian MVC
Laravel menerapkan design pattern `MVC` (Model, View Controller) hal ini berarti dalam membangun aplikasi yang kita buat, terdapat 3 jenis file utama yang terletak pada folder yang berbeda-beda, tentunya tiap jenis file ini memiliki kegunaan yang berbeda-beda pula. Tujuan menerapkan design pattern saat membuat aplikasi adalah agar kode-kode yang kita tuliskan menjadi lebih rapi dan terstruktur, sehingga kita dapat lebih mudah dalam mengembangkan aplikasi kita kedepannya. Menerapkan design pattern, selain bertujuan untuk manajemen kode yang baik, juga dapat meminimalisir error yang akan terjadi apabila kita melakukan perubahan atau penambahan fitur pada aplikasi yang sudah selesai kita buat.


![alt text](https://www.dicoding.com/blog/wp-content/uploads/2021/09/Blog_Apa_Itu_MVC_Pahami_Konsepnya_dengan_Baik.jpg)


## Pengertian Controller
Pada bagian ini kita akan fokus membahas bagian `C` atau Controller. Sederhananya `Controller` merupakan jembatan penghubung antara  `View` dan `Model` sekaligus berperan sebagai pengolah data. Dalam Laravel, folder controller terletak pada `app\Http\Controllers\`. Ada beberapa cara untuk membuat controller di Laravel.

## Membuat Controller Baru

### Cara Pertama :
Membuat file controller baru dengan cara klik kanan > new file, pada folder `app\Http\Controllers`. Pada contoh ini kita akan buat file controller baru `BookController`. Setelah berhasil dibuat, kita akan menuliskan sintaks kode paling dasar untuk membuat sebuah controller.
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller {
    
}
```
`BookController` merupakan nama classnya. Untuk menjadikan class ini diidentifikasi sebagai controller maka kita lakukan extends `Controller`.


### Cara Kedua :
Cara kedua merupakan cara yang lebih mudah yaitu dengan menggunakan perintah yang disediakan oleh Laravel yaitu php artisan. Buka command prompt di folder laravel saat ini, lalu ketikkan php artisan, maka akan muncul berbagai perintah yang tersedia yang diawali dengan php artisan. Kita dapat menggunakan perintah `php artisan make:controller NamaController` untuk membuat controller baru.

<br>

Sekarang coba ketikkan pada cmd `php artisan make:controller CategoryController`, maka akan dibuat sebuah file baru pada folder `app\Http\Controllers` bernama CategoryController, bahkan kita tidak perlu menuliskan sintaks kode dasar controller karena secara otomatis sudah dibuatkan oleh Laravel.

## Membuat route baru menggunakan Controller
Pada materi sebelumnya kita sudah belajar bagaimana caranya membuat route baru. Coba perhatikan route awal yang telah disediakan laravel pada folder `routes` :
```
Route::get('/', function () {
    return view('welcome');
});
```
Kode diatas merupakan contoh pembuatan route yang tidak menggunakan controller. Route diatas menggunakan sebuah function tanpa class yang menampilkan view `welcome`. Kita akan coba membuat route baru lagi yang menggunakan controller, atau mengakses function yang ada pada class controller.

<br>

Pertama-tama tambahkan kode sebagai berikut pada `BookController`
```
class BookController extends Controller
{
    public function index(){
    	return "Halo saya dari method index(), class BookController";
    }
}
```
Pada class `BookController` kita menambahkan sebuah function baru bernama index(). Dalam index itu akan mengembalikan atau menampilkan sebuah data string `"Halo saya dari method index(), class BookController"`.  Jika sudah ditambahkan, selanjutnya kita buat sebuah route baru pada file `web.php`. Untuk membuat sebuah route baru yang menggunakan controller atau menggunakan function yang berada pada class controller, dapat kita lakukan dengan menuliskan kode berikut :
```
Route::get('/book', [BookController::class, 'index']);
```
Kode diatas dapat diartikan menjadi "saat user menuliskan `localhost:8000/book`, maka panggil method index yang ada pada class `BookController`". Sekarang coba akses pada web browser maka akan tampil data string yang sudah kita buat sebelumnya pada class `BookController` method `index()`, yaitu `"Halo saya dari method index(), class BookController"`.

## Link
https://laravel.com/docs/8.x/controllers

