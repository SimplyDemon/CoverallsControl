<?php

namespace App\Http\Controllers;

use App\Helpers\CoverallsInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Shuchkin\SimpleXLSXGen;

class ReportController extends Controller
{
    public function create()
    {
        $customDate = Session::get('date');
        $date = $customDate ? new Carbon($customDate) : now();
        $dateFormatted = $date->format('d.m.Y');

        $coverallsData = CoverallsInfo::getCoverallsDataByDate($date);

        $data = [
            ['№', 'Наименование', 'Размер', 'Количество'],
        ];


        $i = 1;
        foreach ($coverallsData['coverallsInfo'] as $coverallInfo) {
            $firstSizeKey = array_key_first($coverallInfo['sizes']);
            $data[] = [
                $i++, $coverallInfo['coverallType']->name, $firstSizeKey, $coverallInfo['sizes'][$firstSizeKey]['lacks'],
            ];

            $isFirstRowSkipped = false;

            foreach ($coverallInfo['sizes'] as $size => $sizeData) {
                /* Skip first sizes row, coz it in coverall title row */
                if (!$isFirstRowSkipped) {
                    $isFirstRowSkipped = true;
                    continue;
                }
                $data[] = [
                    '', '', $size, $sizeData['lacks'],
                ];
            }

            $data[] = [
                '', '', '<right><b>итого</b></right>', "<right><b>{$coverallInfo['quantityLacks']}</b></right>",
            ];

        }

        SimpleXLSXGen::fromArray($data)->downloadAs("coveralls-{$dateFormatted}.xlsx");
        exit();
    }
}
