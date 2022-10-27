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

	<form action="/buku/search" method="GET">
		<input type="text" name="search" placeholder="Cari Buku .." value="{{ old('search') }}">
		<input type="submit" value="Cari">
	</form>

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
                    <a href="/buku/edit/{{ $book->id }}">Ubah</a>
                    |
                    <a href="/buku/destroy/{{ $book->id }}">Hapus</a>
                </td>
            </tr>
        @endforeach
    </table>

    <br/>
    
	Halaman : {{ $books->currentPage() }} <br/>
	Jumlah Data : {{ $books->total() }} <br/>
	Data Per Halaman : {{ $books->perPage() }} <br/>

    <br/>

    {{ $books->links() }}

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

    <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>
