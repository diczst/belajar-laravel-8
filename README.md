# Belajar Laravel Part 10 : Menerapkan Bootstrap

## Bootstrap
Bootstrap adalah framework css yang sangat populer digunakan untuk mengembangkan aplikasi web. Bootstrap akan sangat membantu kita dalam mendesain tampilkan web atau sistem yang kita buat.

Untuk menerapkan bootstrap silahkan ubah beberapa bagian kode di file view `index.blade.php` menjadi seperti berikut :
```
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <h3>Data Buku</h3>

                <a class="btn btn-primary" id="myBtn" href="#"> + Tambah Buku Baru</a>

                <br />
                <br />

                <form class="row" action="/buku/search" method="GET">
                    <div class="col">
                        <input class="form-control" type="text" name="search" placeholder="Cari Buku .." value="{{ old('search') }}">
                    </div>
                    <div class="col">
                        <input class="btn btn-primary" type="submit" value="Cari">
                    </div>
                </form>

                <br />

                <table class="table table-bordered">
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
                                <a class="btn btn-primary btn-sm" href="/buku/edit/{{ $book->id }}">Ubah</a>
                                <a class="btn btn-danger btn-sm" href="/buku/destroy/{{ $book->id }}">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <br />

                Halaman : {{ $books->currentPage() }} <br />
                Jumlah Data : {{ $books->total() }} <br />
                Data Per Halaman : {{ $books->perPage() }} <br />

                <br />

                {{ $books->links() }}
            </div>
        </div>
    </div>



    {{-- modal --}}
    <div id="myModal" class="modal">
        <div class="modal-dialog">
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
    </div>

    <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>
```

Untuk menandakan bahwa kita sudah menerapkan bootstrap ke dalam tampilan sistem kita, maka kita menggunakan css eksternal bootstrap secara online : 
```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
```

Sekarang coba buka kembali halaman utama, seharusnya sekarang tampilan aplikasi kita sudah berubah, tetapi navigasi pagination menjadi sangat besar, sehingga tidak sesuai dengan harapan. Untuk memperbaiki ini silakan buka `app\Providers\AppServiceProvider.php` lalu tambahkan `Paginator::useBootstrap();` pada function `bootO`.
```
public function boot() {
        Paginator::useBootstrap();
}
```
Untuk menerapkan bootstrap pada tiap elemen html maka kita perlu menambahkan class yang sudah disediakan oleh bootstrap. Untuk penjelasan detail terkait class bootstrap dapat dilihat lebih rinci pada halaman dokumentasi bootstrap pada bagian `Links`

Sekarang sistem kita sudah menerapkan framework css Bootstrap untuk mendesain tampilan :
![alt text](https://i.ibb.co/j6xtbLh/image.png)

## Links
https://getbootstrap.com/docs/5.0/getting-started/introduction/

