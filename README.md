# Belajar Laravel Part 7.1 : CRUD - CREATE (Menambah Data)

## Menambahkan Data ke Database (CREATE)
Pada materi sebelumnya kita telah belajar cara menampilkan data dari database. Namun, proses input atau membuat data masih kita lakukan di luar sistem yang kita buat seperti menggunakan bantuan phpmyadmin. Pada materi ini kita akan membuat fitur penambahan data pada sistem kita, agar kita dapat menambahkan data di dalam sistem yang kita buat.

Pertama-tama kita perlu membuat view baru untuk menambahkan view. Namun, agar kita tidak perlu terlalu banyak membuat file view nantinya, maka kita akan menggunakan modal. Modal sering juga disebut dengan dialog box / pop up window, sederhananya modal merupakan sebuah view yang masih merupakan bagian dari view yang lain karena kemunculannya masih bergantung dan berada pada suatu view.

Langkah pertama untuk membuat modal adalah membuat file CSS untuk mengatur tampilan modal. Sebelumnya agar lebih rapi, pada folder public kita tambahkan folder `css`. Selanjutnya kita buat new file dengan nama `style.css` dengan kode sebagai berikut :
```
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
  }
  
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
```
Langkah selanjutnya adalah menambahkan javascript untuk memunculkan modal. Seperti sebelumnya agar lebih rapi, kita buat folder baru terlebih dahulu bernama `js` selanjutnya pada folder `js` kita tambahkan file baru `modal.js` dengan kode sebagai berikut : 
```
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
```

Jika sudah, kita tambahkan kode berikut ke view yang sudah kita buat sebelumnya yaitu `index.blade.php`
```
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>CRUD</title>
</head>

<body>

    <h3>Data Buku</h3>

    <a id="myBtn" href="#"> + Tambah Buku Baru</a>

    <br />
    <br />

    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        @foreach ($books as $book)
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

    {{-- modal --}}
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Buku Baru</h2>
            <form action="/pegawai/store" method="post">
                {{ csrf_field() }}
                <label for="fname">Judul : </label><br>
                <input type="text" name="judul" required="required"> <br><br>
                
                <label for="fname">Kategori : </label><br>
                <input type="text" name="judul" required="required"> <br><br>

                <label for="fname">Jumlah : </label><br>
                <input type="text" name="judul" required="required"> <br><br>
              
                <input type="submit" value="Tambah Data">
            </form>
        </div>

    </div>

    <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>
```
Pada kode diatas di bagian tag head kita menambahkan kode file css yang sudah kita buat : 
```
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
```
Pada bagian ```<a href="#"> + Tambah Buku Baru</a>``` kita ubah menjadi
```
<a id="myBtn" href="#"> + Tambah Buku Baru</a>
```
Lalu pada akhir `</body>` kita menambahkan file `js` yang sudah kita buat :
```
<script src="{{ asset('js/modal.js') }}"></script>
```
Terakhir kita menambahkan modal yang akan kita tampilkan saat tombol `Tambah Buku Baru` ditekan:
```
{{-- modal --}}
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Buku Baru</h2>
            <form action="/buku/store" method="post">
                @csrf
                <label for="judul">Judul : </label><br>
                <input type="text" name="judul" required="required"> <br><br>
                
                <label for="kategori">Kategori : </label><br>
                <input type="text" name="kategori" required="required"> <br><br>

                <label for="jumlah">Jumlah : </label><br>
                <input type="text" name="jumlah" required="required"> <br><br>
              
                <input type="submit" value="Tambah Data">
            </form>
        </div>

    </div>
```
Pada form yang terdapat pada modal kita terdapat kode `@csrf`, sebuah kode yang merupakan bagian dari blade templates untuk mempermudah kita membuat CSRF token. Laravel memang mewajibkan setiap form yang kita buat untuk menggunakan `@csrf` untuk keamanan data. CSRF berguna untuk mencegah request atau input data yang bukan berasal dari sistem kita.

`required="required"` berarti input atau request ini wajib diisi, jika tidak diisi, maka akan tampil notifikasi yang mengingatkan pengguna untuk mengisi input tersebut.

Selanjutnya dalam modal kita, kita membuat sebuah input form dengan method `post` saat tombol tambah data ditekan maka kita akan memanggil route `/buku/store. Ingat bahwa kita belum membuat route ini, maka selanjutnya kita akan membuat route baru untuk menambahkan data ke dalam database.

Buka `web.php` tambahkan route baru dengan kode berikut :
```
Route::post('/buku/store',[BookController::class, 'store']);
```
Karena pada materi sebelumnya, saat membuat controller `BookController` kita menggunakan perintah
```
php artisan make:controller BookController --resource
```
Maka secara otomatis method store untuk menambahkan data sudah tersedia di dalam controller. Sekarang kita hanya perlu untuk menambahkan kode pada method store untuk melakukan penambahan data ke database.

Catatan :
- create : method ini digunakan untuk membuka atau menampilkan view form tambah data (membuka file view baru)
- store : method ini digunakan untuk menambahkan data saat tombol tambah data pada form ditekan.

Karena kita menggunakan modal, maka kita tidak perlu membuat view baru lagi untuk menambahkan data, oleh karena itu method create dapat diabaikan atau dihapus saja.

Selanjutnya pada method store kita tambahkan kode sebagai berikut :
```
public function store(Request $request){
        // insert data ke table buku
        DB::table('buku')->insert([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah
        ]);

	    // alihkan ke halaman utama
	    return redirect('/');
    }
```

`$request->judul` berisi nilai yang diinputkan di dalam inputan kita yaitu :
```
 <input type="text" name="judul" required="required"> <br><br>
```
`name="judul"` berarti nama input atau request ini adalah judul.

Sekarang buka kembali halaman utama `localhost:8000` sekarang kita coba tambahkan data baru. Jika berhasil maka data baru yang kita tambahkan akan tampil pada halaman utama dan juga di database kita seperti berikut : 

Penambahan data
![alt text](https://i.ibb.co/VtmVVVS/Capture.jpg)

Data tampil (berhasil ditambahkan)
![alt text](https://i.ibb.co/qdrX0TJ/Capture.jpg)

Data tampil di database (berhasil ditambahkan)
![alt text](https://i.ibb.co/4tM0fdJ/Capture.jpg)


## Link
https://laravel.com/docs/8.x/queries
https://www.w3schools.com/css/css_howto.asp
https://www.w3schools.com/tags/att_script_src.asp
https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_modal