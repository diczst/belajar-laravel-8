# Belajar Laravel Part 12 : Migration

## Migration 
Migrasi merupakan fitur yang berperan sebagai version control untuk database pada sistem kita. Migrasi memungkinkan kita untuk berbagi skema database aplikasi kita kepada orang lain. Migrasi akan sangat banyak berguna. Misalnya pada kasus apabila ada kolom baru yang ditambahkan ke database, tim kita yang melakukan pull dari github dapat melakukan migrate untuk menambahkannya, sehingga tidak perlu menambahkan atau mengkonfigurasinya secara manual di local databasenya. Migrate juga mempermudah kita dalam proses pembuatan skema database yaitu table dan kolom.

## Membuat File Migration
Untuk membuat file migration, kita dapat memberikan command seperti berikut pada cmd :
```
php artisan make:migration create_kategori_table
```
Maka Laravel akan membuat file migration baru yang terletak di `database\migrations` dalam contoh ini file migration yang dibuat oleh laravel bernama `2022_10_29_025340_create_kategori_table.php` dengan kode sebagai berikut :
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
```
Function `up()` digunakan untuk menjalankan migration. `Schema::create()` berarti kita ingin membuat sebuah tabel baru dalam database kita. Dalam body function create() kita bisa memasukkan kolom-kolom yang kita butuhkan dalam table seperti kolom id dengan mengetikkan `$table->id()` dan `$table->timestamps()` untuk tanggal data diinput. Dalam contoh ini kita akan membuat tabel `kategori` dengan kolom-kolomnya adalah `id` dan `nama` untuk nama kategori. Maka kode pada file migration kita akan menjadi seperti berikut :
```
 public function up() {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
        });
}
```
Sedangkan Function `down()` akan dijalankan apabila kita memberikan perintah `php artisan migrate:rollback`atau kembali pada keadaan sebelum kita melakukan migration terbaru, dalam kasus ini tabel kategori akan hilang apabila kita melakukan rollback.

## Menjalankan File Migration
Sekarang kita sudah memiliki sebuah file migration. Selanjutnya kita bisa menjalankan file migration yang kita miliki dengan perintah sebagai berikut :
```
php artisan migrate
```
Maka pada database, kita akan melihat banyak table baru yang dibuat secara otomatis. Tabel-tabel baru  seperti `password_resets`, `personal_accesss_token` berasal dari file migration bawaan yang sudah disediakan oleh Laravel, boleh dihapus saja jika memang dirasa tidak diperlukan.
![alt text](https://i.ibb.co/Zd2nbnS/image.png)
Untuk mengembalikan database ke keadaan sebelumnya kita dapat menggunakan perintah
```
php artisan migrate:rollback
```
![alt text](https://i.ibb.co/Yfcw5J6/image.png)
atau untuk mengembalikan database keadaan beberapa langkah sebelumnya dapat menggunakan kode:
```
php artisan migrate:rollback --step=5
```
Untuk mengembalikan database kembali pada keadaan awal dapat menggunakan perintah:
```
php artisan migrate:fresh
```
Tabel migrations akan tetap ada untuk memantau migrasi yang kita lakukan pada database.

## Links
- https://laravel.com/docs/8.x/migrations

