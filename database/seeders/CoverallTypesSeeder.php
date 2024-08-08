<?php

namespace Database\Seeders;

use App\Helpers\WorkWithFile;
use App\Models\CoverallType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoverallTypesSeeder extends Seeder
{
    protected array $coverallTypes;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setCoverallTypesList();
        foreach ($this->coverallTypes as $coverallType) {
            CoverallType::create($coverallType);
        }
    }

    protected function setCoverallTypesList()
    {
        $bootsImagePath = 'seeder/coverall_type/boots';
        $glovesImagePath = 'seeder/coverall_type/gloves';

        $this->coverallTypes = [
            [
                'name' => 'Ботинки кожаные',
                'img' => WorkWithFile::copyFile("image/{$bootsImagePath}/leather_boots.jpg", "app/public/uploads/{$bootsImagePath}/"),
                'type' => 'boots',
                'term_life' => '24',
            ],
            [
                'name' => 'Ботинки кожаные с жестким подноском',
                'img' => WorkWithFile::copyFile("image/{$bootsImagePath}/leather_boots_toe_cap.jpg", "app/public/uploads/{$bootsImagePath}/"),
                'type' => 'boots',
                'term_life' => '24',
            ],
            [
                'name' => 'Сапоги резиновые',
                'img' => WorkWithFile::copyFile("image/{$bootsImagePath}/robber_boots.jpg", "app/public/uploads/{$bootsImagePath}/"),
                'type' => 'boots',
                'term_life' => '24',
            ],
            [
                'name' => 'Перчатки резиновые',
                'img' => WorkWithFile::copyFile("image/{$glovesImagePath}/robber_gloves.jpg", "app/public/uploads/{$glovesImagePath}/"),
                'type' => 'gloves',
                'term_life' => '24',
            ],
            [
                'name' => 'Рукавицы комбинированные',
                'img' => WorkWithFile::copyFile("image/{$glovesImagePath}/combined_mittens.jpg", "app/public/uploads/{$bootsImagePath}/"),
                'type' => 'gloves',
                'term_life' => '24',
            ],
        ];
    }
}
