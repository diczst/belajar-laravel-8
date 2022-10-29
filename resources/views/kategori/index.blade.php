<!DOCTYPE html>
<html>
<head>
	<title>Eloquent</title>
</head>
<body>
 
<h1>Data Kategori</h1>
 
<ul>
	@foreach($kategoris as $kategori)
		<li>{{ "Kategori : ". $kategori->nama}}</li>
	@endforeach
</ul>
 
</body>
</html>