# Belajar Laravel : Penerapan Template SB Admin 2 Dasar

## Selamat datang di branch integration-sbadmin2-template
Branch ini berfokus pada cara menerapkan template populer sbadmin2 pada aplikasi laravel

## Langkah-langkah Persiapan Sebelum Membuat Halaman Baru

1. Pertama-tama silakan ekstrak file `startbootstrap-sb-admin-2-gh-pages.zip`, ke folder `startbootstrap-sb-admin-2-gh-pages`

2. Buat folder baru bernama `assets` di folder `public`

3. Pindahkan folder `css`, `img`, `js`, dan `vendor` di folder `startbootstrap-sb-admin-2-gh-pages` ke folder `public\assets`. Sekarang terdapat empat foler baru pada `public\assets`

## Membuat Halaman Baru
1. Buat file baru `dashboard.blade.php`
2. Buka `index.html` yang ada pada folder `startbootstrap-sb-admin-2-gh-pages`. Copy semua isinya lalu paste ke `dashboard.blade.php`
3. Buka `web.php` ubah `return view('welcome');` menjadi `return view('dashboard');`
4. Coba buka `localhost:8000`. Maka dapat terlihat tampilan view masih kacau. Hal ini karena beberapa kode harus diubah terlebih dahulu alamat foldernya.
5. Ubah `href="vendor/fontawesome-free/css/all.min.css"` menjadi `href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"`
6. Ubah `href="css/sb-admin-2.min.css"` menjadi `href="{{ asset('assets/css/sb-admin-2.min.css') }}"`
7. Selanjutnya scroll ke bawah pada file `dashboard.blade.php` ubah baris-baris kode berikut :
```
<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
```
menjadi
```
<!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
```
Selanjutnya buka `localhost:8000` kembali. Apabila halaman dashboard admin sudah tampil seperti berikut:
![alt text](https://i.ibb.co/fvR4VbX/dashboard.jpg)
Maka selamat, kita sudah berhasil menerapkan template SB Admin 2 pada projek laravel kita
 
## Link SB-Admin 2
https://startbootstrap.com/theme/sb-admin-2