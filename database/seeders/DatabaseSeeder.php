<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DivisionSeeder::class,
            CoverallTypesSeeder::class,
            PositionSeeder::class,
            EmployerSeeder::class,
            ContractSeeder::class,
            CoverallSeeder::class,
            CoverallEmployerSeeder::class,
        ]);
    }
}
