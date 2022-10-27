# Belajar Laravel Part 8 : Pagination

## Pagination
Sebelumnya kita telah belajar CRUD yang merupakan empat operasi dasar untuk mengelola data yang ada di database melalui sistem yang kita buat. Kita telah berhasil menampilkan data yang masih sedikit. Akan tetapi, bagaimana apabila data yang ingin kita tampilkan semakin banyak misalnya 100-200 baris data? Tentu akan semakin banyak pula data yang akan ditampilkan, tentunya hal ini tidak tepat untuk dilakukan. Hal ini dapat membuat sistem yang kita buat menjadi lambat untuk menampilkan data. Oleh karena itu, kita perlu membuat pagination. Pagination adalah suatu fitur yang berguna untuk membagi data-data kita ke dalam beberapa halaman. 

## Membuat Pagination
Sebelum kita mulai membuat fitur pagination, silahkan tambahkan lebih banyak data ke dalam database kurang lebih 20 baris data. Selanjutnya kita ubah kode pada method `index` class `BookController` menjadi seperti berikut:
```
public function index() {
    	$books = DB::table('buku')->paginate(10);
    	return view('buku.index',['books' => $books]);
}
```
Sebelumnya kita menggunakan `get()` untuk menampilkan keseluruhan data, tetapi untuk membatasi data yang akan kita tampilkan maka kita menggunakan function `paginate(n)`, n adalah jumlah data yang ingin ditampilkan per halamannya.

Selanjutnya kita tambahkan kode berikut tepat di bawah table yang kita miliki
```
         <br/>
    
        Halaman : {{ $books->currentPage() }} <br/>
        Jumlah Data : {{ $books->total() }} <br/>
	Data Per Halaman : {{ $books->perPage() }} <br/>

        <br/>

        {{ $books->links() }}
```
Dengan menggunakan function `paginate()` kita dapat menggunakan beberapa function lain yang dibutuhkan untuk melakukan pagination seperti `$books->currentPage()` untuk menampilkan halaman saat ini, lalu `$books->total()` untuk menampilkan total semua data yang ada, dan `$books->perPage()` untuk menampilkan jumlah data per halamannya.
selanjutnya setelah `<br/>` untuk membuat baris baru atau jarak, kita menambahkan `{{ $books->links() }}` yang berfungsi untuk melakukan navigasi atau perpindahan halaman untuk menampilkan data selanjutnya atau data sebelumnya.
Pagination memang lebih mudah diterapkan di Laravel karena Laravel memang telah menyediakan berbagai kode untuk memudahkan kita.

![alt text](https://i.ibb.co/ft9BLsj/image.png)
![alt text](https://i.ibb.co/GtLtZ84/image.png)


## Link
https://laravel.com/docs/8.x/queries
https://laravel.com/docs/8.x/pagination