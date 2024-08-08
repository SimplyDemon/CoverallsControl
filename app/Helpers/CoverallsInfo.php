<?php

namespace App\Helpers;

use App\Models\Coverall;
use App\Models\Employer;

class CoverallsInfo
{
    public static function getCoverallsDataByDate($date): array
    {
        $coverallsInfo = [];
        $employersNeedCoveralls = [];
        $employers = Employer::all();
        foreach ($employers as $employer) {
            foreach ($employer->position->coverallTypes as $coverallType) {
                $coveralls = $employer->coveralls->where('coverall_type_id', $coverallType->id)->where('status', 'issued');
                $currentCoverallNeedCount = $coverallsInfo[$coverallType->id]['quantityNeed'] ?? 0;
                $currentCoverallPositionNeed = $coverallType->pivot->quantity;
                $quantityNeed = $currentCoverallNeedCount + $currentCoverallPositionNeed;

                $currentCoverallHasCount = $coverallsInfo[$coverallType->id]['quantityHas'] ?? 0;
                $coverallsHasCount = $coveralls->where('date_replacement', '>', $date)->count();
                $quantityHas = $currentCoverallHasCount + $coverallsHasCount;

                $currentCoverallsOverdueCount = $coverallsInfo[$coverallType->id]['quantityOverdue'] ?? 0;
                $coverallsOverdueCount = $coveralls->where('date_replacement', '<', $date)->count();
                $quantityOverdue = $currentCoverallsOverdueCount + $coverallsOverdueCount;

                $employerBaseSizeName = $coverallType->employerBaseSizeName;
                $coverallSize = $employer->$employerBaseSizeName;

                if (!isset($coverallsInfo[$coverallType->id]['coverallType'])) {
                    $coverallsInfo[$coverallType->id]['coverallType'] = $coverallType;
                }
                $coverallsInfo[$coverallType->id]['quantityNeed'] = $quantityNeed;
                $coverallsInfo[$coverallType->id]['quantityHas'] = $quantityHas;
                $coverallsInfo[$coverallType->id]['quantityOverdue'] = $quantityOverdue;
                $coverallsInfo[$coverallType->id]['quantityLacks'] = $quantityNeed - $quantityHas;


                if ($coverallSize) {
                    $currentCoverallNeedWithSizeCount = $coverallsInfo[$coverallType->id]['sizes'][$coverallSize]['lacks'] ?? 0;
                    $coverallsInfo[$coverallType->id]['sizes'][$coverallSize]['lacks'] = $currentCoverallPositionNeed - $coverallsHasCount + $currentCoverallNeedWithSizeCount;

                    if (!isset($coverallsInfo[$coverallType->id]['sizes'][$coverallSize]['available'])) {
                        $availableCount = Coverall::where([
                            ['coverall_type_id', $coverallType->id,],
                            ['status', 'in_stock'],
                            ['employer_id', null],
                            ['size', $coverallSize],
                        ])->count();
                        $currentQuantityAvailable = $coverallsInfo[$coverallType->id]['quantityAvailable'] ?? 0;
                        $availableCountForSize = $currentQuantityAvailable + (min($availableCount, $currentCoverallPositionNeed));
                        $coverallsInfo[$coverallType->id]['quantityAvailable'] = min($availableCountForSize, $coverallsInfo[$coverallType->id]['quantityLacks']);
                        $coverallsInfo[$coverallType->id]['sizes'][$coverallSize]['available'] = $availableCount;
                    }

                    $coverallsInfo[$coverallType->id]['tooltipInfo'] = match (true) {
                        $coverallsInfo[$coverallType->id]['quantityLacks'] === 0 => ['text' => 'Выдано всем сотрудникам', 'class' => 'sd-tooltip-green'],
                        $coverallsInfo[$coverallType->id]['quantityLacks'] <= $coverallsInfo[$coverallType->id]['quantityAvailable'] => ['text' => 'Выдано не всем сотрудникам, но есть на складе', 'class' => 'sd-tooltip-dark-green'],
                        $coverallsInfo[$coverallType->id]['quantityLacks'] === $coverallsInfo[$coverallType->id]['quantityNeed'] => ['text' => 'Острая не хватка!', 'class' => 'sd-tooltip-red'],
                        $coverallsInfo[$coverallType->id]['quantityLacks'] > $coverallsInfo[$coverallType->id]['quantityAvailable'] => ['text' => 'Не достаточно спецовки для всех сотрудников', 'class' => 'sd-tooltip-yellow'],
                    };
                }

                /* Employer need some coveralls */
                if ($coverallsHasCount !== $currentCoverallPositionNeed && !isset($employersNeedCoveralls[$employer->id])) {
                    $employersNeedCoveralls[$employer->id] = $employer;
                }
            }
        }

        return [
            'coverallsInfo' => $coverallsInfo,
            'employersNeedCoveralls' => $employersNeedCoveralls,
        ];
    }
}
