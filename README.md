# Belajar Laravel Part 6.1 : Blade Templates II

Sebelumnya kita sudah membuat web dengan fitur navigasi sederhana. Namun, pada kode sebelumnya, masih terdapat banyak sekali redundansi atau penulisan kode yang sama secara berulang-bulang. Pada materi ini kita akan mengurangi redundansi dari kode yang sudah kita tuliskan sebelumnya dengan menggunakan beberapa sintaks yang bisa kita gunakan pada blade templates.

Pertama-tama kita buat file view baru yaitu `master.blade.php` dengan kode sebagai berikut :
```
<html>

<head>
    <title>{{ $title }}</title>
</head>

<body>

    <header>

        <h2>Situs Biografi Saya</h2>
        <nav>
            <a href="/home">Home</a>
            |
            <a href="/contact">Kontak Saya</a>
            |
            <a href="/about">Tentang Saya</a>

        </nav>
    </header>
    <hr />

    <!-- bagian konten -->
    @yield('content')

    <hr />
    <footer>
        <p>&copy; 2022 Dicky Pratama</p>
    </footer>

</body>

</html>

```
Selanjutnya kita ubah kode pada `home.blade.php` menjadi seperti berikut :
```
@extends('master')

@section('content')
    <p>Selamat datang di situs biografi saya, berikut adalah buku-buku favorit saya.</p>

    <h2>Kumpulan Buku favorit</h2>

    <ol>
        <li>Meditation - Marcus Aurelius</li>
        <li>Machine Learning for Beginner - Chris Sebastian</li>
        <li>Mindset - Carol Dwek</li>
        <li>Ego is The Enemy - Ryan Holiday</li>
        <li>Atomic Habit - James Clear</li>
    </ol>
@endsection
```
Selanjutnya kita ubah kode pada `contact.blade.php` menjadi seperti berikut :
```
@extends('master')

@section('content')
    <h2>Kontak Saya</h2>
    <table>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>abecede@gmail.com</td>
        </tr>
        <tr>
            <td>Hp</td>
            <td>:</td>
            <td>0896-8898-9988</td>
        </tr>
    </table>
@endsection
```
Selanjutnya kita ubah kode pada `about.blade.php` menjadi seperti berikut :
```
@extends('master')

@section('content')
    <h2>Tentang Saya</h2>

    <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit enim modi temporibus possimus deserunt quas! Eveniet
        odit magnam ea distinctio. Assumenda, reiciendis fugiat consequuntur nisi aut obcaecati minima architecto! Unde.
    </p>
@endsection
```
`@extends('master')` berarti kita ingin menggunakan semua kode yang berada pada file `master`. Kode yang berada diantara `@section` dan `@endsection` merupakan kode yang akan menggantikan bagian `@yield('content')` yang berada pada `master.blade.php`. Data `@yield('content)` ini akan bersifat dinamis atau berubah-ubah, tergantung apa yang dipilih oleh pengguna.

Sekarang jika kita mengakses `localhost:8000/home` kembali, maka akan terjadi error `Undefined variable $title` hal ini terjadi karena kita belum mengirimkan data pada tiap-tiap view yang sudah kita buat. Untuk memperbaiki error ini, kita bisa membuka `web.php` terlebih dahulu, lalu kita kirimkan data title sebagai berikut : 
```
Route::get('/home', function () {
    return view('home',['title' => 'Halaman Utama']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Kontak Saya']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'Tentang Saya']);
});
```
Jika kita mengakses `localhost:8000/home` kembali maka web kita sudah berfungsi kembali, dengan kode yang lebih baik dari sebelumnya. Dapat kita amati bahwa mekanisme yang kita gunakan untuk menampilkan data `title` hampir sama dengan `@yield('content')`. Tiap nama key pada ketiga route yang kita buat adalah sama yaitu `$title`. Namun,  dapat memiliki nilai yang berbeda-beda tergantung dengan route apa yang diakses oleh user. begitu juga dengan `@yield('content)` yang dapat memiliki kode yang berbeda-beda sedangkan kode di luar `@yield` tetap sama.

## Link
https://laravel.com/docs/8.x/blade
