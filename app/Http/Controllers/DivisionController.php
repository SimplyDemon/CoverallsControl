<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    protected string $routeName = 'divisions.';
    protected string $frontPath = 'pages.divisions.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Division::orderBy('name', 'desc')->get();

        return view($this->frontPath . 'index', [
            'all' => $all,
            'title' => 'Подразделения',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formActionCreate = route($this->routeName . 'store');

        return view($this->frontPath . 'create', [
            'formActionCreate' => $formActionCreate,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $single = Division::create($request->all());
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
    public function show(Division $division)
    {
        $urlEdit = route($this->routeName . 'edit', $division);
        $formActionDestroy = route($this->routeName . 'destroy', $division);

        return view($this->frontPath . 'show', [
            'single' => $division,
            'urlEdit' => $urlEdit,
            'formActionDestroy' => $formActionDestroy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        $formActionUpdate = route($this->routeName . 'update', $division);

        return view($this->frontPath . 'edit', [
            'single' => $division,
            'formActionUpdate' => $formActionUpdate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        try {
            $division->update($request->all());
            $message = 'Обновление выполнено успешно!';
        } catch (QueryException $exception) {
            $error = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'show', $division)->with([
            'error' => $error ?? null,
            'message' => $message ?? null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        try {
            $division->delete();
            $message = 'Удаление выполнено успешно!';
        } catch (QueryException $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'index')->with('message', $message);
    }
}
