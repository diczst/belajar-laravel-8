# Belajar Laravel Part 6 : Blade Templates

## Blade Templates
File template blade menggunakan ekstensi file `.blade.php` dan biasanya disimpan di direktori `resources/views` sederhananya setiap file view yang kita buat dengan ekstensi `.blade.php` dapat mengunakan blade templates sehingga kita bisa menggunakan berbagai sintaks kode blade templates seperti `@yield`, `@include`, `@if`, `{{ $someting }}` untuk menampilkan data dan sebagainya.

Pada materi kali ini kita akan melihat mengapa kita membutuhkan blade templates beserta dengan manfaatnya dalam pengembangan sistem yang kita bangun. Materi ini juga akan menjadi dasar sebelum kita menerapkan template-template ui tertentu yang banyak kita jumpai di internet seperti `SB Admin 2`.

## Membuat View
Pertama-tama kita akan membuat tiga file view yaitu `home.blade.php`, `contact.blade.php`, dan `about.blade.php`. Pada `home.blade.php` kita tambahkan kode sebagai berikut :
```
<html>
    <head>
        <title>Halaman Utama</title>
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
        <hr/>

        <p>Selamat datang di situs biografi saya, berikut adalah buku-buku favorit saya.</p>
    
        <h2>Kumpulan Buku favorit</h2>
    
        <ol>
            <li>Meditation - Marcus Aurelius</li>
            <li>Machine Learning for Beginner - Chris Sebastian</li>
            <li>Mindset - Carol Dwek</li>
            <li>Ego is The Enemy - Ryan Holiday</li>
            <li>Atomic Habit - James Clear</li>
        </ol>
    
	<hr/>
	<footer>
		<p>&copy; 2022 Dicky Pratama</p>
	</footer>
    
    </body>
</html>
```
Selanjutnya kode untuk halaman `contact` :
```
<html>
    <head>
        <title>Kontak Saya</title>
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
        <hr/>
    
        <h2>Kontak Saya</h2>
        <table >
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
    
	<hr/>
	<footer>
		<p>&copy; 2022 Dicky Pratama</p>
	</footer>
    
    </body>
    </html>
```
Selanjutnya kode untuk halaman about :
```
<html>
    <head>
        <title>Tentang Saya</title>
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
        <hr/>
    
        <h2>Tentang Saya</h2>
    
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit enim modi temporibus possimus deserunt quas! Eveniet odit magnam ea distinctio. Assumenda, reiciendis fugiat consequuntur nisi aut obcaecati minima architecto! Unde.
        </p>
    
	<hr/>
	<footer>
		<p>&copy; 2022 Dicky Pratama</p>
	</footer>
    
    </body>
    </html>
```
Selanjutnya kita tambahkan tiga route baru pada `web.php` untuk membuka tiga halaman yang sudah kita buat sebelumnya.
```
Route::get('/home', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});
```
Selanjutnya kita coba untuk mengakses route yang sudah kita buat, mulai dari home yaitu `localhost:8000/home`. Jika berhasil maka akan tampil halaman home yang sudah kita buat sebelumnya. Pada tampilan home ini kita memiliki navigasi yang dapat memudahkan kita berpindah-pindah halaman dengan lebih mudah yang telah kita buat pada bagian header.

Jika kita perhatikan, kode ketiga view kita memiliki kesamaan pada bagian awal dan akhirnya. Jika kode view yang kita miliki masih sedikit, hal ini tidak akan menjadi masalah. Akan tetapi, jika file view kita sudah sangat banyak, maka hal ini akan menyulitkan kita kedepannya dalam mengembangkan sistem yang kita buat. Selain itu, menuliskan kode-kode yang sama secara berulang sangatlah tidak disarankan dan tidak efektif. Oleh sebab itu, kita dapat mengurangi redundansi atau pengulangan kode-kode kita dengan menggunakan beberapa sintaks blade templates.

## Link
https://laravel.com/docs/8.x/blade
