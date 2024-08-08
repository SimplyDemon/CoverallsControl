<?php

namespace Database\Seeders;

use App\Helpers\WorkWithFile;
use App\Models\Division;
use App\Models\Employer;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EmployerSeeder extends Seeder
{
    protected array $employers;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setEmployersList();

        foreach ($this->employers as $employer) {
            Employer::create($employer);
        }
    }

    protected function setEmployersList()
    {
        $positionEngineerConstructorId = Position::where('name', 'Инженер-конструктор')->firstOrFail()->id;
        $positionEngineerBuilderId = Position::where('name', 'Инженер-строитель')->firstOrFail()->id;
        $divisionEngineerId = Division::where('name', 'Инженерное')->firstOrFail()->id;
        $employersImagePath = 'seeder/employer';
        $this->employers = [
            [
                'name_last' => 'Семеренко',
                'name_first' => 'Владимир',
                'name_middle' => 'Янович',
                'certificate_id' => '001',
                'date_of_birth' => Carbon::create(1990, 5, 15),
                'phone' => '+79789999999',
                'address_documental' => 'г. Москва, ул. Ленина, д. 15, кв. 169',
                'address_actual' => 'г. Москва, ул. Ленина, д. 15, кв. 169',
                'size_head' => 10,
                'size_body' => 80,
                'size_foot' => 44,
                'size_face' => 15,
                'size_gloves' => 30,
                'height' => 185,
                'img' => WorkWithFile::copyFile("image/{$employersImagePath}/semerenko.jpg", "app/public/uploads/{$employersImagePath}/"),
                'division_id' => $divisionEngineerId,
                'position_id' => $positionEngineerConstructorId,
            ],
            [
                'name_last' => 'Визирий',
                'name_first' => 'Олег',
                'name_middle' => 'Александрович',
                'certificate_id' => '002',
                'date_of_birth' => Carbon::create(1980, 1, 14),
                'phone' => '+79789999998',
                'address_documental' => 'г. Москва, ул. Ленина, д. 16, кв. 135',
                'address_actual' => 'г. Москва, ул. Ленина, д. 16, кв. 135',
                'size_head' => 9,
                'size_body' => 78,
                'size_foot' => 43,
                'size_face' => 14,
                'size_gloves' => 27,
                'height' => 180,
                'img' => WorkWithFile::copyFile("image/{$employersImagePath}/vizirii.jpg", "app/public/uploads/{$employersImagePath}/"),
                'division_id' => $divisionEngineerId,
                'position_id' => $positionEngineerConstructorId,
            ],
            [
                'name_last' => 'Серов',
                'name_first' => 'Александр',
                'name_middle' => 'Павлович',
                'certificate_id' => '003',
                'date_of_birth' => Carbon::create(1995, 3, 22),
                'phone' => '+79789999997',
                'address_documental' => 'г. Москва, ул. Ленина, д. 5, кв. 13',
                'address_actual' => 'г. Москва, ул. Ленина, д. 5, кв. 13',
                'size_head' => 10,
                'size_body' => 80,
                'size_foot' => 40,
                'size_face' => 14,
                'size_gloves' => 25,
                'height' => 175,
                'img' => WorkWithFile::copyFile("image/{$employersImagePath}/serov.jpg", "app/public/uploads/{$employersImagePath}/"),
                'division_id' => $divisionEngineerId,
                'position_id' => $positionEngineerBuilderId,
            ],
        ];
    }
}
