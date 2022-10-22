<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Buku</title>
</head>
<body>

    <h2>Kumpulan Buku Terbaik</h2>
    <marquee>Membaca adalah jendela dunia</marquee>

    <ol>
        <li>Meditation - Marcus Aurelius</li>
        <li>Machine Learning for Beginner - Chris Sebastian</li>
        <li>Mindset - Carol Dwek</li>
        <li>Ego is The Enemy - Ryan Holiday</li>
        <li>Atomic Habit - James Clear</li>
    </ol>

    <h2>Kumpulan Buku Komik Terbaik</h2>
    <ol>
        @foreach ($comics as $comic)
            <li>{{ $comic }}</li>
        @endforeach
    </ol>

    <h4>Situs web ini dibuat oleh : {{ $namasaya }}</h4>
    
</body>
</html>