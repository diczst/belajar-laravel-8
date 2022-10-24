<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
</head>
<body>
 
	<h3>Data Buku</h3>
 
	<a href="#"> + Tambah Buku Baru</a>
	
	<br/>
	<br/>
 
	<table border="1">
		<tr>
			<th>Judul</th>
			<th>Kategori</th>
			<th>Jumlah</th>
			<th>Aksi</th>
		</tr>
		@foreach($books as $book)
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
 
 
</body>
</html>