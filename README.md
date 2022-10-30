# Belajar Laravel Part 14 : CRUD Eloquent

## CRUD Eloquent 
Sebelumnya kita telah belajar menampilkan data menggunakan laravel eloquent. Pada materi ini kita akan melanjutkan fitur Create, Update, dan Delete menggunakan eloquent.

## Memperbaiki View dan Menampilkan Data dengan Pagination 
Sebelumnya kita perlu memperbaiki view `index.blade.php` pada folder `kategori` untuk menampilkan data-data kita.
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

                <h3>Data Kategori</h3>

                <a class="btn btn-primary" id="myBtn" href="#"> + Tambah Kategori Baru</a>

                <br />
                <br />

                <form class="row" action="/kategori/search" method="GET">
                    <div class="col">
                        <input class="form-control" type="text" name="search" placeholder="Cari Kategori .."
                            value="{{ old('search') }}">
                    </div>
                    <div class="col">
                        <input class="btn btn-primary" type="submit" value="Cari">
                    </div>
                </form>

                <br />

                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($kategoris as $kategori)
                        <tr>
                            <td>{{ $kategori->nama }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/kategori/edit/{{ $kategori->id }}">Ubah</a>
                                <a class="btn btn-danger btn-sm" href="/kategori/destroy/{{ $kategori->id }}">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <br />

                Halaman : {{ $kategoris->currentPage() }} <br />
                Jumlah Data : {{ $kategoris->total() }} <br />
                Data Per Halaman : {{ $kategoris->perPage() }} <br />

                <br />

                {{ $kategoris->links() }}
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div id="myModal" class="modal">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Tambah Kategori Baru</h2>
                <form action="/kategori/store" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama : </label>
                        <input class="form-control" type="text" name="nama" value="{{ old('nama') }}">
                        @error('nama')
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
Saat kita coba membuka route `localhost:8000/kategori` maka akan mancul error. Hal ini karena kita belum memanggil paginate() saat mengakses function seperti `$kategoris->currentPage()`. Untuk memperbaiki masalah ini, maka kita buka kembali `KategoriController` lalu kita ubah function `get()` menjadi function `paginate()` sebagai berikut:
```
public function index()
    {
        // mengambil semua data kategori
    	$kategoris = Kategori::paginate();
 
    	// mengirim data-data kategori ke view kategori
    	return view('kategori.index', ['kategoris' => $kategoris]);
    }
```
Buka kembali route `localhost:8000/kategori` maka data kategori yang sudah kita buat pada database akan muncul.
![alt text](https://i.ibb.co/484Wxqs/image.png)

## Create dengan Eloquent
Selanjutnya kita akan membuat fitur create data dengan eloquent. Pertama-tama kita buka kembali `KategoriController` lalu pada function `store()` tambahkan kode sebagai berikut:
```
public function store(Request $request)
    {
        $this->validate($request,[
    		'nama' => 'required',
    	]);
 
        Kategori::create([
    		'nama' => $request->nama,
    	]);
 
    	return redirect('/kategori');
    }
```
Selanjutnya kita tambahkan controller baru untuk menambahkan data kategori :
```
Route::post('/kategori/store',[KategoriController::class, 'store']);
```
Pada eloquent secara default, kita tidak bisa mengisi semua data yang ada pada kolom (Mass Assignment). Oleh sebab itu kita harus menambahkan `protected $guarded =[];` pada model kategori kita. Guarded berarti kita membolehkan semua data diinputkan ke dalam kolom yang ada di tabel kita kecuali nama kolom yang menjadi elemen dari `$guarded`. Dalam contoh ini kita dapat mengisi data pada kolom kategori, tetapi kolom id tidak dapat diisi (id bersifat autoincrement atau secara otomatis ditambahkan).
```
    protected $guarded = ['id'];
```
Selanjutnya apabila kita coba tambahkan data maka akan muncul error dari Laravel:
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'updated_at' in 'field list' (SQL: insert into `kategori` (`nama`, `updated_at`, `created_at`) values (Pertanian, 2022-10-29 18:12:40, 2022-10-29 18:12:40))
```
Ini karena eloquent secara default mengasumsikan bahwa tabel kita memiliki kolom `updated_at` dan `created_at`. Biasanya dua kolom ini tergenerate dari function `timestamps()` yang kita definisikan di file migrations. Sebelumnya kita tidak menyertakan `timestamps` pada file migration karena dirasa memang belum diperlukan. Oleh sebab itu, maka kita perlu menambahkan satu kode lagi pada model `Kategori` kita yaitu :
```
    public $timestamps = false;
```
ini untuk memberi tahu pada laravel bahwa model yang kita gunakan untuk menerapkan eloquent ini tidak memiliki kolom `created_at` dan `updated_at`.

## Update dengan Eloquent
Pertama-tama kita perlu membuat view untuk melakukan edit data. Pada folder kategori buat file baru `edit.blade.php` selanjutnya tambahkan kode sebagai berikut :
```
<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>
    <h3>Edit Kategori</h3>

    <a href="/kategori"> Kembali</a>

    <br />
    <br />

    <form action="/kategori/update" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $kategori->id }}"> <br />

        <label for="nama">Nama : </label><br>
        <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}">
        <br>
        @error('nama')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <input type="submit" value="Edit Data">
    </form>


</body>

</html>
```
Setelah membuat view kita akan menampilkannya. Buka controller `KategoriController` lalu tambahkan kode sebagai berikut:
```
 public function edit($id){
        $kategori = Kategori::find($id);
        return view('kategori.edit', ['kategori' => $kategori]);
 }
```
Selanjutnya buka `web.php` lalu kita buat route baru untuk menampilkan form edit kategori sebagai berikut:
```
Route::get('/kategori/edit/{param}',[KategoriController::class, 'edit']);
```
Selanjutnya untuk mengupdate data, kita tambahkan kode berikut ke dalam `KategoriController` :
```
public function update(Request $request) {
        $this->validate($request,[
            'nama' => 'required',
         ]);
      
         $kategori = Kategori::find($request->id);
         $kategori->nama = $request->nama;
         $kategori->save();
         return redirect('/kategori');
}
```
Terakhir, buka `web.php` lalu tambahkan route untuk mengupdate data kategori sebagai berikut:
```
Route::post('/kategori/update', [KategoriController::class, 'update']);
```

## Menghapus Data dengan Eloquent
Untuk menghapus data, pertama kita buka `KategoriController` lalu pada method destroy, kita tambahkan kode sebagai berikut:
```
public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect('/kategori');
    }
```
Selanjutnya kita tambahkan route untuk menghapus data sebagai berikut:
```
Route::get('/kategori/destroy/{param}', [KategoriController::class, 'destroy']);
```
Cobalah hapus salah satu berhasil. Jika data sudah menghilang, maka proses penghapusan data kita sudah berhasil.

## Links
- https://laravel.com/docs/8.x/eloquent

