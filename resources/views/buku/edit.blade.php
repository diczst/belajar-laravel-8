<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <h3>Edit Buku</h3>

    <a href="/"> Kembali</a>

    <br />
    <br />

    <h2>Tambah Buku Baru</h2>
    <form action="/buku/update" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $book->id }}"> <br/>
        
        <label for="judul">Judul : </label><br>
        <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" required> <br><br>

        <label for="kategori">Kategori : </label><br>
        <input type="text" name="kategori" value="{{ old('kategori', $book->kategori) }}" required> <br><br>

        <label for="jumlah">Jumlah : </label><br>
        <input type="text" name="jumlah" value="{{ old('jumlah', $book->jumlah) }}" required> <br><br>

        <input type="submit" value="Edit Data">
    </form>


</body>

</html>
