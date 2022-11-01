# Belajar Laravel Part 16 : Eloquent Relationship - One to Many
Sebelumnya kita telah menerapkan relasi one to one menggunakan eloquent. Dalam kasus kita sebelumnya satu buah buku hanya dapat memiliki satu ISBN oleh sebab itu relasi yang dibuat adalah one to one. Pada materi kali ini kita akan menerapkan relasi one to many menggunakan eloquent. Dalam kasus kali ini kita membutuhkan tabel baru yaitu tabel `ulasan`. Tabel `buku` akan memiliki relasi one to many dengan tabel `ulasan`, sehingga dapat disimpulkan bahwa satu `buku` bisa memiliki banyak `ulasan`.

## Relasi One to Many dengan Eloquent
Sebelumnya kita perlu menambahkan satu kolom lagi pada tabel buku yaitu kolom `ulasan_id` ketikkan kode sebagai berikut:
```
public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('isbn_id')->unsigned();
            $table->foreign('isbn_id')->references('id')->on('isbn');

            $table->bigInteger('ulasan_id')->unsigned();
            $table->foreign('ulasan_id')->references('id')->on('ulasan');

            $table->string('judul');
        });
    }
```
Selanjutnya kita perlu membuat tabel baru yaitu tabel `ulasan`. Ketikkan perintah
```
php artisan make:migration create_ulasan_table
```
Selanjutnya akan ada file migration baru yang berhasil dibuat. Tambahkan kode sebagai berikut:
```
public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('buku_id')->unsigned();
            $table->foreign('buku_id')->references('id')->on('buku');
            
            $table->string('nama');
            $table->text('ulasan');
        });
    }
```
<hr>
`Catatan` (Boleh diabaikan)  
 Namun, Perlu diingat bahwasannya urutan nama migration sangat penting sebelum menjalankan migration. Misalnya pada file migration `2022_11_01_135016_create_ulasan_table` kita membuat sebuah foreign key yang reference keynya berasal dari tabel buku
 ```
 $table->bigInteger('buku_id')->unsigned();
 $table->foreign('buku_id')->references('id')->on('buku');
 ```
Ini berarti file migrasi buku harus berada diatas file migrasi ulasan seperti berikut:
![img alt](https://i.ibb.co/3kPfKgZ/image.png)

Urutan file dapat diatur dengan mudah dengan merubah penomoran nama file misalnya jika ingin file migrasi `2022_11_01_135016_create_ulasan_table` berada diatas file migrasi `2022_10_30_170826_create_buku_table` maka ubah saja
```
2022_11_01_135016_create_ulasan_table
```
menjadi
```
2022_10_30_135016_create_ulasan_table
```
karena `10_30_135016` lebih kecil dari `10_30_170826`  
<hr>


Selanjutnya kita jalankan migration ulang
```
php artisan migrate:fresh
```
Sekarang data-data di database kita sudah fresh dan terdapat kolom baru pada tabel buku yaitu kolom ulasan.

Dalam eloquent, tabel direpresentasikan oleh sebuah model. Oleh sebab itu, kita perlu membuat model baru untuk mewakilkan tabel ulasan yang sudah kita buat.
```
php artisan make:model Ulasan
```
Sekarang kita sudah punya model ulasan. Selanjutnya pada model ulasan tambahkan kode sebagai berikut:
```
class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function buku(){
        return $this->belongsTo(Buku::class);
    }
}
```
Selanjutnya pada model buku, tambahkan kode sebagai berikut:
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

    public function ulasan(){
        return $this->hasMany(Ulasan::class);
    }
}
```
Terakhir tambahkan kode sebagai berikut pada view kita `index.blade.php`
```
<!DOCTYPE html>
<html>
<head>
	<title>Eloquent One to Many</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
 
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h5 class="text-center">Eloquent One To Many Relationship</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Judul</th>
							<th>ISBN</th>
							<th>Ulasan</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bukus as $buku)
						<tr>
							<td>{{ $buku->judul }}</td>
							<td>{{ $buku->isbn->nomor }}</td>
							<td>
								@foreach($buku->ulasans as $ulasan)
								   	-{{$ulasan->ulasan}} <small>({{$ulasan->nama}})</small> <br>
								@endforeach
							</td>
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
Berikut adalah tampilan tabel kita, dimana satu buku bisa memiliki banyak ulasan. Oleh sebab itu tabel `buku` memiliki relasi one to many dengan tabel `ulasan`.
![alt text](https://i.ibb.co/Xx0bQSt/image.png)




## Link
https://laravel.com/docs/8.x/eloquent
https://laravel.com/docs/8.x/eloquent-relationships




