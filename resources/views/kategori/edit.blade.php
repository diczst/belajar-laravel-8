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
