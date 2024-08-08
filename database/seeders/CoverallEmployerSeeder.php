<?php

namespace Database\Seeders;

use App\Events\CoverallSave;
use App\Models\Coverall;
use App\Models\CoverallType;
use App\Models\Employer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoverallEmployerSeeder extends Seeder
{
    protected array $data;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setDataList();

        foreach ($this->data as $item) {
            $employer = $item['employer'];

            $coverallsForAttach = collect();
            foreach ($item['coverall_types'] as $itemCoverallType) {
                $coverall = Coverall::where([
                    ['coverall_type_id', $itemCoverallType['coverall_type_id'],],
                    ['status', 'in_stock'],
                    ['employer_id', null],
                ]);
                $coverallType = CoverallType::findOrFail($itemCoverallType['coverall_type_id']);
                $employerBaseSizeName = $coverallType->employerBaseSizeName;

                $coverallSize = $employer->$employerBaseSizeName;
                if ($coverallSize) {
                    $coverall = $coverall->where([
                        ['size', $employer->$employerBaseSizeName,],
                    ]);
                }

                $coverall = $coverall->take($itemCoverallType['count'])->get();

                $coverallsForAttach = $coverallsForAttach->concat($coverall);
            }

            if (!empty($coverallsForAttach)) {
                $employer->coveralls()->saveMany($coverallsForAttach);
                CoverallSave::dispatch($coverallsForAttach);
            }
        }
    }

    protected function setDataList()
    {
        $employerSemerenko = Employer::where('name_last', 'Семеренко')->firstOrFail();
        $employerVizirii = Employer::where('name_last', 'Визирий')->firstOrFail();
        $employerSerov = Employer::where('name_last', 'Серов')->firstOrFail();

        $this->data = [
            [
                'employer' => $employerSemerenko,
                'coverall_types' => [
                    [
                        'coverall_type_id' => CoverallType::where('name', 'Ботинки кожаные')->firstOrFail()->id,
                        'count' => 2,
                    ],
                    [
                        'coverall_type_id' => CoverallType::where('name', 'Перчатки резиновые')->firstOrFail()->id,
                        'count' => 1,
                    ],
                ],
            ],
            [
                'employer' => $employerVizirii,
                'coverall_types' => [
                    [
                        'coverall_type_id' => CoverallType::where('name', 'Ботинки кожаные')->firstOrFail()->id,
                        'count' => 4,
                    ],
                ],
            ],
            [
                'employer' => $employerSerov,
                'coverall_types' => [
                    [
                        'coverall_type_id' => CoverallType::where('name', 'Рукавицы комбинированные')->firstOrFail()->id,
                        'count' => 4,
                    ],
                ],
            ],
        ];

    }
}
