<?php

namespace App\Http\Controllers;

use App\Helpers\CoverallsInfo;
use App\Models\Coverall;
use App\Models\Employer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    protected string $routeName = 'index.';
    protected string $frontPath = 'pages.index.';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customDate = Session::get('date');
        $date = $customDate ? new Carbon($customDate) : now();
        $coverallsData = CoverallsInfo::getCoverallsDataByDate($date);
        $dateForForm = $date->format('Y-m-d');
        $dateFormatted = $date->format('d.m.Y');
        $formAction = route($this->routeName . 'date_form_handler');


        return view($this->frontPath . 'index', [
            'title' => 'Главная',
            'coverallsInfo' => $coverallsData['coverallsInfo'],
            'employersNeedCoveralls' => $coverallsData['employersNeedCoveralls'],
            'formAction' => $formAction,
            'dateFormatted' => $dateFormatted,
            'dateForForm' => $dateForForm,
        ]);
    }

    public function dateFormHandler(Request $request)
    {
        $date = $request->input('date');
        $submit = $request->input('submit');

        $routeName = match ($submit) {
            'report' => 'create-report',
            default => $this->routeName . 'index',
        };

        return redirect()->route($routeName)->with([
            'date' => $date,
        ]);

    }

}
