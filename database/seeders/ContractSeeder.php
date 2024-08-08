<?php

namespace Database\Seeders;

use App\Helpers\WorkWithFile;
use App\Models\Contract;
use App\Models\CoverallType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ContractSeeder extends Seeder
{
    protected array $contracts;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setContractsList();

        foreach ($this->contracts as $contract) {
            $contract = Contract::create($contract['data']);

            if (!empty($contract['coverallTypes'])) {
                $i = 0;
                foreach ($contract['coverallTypes'] as $coverallType) {
                    $coverallTypeId = CoverallType::where('name', $coverallType['name'])->firstOrFail()->id;
                    $contract->coverallTypes()->attach($coverallTypeId, [
                        'quantity_planned' => $coverallType['quantity'],
                        'size' => $coverallType['size'],
                    ]);
                }
            }
        }

    }

    protected function setContractsList()
    {
        $contractsImagePath = 'seeder/contract';
        $this->contracts = [
            [
                'data' => [
                    'number' => '001',
                    'date_conclusion' => Carbon::create(2024, 01, 15),
                    'date_delivery_documental' => now(),
                    'date_delivery_actual' => now(),
                    'file' => WorkWithFile::copyFile("image/{$contractsImagePath}/001.pdf", "app/public/uploads/{$contractsImagePath}/"),
                ],
                'coverallTypes' => [
                    [
                        'name' => 'Ботинки кожаные',
                        'quantity' => 15,
                        'size' => 40,
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
                ],
            ],
        ];
    }
}
