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
