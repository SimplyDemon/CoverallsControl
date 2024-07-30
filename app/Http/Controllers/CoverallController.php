<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Coverall;
use App\Models\CoverallType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoverallController extends Controller
{
    protected string $routeName = 'coveralls.';
    protected string $frontPath = 'pages.coveralls.';
    protected array $statuses = [
        'in_stock' => 'в наличии',
        'issued' => 'выдан',
        'defective' => 'брак',
        'returned' => 'возвращён',
        'ready_for_disposal' => 'готов к утилизации',
        'disposed' => 'утилизирован',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Coverall::orderBy('id', 'desc')->get();
        $buttonUrlAddNew = route($this->routeName . 'create');

        return view($this->frontPath . 'index', [
            'all' => $all,
            'title' => 'Спецодежда',
            'buttonUrlAddNew' => $buttonUrlAddNew,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coverallTypes = CoverallType::orderBy('id', 'asc')->get();
        $contracts = Contract::orderBy('id', 'asc')->get();
        $formActionCreate = route($this->routeName . 'store');

        return view($this->frontPath . 'create', [
            'formActionCreate' => $formActionCreate,
            'coverallTypes' => $coverallTypes,
            'contracts' => $contracts,
            'statuses' => $this->statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $single = Coverall::create($request->except('image'));
            $messageText = $single->name . ' Добавлено успешно';
            $messageLink = route($this->routeName . 'show', $single);
        } catch (QueryException $exception) {
            $error = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'create')->with([
            'error' => $error ?? null,
            'messageText' => $messageText ?? null,
            'messageLink' => $messageLink ?? null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coverall $coverall)
    {
        $urlEdit = route($this->routeName . 'edit', $coverall);
        $formActionDestroy = route($this->routeName . 'destroy', $coverall);

        return view($this->frontPath . 'show', [
            'single' => $coverall,
            'urlEdit' => $urlEdit,
            'formActionDestroy' => $formActionDestroy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coverall $coverall)
    {
        $formActionUpdate = route($this->routeName . 'update', $coverall);
        $coverallTypes = CoverallType::orderBy('name', 'asc')->get();
        $contracts = Contract::orderBy('id', 'asc')->get();

        return view($this->frontPath . 'edit', [
            'single' => $coverall,
            'formActionUpdate' => $formActionUpdate,
            'coverallTypes' => $coverallTypes,
            'contracts' => $contracts,
            'statuses' => $this->statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coverall $coverall)
    {

        try {
            $coverall->update($request->all());
            $message = 'Обновление выполнено успешно!';
        } catch (QueryException $exception) {
            $error = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'show', $coverall)->with([
            'error' => $error ?? null,
            'message' => $message ?? null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coverall $coverall)
    {
        try {
            $coverall->delete();
            $message = 'Удаление выполнено успешно!';
        } catch (QueryException $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'index')->with('message', $message);
    }
}
