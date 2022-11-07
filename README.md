# Belajar Laravel Part 19 : Sistem Informasi Perpustakaan Sederhana

Pada materi-materi sebelumnya kita telah mempelajari dasar-dasar yang diperlukan untuk membuat sebuah sistem informasi pada Laravel. Pada materi kali ini, kita akan menerapkan semua dasar-dasar yang sudah kita pelajari untuk membuat suatu sistem informasi sederhana, selain itu kita juga akan menambah atau belajar membuat beberapa fitur baru seperti fitur `upload gambar`. Pertama-tama kita perlu membuat beberapa tabel menggunakan migration.
```
php artisan make:migration create_kategori_table   
```

```
public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
        });
    }
```
```
php artisan make:migration create_buku_table   
```
```
public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();

            $table->string('judul');

            $table->bigInteger('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('kategori');

            $table->integer('jumlah');
            $table->string('gambar')->nullable();
        });
    }
```

```
php artisan migrate:fresh
```

## Integrasi Template SB Admin 2
Silahkan merujuk pada 
- https://github.com/dzuerst/belajar-laravel8/tree/integration-sbadmin2-template
- https://github.com/dzuerst/belajar-laravel8/tree/06-blade-templates

untuk mereview kembali cara mengintegrasikan template sb admin 2 pada laravel dengan menggunakan blade template.

```
php artisan make:controller BukuController --resource
```

```
php artisan make:model Buku
```

Menjalankan seeder
```
php artisan db:seed
```

```
php artisan make:model Kategori
```

di AppServiceProvider untuk fix bug tampilan pagination bootstrap
```
public function boot()
    {
        Paginator::useBootstrap();
    }
```

Mengganti default route setelah login berhasil / gagal. Buka class `RouteServiceProvider`
ubah

```
public const HOME = '/home';
```
menjadi
```
public const HOME = '/';
```


## Fitur Upload Gambar
Buka `.env` tambahkan kode sebagai berikut
```
FILESYSTEM_DRIVER=public
```

jangan lupa menambahkan 
```
enctype="multipart/form-data"
```
pada form kita


Untuk menampilkan gambar yang sudah diupload saat ingin mengubah data
```
php artisan storage:link
```

## Mempertahankan input saat input tidak valid
```
value="{{ old('jumlah') }}
```
Pada function `store` pada bagian controller tambahkan method `withInput()`:
```
return redirect('/')->withInput();
```

## Menampilkan Alert dengan SweetAlert

```
composer require realrashid/sweet-alert 
```

Publish untuk generate asset yang dibutuhkan untuk kustomisasi alert
```
php artisan sweetalert:publish
```
## Links
- https://datatables.net/
- https://getbootstrap.com/docs/4.6/getting-started/introduction/
- https://realrashid.github.io/sweet-alert/install
- https://alfinchandra4.medium.com/catatan-laravel-sweetalert-2-c286678e23d0



