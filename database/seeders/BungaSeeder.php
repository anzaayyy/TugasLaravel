<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BungaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bungas')->insert([
            'nama'=>'mawar',
            'warna'=>'merah',
            'jenis'=>'hias',
            'tinggi'=>30,
            'harga'=>40000,
            'jumlah'=>8,
        ]);
    }
}
