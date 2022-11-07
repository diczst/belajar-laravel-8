<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // data-data buku untuk seeder
        Buku::create([
            'judul' => "Mindset",
            'kategori_id' => 1,
            'jumlah' => 10,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Sabda Zarathustra",
            'kategori_id' => 2,
            'jumlah' => 10,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Ego is the Enemy",
            'kategori_id' => 1,
            'jumlah' => 10,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "The Stranger",
            'kategori_id' => 2,
            'jumlah' => 20,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Will to Power",
            'kategori_id' => 2,
            'jumlah' => 10,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Madilog",
            'kategori_id' => 2,
            'jumlah' => 40,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Indonesia Menggugat",
            'kategori_id' => 1,
            'jumlah' => 10,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Genealogy of Morality",
            'kategori_id' => 2,
            'jumlah' => 10,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Lahirnya Tragedi",
            'kategori_id' => 2,
            'jumlah' => 10,
            'gambar'=>""
        ]);

        Buku::create([
            'judul' => "Mitos Sisifus",
            'kategori_id' => 2,
            'jumlah' => 10,
            'gambar'=>""
        ]);
    }

    
}
