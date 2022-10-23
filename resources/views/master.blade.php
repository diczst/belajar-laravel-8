<html>

<head>
    <title>{{ $title }}</title>
</head>

<body>

    <header>

        <h2>Situs Biografi Saya</h2>
        <nav>
            <a href="/home">Home</a>
            |
            <a href="/contact">Kontak Saya</a>
            |
            <a href="/about">Tentang Saya</a>

        </nav>
    </header>
    <hr />

    <!-- bagian konten -->
    @yield('content')

    <hr />
    <footer>
        <p>&copy; 2022 Dicky Pratama</p>
    </footer>

</body>

</html>
