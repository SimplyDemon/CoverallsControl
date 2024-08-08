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

        foreach ($coverallsData['coverallsInfo'] as $key => $coverallInfo) {
            foreach ($coverallInfo['sizes'] as $sizeKey => $sizeValue) {
                $needToOrder = $sizeValue['lacks'] - $sizeValue['available'];
                if ($needToOrder <= 0) {
                    unset($coverallsData['coverallsInfo'][$key]['sizes'][$sizeKey]);
                } else {
                    $coverallsData['coverallsInfo'][$key]['sizes'][$sizeKey]['needOrder'] = $needToOrder;
                }
            }
        }
        $i = 1;
        foreach ($coverallsData['coverallsInfo'] as $coverallInfo) {
            if (empty($coverallInfo['sizes'])) {
                continue;
            }
            $firstSizeKey = array_key_first($coverallInfo['sizes']);
            $totalSizeNeedToOrder = $coverallInfo['sizes'][$firstSizeKey]['needOrder'];
            $data[] = [
                $i++, $coverallInfo['coverallType']->name, $firstSizeKey, $coverallInfo['sizes'][$firstSizeKey]['needOrder'],
            ];

            $isFirstRowSkipped = false;

            foreach ($coverallInfo['sizes'] as $size => $sizeData) {
                /* Skip first sizes row, coz it in coverall title row */
                if (!$isFirstRowSkipped) {
                    $isFirstRowSkipped = true;
                    continue;
                }
                $totalSizeNeedToOrder += $sizeData['needOrder'];
                $data[] = [
                    '', '', $size, $sizeData['needOrder'],
                ];
            }

            $data[] = [
                '', '', '<right><b>итого</b></right>', "<right><b>{$totalSizeNeedToOrder}</b></right>",
            ];

        }

        SimpleXLSXGen::fromArray($data)->downloadAs("coveralls-{$dateFormatted}.xlsx");
        exit();
    }
}
