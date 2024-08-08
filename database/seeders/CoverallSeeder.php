<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Coverall;
use App\Models\CoverallType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoverallSeeder extends Seeder
{
    protected array $coveralls;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setCoverallsList();

        $contractId = Contract::where('number', '001')->firstOrFail()->id;
        foreach ($this->coveralls as $coverall) {

            $coverallTypeId = CoverallType::where('name', $coverall['name'])->firstOrFail()->id;

            $quantity = $coverall['quantity'];
            for ($i = 0; $i < $quantity; $i++) {
                $coverall = array_merge(['size' => $coverall['size']], [
                    'status' => 'in_stock',
                    'contract_id' => $contractId,
                    'coverall_type_id' => $coverallTypeId,
                ]);
                Coverall::create($coverall);
            }


        }
    }

    protected function setCoverallsList()
    {
        $this->coveralls = [
            [
                'name' => 'Ботинки кожаные',
                'quantity' => 15,
                'size' => 99,
            ],
            [
                'name' => 'Ботинки кожаные',
                'quantity' => 15,
                'size' => 41,
            ],
            [
                'name' => 'Ботинки кожаные',
                'quantity' => 15,
                'size' => 42,
            ],
            [
                'name' => 'Ботинки кожаные',
                'quantity' => 15,
                'size' => 43,
            ],
            [
                'name' => 'Ботинки кожаные',
                'quantity' => 15,
                'size' => 44,
            ],
            [
                'name' => 'Ботинки кожаные',
                'quantity' => 15,
                'size' => 45,
            ],
            [
                'name' => 'Ботинки кожаные с жестким подноском',
                'quantity' => 5,
                'size' => 40,
            ],
            [
                'name' => 'Ботинки кожаные с жестким подноском',
                'quantity' => 5,
                'size' => 42,
            ],
            [
                'name' => 'Ботинки кожаные с жестким подноском',
                'quantity' => 5,
                'size' => 44,
            ],
            [
                'name' => 'Сапоги резиновые',
                'quantity' => 2,
                'size' => 39,
            ],
            [
                'name' => 'Сапоги резиновые',
                'quantity' => 2,
                'size' => 41,
            ],
            [
                'name' => 'Сапоги резиновые',
                'quantity' => 2,
                'size' => 43,
            ],
            [
                'name' => 'Сапоги резиновые',
                'quantity' => 2,
                'size' => 45,
            ],
            [
                'name' => 'Рукавицы комбинированные',
                'quantity' => 25,
                'size' => 25,
            ],
            [
                'name' => 'Рукавицы комбинированные',
                'quantity' => 25,
                'size' => 27,
            ],
            [
                'name' => 'Рукавицы комбинированные',
                'quantity' => 25,
                'size' => 29,
            ],
            [
                'name' => 'Рукавицы комбинированные',
                'quantity' => 25,
                'size' => 31,
            ],
            [
                'name' => 'Перчатки резиновые',
                'quantity' => 3,
                'size' => 26,
            ],
            [
                'name' => 'Перчатки резиновые',
                'quantity' => 3,
                'size' => 28,
            ],
            [
                'name' => 'Перчатки резиновые',
                'quantity' => 3,
                'size' => 30,
            ],
        ];
    }
}
