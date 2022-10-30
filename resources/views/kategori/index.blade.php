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
