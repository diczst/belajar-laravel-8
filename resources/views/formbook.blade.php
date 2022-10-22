<!DOCTYPE html>
<html lang="en">
<head>
    <title>Buku Favorit</title>
</head>
<body>
	<h2>Buku Favorit</h2>
    <form action="/formbook/show" method="post">
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
      
      	Nama Buku :
		<input type="text" name="nama"> <br/>
		Penulis :
		<input type="text" name="penulis"> <br/>
		<input type="submit" value="Simpan">
	</form>
</body>
</html>