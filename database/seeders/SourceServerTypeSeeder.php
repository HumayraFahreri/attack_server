<?php

namespace Database\Seeders;

use App\Models\SourceServerType; // <-- TAMBAHKAN BARIS INI
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceServerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SourceServerType::create(['name' => 'Zeus', 'is_custom' => false]);
        SourceServerType::create(['name' => 'Poseidon', 'is_custom' => false]);
        SourceServerType::create(['name' => 'Athena', 'is_custom' => false]);
        SourceServerType::create(['name' => 'Triton', 'is_custom' => false]);
        SourceServerType::create(['name' => 'Aphrodite', 'is_custom' => false]);
    }
}