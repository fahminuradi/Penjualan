<?php

use Illuminate\Database\Seeder;

class Kategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = new \App\Kategori;
        $kategori->kategori = "budi";
        $kategori->gambar_kategori = "Budi Santoso";
        $kategori->save();
    }
}
