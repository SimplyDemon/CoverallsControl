<?php

namespace Database\Seeders;

use App\Models\CoverallType;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    protected array $positions;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setPositionsList();

        foreach ($this->positions as $position) {
            $single = Position::create([
                'name' => $position['name'],
            ]);

            if (!empty($position['coverallTypes'])) {
                foreach ($position['coverallTypes'] as $coverallType) {
                    $coverallTypeId = CoverallType::where('name', $coverallType['name'])->firstOrFail()->id;
                    $single->coverallTypes()->attach($coverallTypeId, ['quantity' => $coverallType['quantity']]);
                }
            }
        }
    }

    protected function setPositionsList()
    {

        $this->positions = [
            [
                'name' => 'Инженер-конструктор',
                'coverallTypes' => [
                    [
                        'name' => 'Ботинки кожаные',
                        'quantity' => '5',
                    ],
                    [
                        'name' => 'Перчатки резиновые',
                        'quantity' => '5',
                    ],
                ],
            ],
            [
                'name' => 'Инженер-строитель',
                'coverallTypes' => [
                    [
                        'name' => 'Ботинки кожаные',
                        'quantity' => '5',
                    ],
                    [
                        'name' => 'Ботинки кожаные с жестким подноском',
                        'quantity' => '5',
                    ],
                    [
                        'name' => 'Сапоги резиновые',
                        'quantity' => '5',
                    ],
                    [
                        'name' => 'Перчатки резиновые',
                        'quantity' => '5',
                    ],
                    [
                        'name' => 'Рукавицы комбинированные',
                        'quantity' => '5',
                    ],
                ],
            ],
        ];
    }
}
