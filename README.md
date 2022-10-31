# Belajar Laravel Part 15 : Eloquent Relationship - One to One
Seringkali database kita memiliki beberapa table yang saling berrelasi. Misalnya sebuah buku memiliki isbn, ini berarti berarti tabel buku berrelasi dengan tabel isbn. Fitur eloquent dalam laravel memungkinkan kita dengan mudah mengatur hubungan atau relasi antar tabel dengan lebih mudah. Berikut adalah jenis-jenis relasi dasar:
- One to One
- One to Many
- Many to Many  

Pada materi kali ini kita akan menerapkan relasi One to One dengan menggunakan eloquent. Pertama-tama yang harus dilakukan adalah membuat file migration untuk membuat tabel baru.

## Membuat File Migration dan Tabel
Membuat file migration untuk tabel isbn
```
php artisan make:migration create_isbn_table
```
Membuat file migration untuk tabel buku
```
php artisan make:migration create_buku_table
```
Catatan : `Urutan pembuatan file migration harus sangat diperhatikan`. Pada kasus ini file migration isbn harus dibuat terlebih dahulu karena table buku memiliki ketergantungan dengan isbn. Jika membuat file migration untuk tabel buku terlebih dahulu, maka dipastikan akan error saat menjalankan perintah migration.

Selanjutnya pada masing-masing file migration tambahkan kode sebagai berikut:

Pada file migration untuk tabel buku :
```
public function up()
{
        Schema::create('buku', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('isbn_id')->unsigned();
            $table->foreign('isbn_id')->references('id')->on('isbn');

            $table->string('judul');
        });
}
```
Pada file migration untuk table isbn:
```
Schema::create('isbn', function (Blueprint $table) {
            $table->id();
            $table->string('name');
});
```
Selanjutnya jalankan migration dengan perintah:
```
php artisan migrate
```
catatan : jika kamu sudah memiliki table-table, maka gunakan `php artisan migrate:fresh` untuk mereset ulang tabel-tabel yang ada pada database.

## Relasi One to One Dengan Eloquent
Untuk menggunakan eloquent maka kita perlu membuat model untuk mewakili tabel-tabel yang sudah kita miliki pada database.  
Membuat model isbn
```
php artisan make:model isbn
```
Membuat model buku
```
php artisan make:model Buku
```
Selanjutnya pada model isbn tambahkan kode sebagai berikut:
```
class Isbn extends Model
{
    use HasFactory;

    protected $table = 'isbn';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function buku(){
        return $this->hasOne(Buku::class);
    }
}
```
Perhatikan pada function `buku()`. Function ini berarti tabel isbn memiliki relasi dengan tabel buku dengan rincian satu isbn hanya memiliki satu buku (satu nomor isbn untuk satu buku).  
Selanjutnya pada model Buku tambahkan kode sebagai berikut:
```
class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function isbn(){
        return $this->belongsTo(Isbn::class);
    }
}
```

Perhatikan pada function `isbn()`. Function ini berarti tabel buku memiliki relasi dengan tabel isbn dengan rincian satu buku hanya dimiliki oleh satu isbn saja.

Catatan : `biasanya belongsTo terdapat pada tabel yang memiliki foreign key`  

## Menampilkan Data
Untuk menampilkan data maka kita perlu membuat view terlebih dahulu. Tambahkan folder `book` di folder `resources\view`. Selanjutnya kita buat file view baru `index.blade.php`
```
<!DOCTYPE html>
<html>
<head>
	<title>Eloquent One to One</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
 
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h5 class="text-center">Eloquent One To One Relationship</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Judul</th>
							<th>ISBN</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bukus as $buku)
						<tr>
							<td>{{ $buku->judul }}</td>
							<td>{{ $buku->isbn->nomor }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
 
</body>
</html>
```
perhatikan pada `<td>{{ $buku->isbn->nomor }}</td>`. Disini kita ingin menampikan nomor isbn dari tiap-tiap data buku, tetapi data yang kita lihat di tabel adalah id dari isbn.Inilah peran dari eloquent relationship. Dengan foreign key id yang terdapat pada tabel-tabel buku kita bisa menampilkan nomornya berdasarkan id tersebut. Secara sederhana `$buku->isbn->nomor` dapat dibaca : tampilkan nomor isbn buku berdasarkan id isbn yang ada pada tiap-tiap buku.
![alt text](https://i.ibb.co/54Ms2vN/image.png)

Selanjutnya kita buat controller baru dengan menjalankan perintah:
```
php artisan make:controller BukuController
```
Pada `BukuController` buat function baru bernama index dengan kode sebagai berikut:
```
public function index(){
    	$bukus = Buku::all();
    	return view('buku.index', ['bukus' => $bukus]);
}
```
Terakhir kita buka `web.php` lalu ubah route default kita menjadi seperti berikut:
```
Route::get('/', [BukuController::class, 'index']);
```
Buka route kita `localhost:8000/` maka data-data buku di tabel buku yang berrelasi dengan tabel ISBN akan tampil:
![alt text](https://i.ibb.co/nw51h3c/image.png)
Dapat dilihat bahwa yang tampil bukan id ISBN melainkan nomor dari ISBN.

## Link
https://laravel.com/docs/8.x/eloquent
https://laravel.com/docs/8.x/eloquent-relationships




