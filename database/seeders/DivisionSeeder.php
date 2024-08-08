<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moscow = Division::create([
            'name' => 'Московское',
        ]);

        $engineers = Division::create([
            'name' => 'Инженерное',
            'division_id' => $moscow->id,
        ]);
    }
}
