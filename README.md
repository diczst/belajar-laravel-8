# Belajar Laravel Part 16 : Eloquent Relationship - Many to Many
Pada materi sebelumnya kita menerapkan sudah menerapkan relasi one to many menggunakan eloquent. 
Pada materi kali ini kita akan menerapkan relasi many to many dengan menggunakan relationship.
Untuk menerapkan relasi many to many, kita membutuhkan sebuah tabel baru untuk menghubungkan dua tabel yang saling berrelasi. Dalam kasus ini tabel `users` memiliki relasi many to many dengan tabel `buku` dengan tabel penghubungnya adalah tabel `buku_user`.

Catatan :  
secara default laravel dapat mengetahui bahwa tabel `buku_user` merupakan tabel yang menghubungkan tabel `buku` dan tabel `users` karena memiliki relasi many-to-many. Perlu diperhatikan juga bahwa laravel akan mengurutkan namanya berdasarkan abjad oleh karena itu nama tabel penghubungnya bukan `user_buku` melainkan `buku_user`.  Perhatikan juga, nama tabel yang kita miliki adalah `users` bukankah seharusnya tabel penghubungnya menjadi `buku_users`? 

Nama yang digunakan  dibuat berdasarkan nama class model yang yaitu class model `Buku` dan class model `User`.

Pertama-tama kita buat file migration baru untuk membuat tabel baru yang menghubungkan tabel `buku` dan tabel `users` : 
```
php artisan make:migration create_buku_user_table
```
Selanjutnya tambahkan kode sebagai berikut pada file migration buku_user:
```
public function up()
    {
        Schema::create('buku_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('buku_id')->unsigned();
            $table->foreign('buku_id')->references('id')->on('buku');

            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');

        });
    }
```
Jalankan file migration baru yang sudah dibuat sebelumnya
```
php artisan migrate
```

Buka class mdel `Buku` lalu tambahkan function baru sebagai berikut:
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

    // menambahkan s berarti jamak (hasMany = memiliki banyak)
    public function ulasans(){
        return $this->hasMany(Ulasan::class);
    }

    public function users(){
    	return $this->belongsToMany(User::class);
    }
}
```
Sedangkan pada model `User` tambahkan function baru sebagai berikut:
```
public function bukus(){
    	return $this->belongsToMany(Buku::class);
}
```

Terakhir, buka `index.blade.php` lalu tambahkan kode sebagai berikut:
```
<!DOCTYPE html>
<html>

<head>
    <title>Eloquent One to Many</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">Eloquent Many To Many Relationship</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>ISBN</th>
                            <th>Ulasan</th>
							<th>Peminjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $buku)
                            <tr>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->isbn->nomor }}</td>
                                <td>
                                    <ul>
                                        @foreach ($buku->ulasans as $ulasan)
                                            <li>
                                                {{ $ulasan->ulasan }} <small>({{ $ulasan->nama }})</small>
                                            </li>
                                        @endforeach

                                    </ul>

                                </td>

								<td>
                                    <ul>
                                        @foreach ($buku->users as $user)
                                            <li>
                                                {{ $user->name }}
                                            </li>
                                        @endforeach

                                    </ul>

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
Buka kembali halaman utama kita, maka data-data yang ada di tabel `buku_user` akan muncul
![alt text](https://i.ibb.co/Qc3zKKB/image.png)


## Link
- https://laravel.com/docs/8.x/eloquent
- https://laravel.com/docs/8.x/eloquent-relationships




