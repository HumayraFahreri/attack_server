<?php

namespace Database\Seeders;

use App\Models\DosType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DosType::create(['name' => 'ICMP Flood', 'is_custom' => false]);
        DosType::create(['name' => 'UDP Flood', 'is_custom' => false]);
        DosType::create(['name' => 'TCP Flood', 'is_custom' => false]);
    }
}
