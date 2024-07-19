<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected string $routeName = 'positions.';
    protected string $frontPath = 'pages.positions.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Position::orderBy('name', 'desc')->get();
        $buttonUrlAddNew = route($this->routeName . 'create');

        return view($this->frontPath . 'index', [
            'all' => $all,
            'title' => 'Должности',
            'buttonUrlAddNew' => $buttonUrlAddNew,
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
            $single = Position::create($request->all());
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
    public function show(Position $position)
    {
        $urlEdit = route($this->routeName . 'edit', $position);
        $formActionDestroy = route($this->routeName . 'destroy', $position);

        return view($this->frontPath . 'show', [
            'single' => $position,
            'urlEdit' => $urlEdit,
            'formActionDestroy' => $formActionDestroy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        $formActionUpdate = route($this->routeName . 'update', $position);

        return view($this->frontPath . 'edit', [
            'single' => $position,
            'formActionUpdate' => $formActionUpdate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        try {
            $position->update($request->all());
            $message = 'Обновление выполнено успешно!';
        } catch (QueryException $exception) {
            $error = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'show', $position)->with([
            'error' => $error ?? null,
            'message' => $message ?? null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        try {
            $position->delete();
            $message = 'Удаление выполнено успешно!';
        } catch (QueryException $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'index')->with('message', $message);
    }
}
