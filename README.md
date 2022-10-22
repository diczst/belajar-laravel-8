# Belajar Laravel Part 4 : Menampilkan View dan Data dari Controller

Pada materi sebelumnya, kita telah membuat sebuah route baru yang menggunakan method `index()` yang berada pada class `BookController`. Method ini mengembalikan sebuah data string yang akan tampil apabila kita mengetikkan `localhost:8000/book` pada browser. Pada materi ini, kita akan belajar menampilkan view serta mengirimkan data dari controller.

## Menampilkan View dari Controller

Untuk menampilkan view dari controller, pertama-tama kita harus membuat file viewnya terlebih dahulu. Kita buat file baru pada folder `resources\views`, yaitu `books.blade.php`. Selanjutnya silahkan tambahkan kode sebagai berikut : 
```
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Buku</title>
</head>
<body>
    
    <h2>Kumpulan Buku Terbaik</h2>
    <marquee>Membaca adalah jendela dunia</marquee>

    <ol>
        <li>Meditation - Marcus Aurelius</li>
        <li>Machine Learning for Beginner - Chris Sebastian</li>
        <li>Mindset - Carol Dweck</li>
        <li>Ego is The Enemy - Ryan Holiday</li>
        <li>Atomic Habit - James Clear</li>
    </ol>
    
</body>
</html>
```
Setelah membuat file view, kita ubah kode pada method `index()` yang berada pada class `BookController` dari
```
 public function index(){
    	return "Halo saya dari method index(), class BookController";
 }
```
 menjadi
```
public function index(){
    	return view('books');
 }
``` 
perlu diingat bahwasannya `books.blade.php` merupakan gabungan dari nama file dan ekstensi file :
- `books` : nama file
- `blade.php` : ekstensi file  

Untuk menampilkan view, pada method `view()` cukup menuliskan nama filenya sebagai argumen. dalam contoh ini misalnya `'books'`. Sekarang, kita coba kembali mengakses `localhost:8000/book`, maka akan muncul tampilan dari file view `books.blade.php` yang sudah kita buat sebelumnya.
![alt text](https://i.ibb.co/Qpz2SFk/Capture.jpg)

## Menampilkan Data dari Controller
Function `view()` merupakan function bawaan laravel yang berguna untuk menampilkan tampilan dari suatu file view yang sudah kita buat. Selain memasukkan nama file, kita juga bisa menyiapkan data untuk kita kirimkan ke view. Sekarang coba perhatikan `BookController` pada method `index()` yang sudah kita buat sebelumnya. 
```
public function index(){
    	return view('books');
 }
``` 
Pada contoh kode diatas kita baru hanya menampilkan viewnya saja. Untuk mengirimkan data yang nantinya bisa ditampilkan pada view, maka kita bisa menambahkan satu argumen baru lagi sebagai berikut :
```
public function index(){
    	return view('books',[
            'namasaya' => 'Dicky Pratama'
        ]);
}
```
`'namasaya'` yang berada di sebelah kiri merupakan key untuk mengakses data, sedangkan `'Dicky Pratama'` merupakan datanya. Kita memanggil key dari dari suatu data untuk menampilkan datanya, dalam contoh ini untuk menampilkan data `'Dicky Pratama'` kita panggil keynya yaitu `'namasaya'`. Untuk memanggil key dari suatu data dalam suatu view dapat dilakukan dengan cara sebagai berikut :  
```
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Buku</title>
</head>
<body>

    <h2>Kumpulan Buku Terbaik</h2>
    <marquee>Membaca adalah jendela dunia</marquee>

    <ol>
        <li>Meditation - Marcus Aurelius</li>
        <li>Machine Learning for Beginner - Chris Sebastian</li>
        <li>Mindset - Carol Dwek</li>
        <li>Ego is The Enemy - Ryan Holiday</li>
        <li>Atomic Habit - James Clear</li>
    </ol>

    <h4>Situs web ini dibuat oleh : {{ $namasaya }}</h4>
    
</body>
</html>
```
Sekarang kita coba akses kembali `localhost:8000/book` maka akan tampil data yang sudah kita buat dicontroller
![alt text](https://i.ibb.co/nnT0Rqy/Capture.jpg)

## Menampilkan Data Array dari Controller
Sebelumnya kita telah menggunakan sebuah key untuk menampilkan sebuah data pada view kita. Kita juga bisa menggunakan sebuah key untuk mengakses banyak data sekaligus. Biasanya data ini berbentuk array atau kumpulan data. Sekarang kita buka kembali file `BookController` kita lalu pada function `index()` kita tambahkan kode sebagai berikut :
```
public function index(){
        $comics = [
            "Naruto - Masashi Kishimoto",
            "One Piece - Eichiro Oda",
            "Dragon Ball Super - Akira Toriyama",
            "Vinland Saga - Makoto Yukimura",
            "Doraemon - Fujio F. Fujiko"
        ];

    	return view('books',[
            'namasaya' => 'Dicky Pratama',
            'comics' => $comics
        ]);
}
```
Tak seperti data `'Dicky Pratama'` yang bisa langsung kita akses dengan memanggil key `namasaya`, kita tidak bisa mengakses data array `comics` ini secara langsung, tetapi harus dipecah-pecah terlebih dahulu dengan perulangan sebagai berikut : 

```
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Buku</title>
</head>
<body>
    <h2>Kumpulan Buku Terbaik</h2>
    <marquee>Membaca adalah jendela dunia</marquee>

    <ol>
        <li>Meditation - Marcus Aurelius</li>
        <li>Machine Learning for Beginner - Chris Sebastian</li>
        <li>Mindset - Carol Dwek</li>
        <li>Ego is The Enemy - Ryan Holiday</li>
        <li>Atomic Habit - James Clear</li>
    </ol>

    <h2>Kumpulan Buku Komik Terbaik</h2>
    <ol>
        @foreach ($comics as $comic)
            <li>{{ $comic }}</li>
        @endforeach
    </ol>

    <h4>Situs web ini dibuat oleh : {{ $namasaya }}</h4>
    
</body>
</html>
```

`@foreach` menandakan bahwa kita akan melakukan perulangan sebanyak data yang ada di `$comics` karena terdapat lima data maka akan terjadi lima kali perulangan, sedangkan `$comic` akan mewakili tiap-tiap data yang ada pada array `$comics`. Sekarang kita coba akses kembali route `/book` kembali, buka `localhost:8000/book` pada browser, maka kumpulan data-data komik yang sudah kita buat pada controller akan tampil seperti berikut :

![alt text](https://i.ibb.co/BCRq8JW/Capture.jpg)



