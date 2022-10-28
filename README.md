# Belajar Laravel Part 11 : Validasi Form

## Validasi Form
Sebelumnya kita telah membuat form untuk menambahkan data dan mengubah data. Bagaimana apabila pada form yang kita sediakan, user tidak mengisi data dan langsung menekan tombol tambah data? Maka akan terdapat dua kemungkinan yang akan terjadi. Pertama data tersebut berhasil ditambahkan ke database, tetapi data yang ditambahkan itu kosong karena kolom bersifat nullable (dapat dikosongkan). Kedua akan terjadi error pada sistem apabila data yang tidak diisi tersebut pada database kolomnya bersifat not null (tidak boleh kosong).

Untuk mengatasi hal ini maka kita memerlukan fitur validasi. Validasi akan mencegah user melakukan tindakan tertentu seperti mengosongkan data atau memasukkan data yang tidak sesuai tipenya (misalnya data yang seharusnya angka, input yang diberikan user string) dan sebagainya.

Kita akan menggunakan validasi yang disediakan oleh laravel, maka pertama-tama kita hapus terlebih dahulu required yang ada pada form tambah data buku yang sudah kita buat sebelumnya menjadi sebagai berikut :
```
{{-- modal --}}
    <div id="myModal" class="modal">
        <div class="modal-dialog">
            <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Buku Baru</h2>
            <form action="/buku/store" method="post">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul : </label>
                    <input class="form-control" type="text" name="judul">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori : </label>
                     <input class="form-control" type="text" name="kategori">
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah : </label>
                    <input class="form-control" type="text" name="jumlah">
                </div>

                <br>

                <input class="btn btn-primary" type="submit" value="Tambah Data">
            </form>
        </div>
        </div>
    </div>
```
Required bawaan sudah dihapus. Selanjutnya kita tambahkan kode sebagai berikut pada `BookController`
```
public function store(Request $request){
        $this->validate($request,[
            'judul' => 'required|min:3|max:20',
            'kategori' => 'required',
            'jumlah' => 'required|numeric'
         ], [
            'judul.required' => "Judul wajib diisi"
         ]);
  
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
Untuk mengkustomisasi pesan error default, maka berikan argumen ketiga berupa array. Satu elemen array merupakan sebuah pasangan key value. Untuk key-nya dapat diisi dengan format `namarequest.jenisvalidasi` seperti `judul.required` lalu untuk messagenya berupa string seperti pada kode diatas valuenya adalah `"Judul wajib diisi"`


Selanjutnya kita buka kembali `index.blade.php` lalu tambahkan kode sebagai berikut:
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
                        <input class="form-control" type="text" name="search" placeholder="Cari Buku .."
                            value="{{ old('search') }}">
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
                    <div class="form-group">
                        <label for="judul">Judul : </label>
                        <input class="form-control" type="text" name="judul" value="{{ old('judul') }}">
                        @error('judul')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori : </label>
                        <input class="form-control" type="text" name="kategori" value="{{ old('kategori') }}">
                        @error('kategori')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah : </label>
                        <input class="form-control" type="text" name="jumlah" value="{{ old('jumlah') }}">
                        @error('jumlah')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <br>

                    <input class="btn btn-primary" type="submit" value="Tambah Data">
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>
```
Untuk menampilkan pesan error dari validasi, kita menggunakan `@error blade directive` yang akan menampilkan error sesuai dengan jenis validasi yang sudah ditentukan di controller. Adapun sintaks error blade directive adalah sebagai berikut `@error('namarequest') {{ $message }} @enderror`.

Untuk mengetahui berbagai `validation rules` atau aturan validasi, silakan mengunjungi link yang sudah disediakan di bawah.


## Links
- https://getbootstrap.com/docs/5.0/getting-started/introduction/
- https://laravel.com/docs/8.x/validation#main-content

