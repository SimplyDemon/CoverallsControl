<?php

namespace App\Http\Controllers;

use App\Models\CoverallType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoverallTypeController extends Controller
{
    protected string $routeName = 'coverall_types.';
    protected string $frontPath = 'pages.coverall_types.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = CoverallType::orderBy('name', 'desc')->get();
        $buttonUrlAddNew = route($this->routeName . 'create');

        return view($this->frontPath . 'index', [
            'all' => $all,
            'title' => 'Виды спецовок',
            'buttonUrlAddNew' => $buttonUrlAddNew,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formActionCreate = route($this->routeName . 'store');

        $types = [
            'перчатки' => 'gloves',
            'ботинки' => 'boots',
            'головной убор' => 'helmet',
            'верхняя одежа ' => 'robe',
            'другое' => 'other',
        ];


        return view($this->frontPath . 'create', [
            'formActionCreate' => $formActionCreate,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $img = $request->file('image');

        if ($img) {
            $postfixFolder = date('Y/m/d');
            $imgName = time() . '-' . Str::slug(pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.' . $img->getClientOriginalExtension();
            $imgPath = $img->storeAs('uploads/coverall-types/' . $postfixFolder, $imgName, 'public');

            $request->merge(['img' => $imgPath]);
        }

        try {
            $single = CoverallType::create($request->all());
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
    public function show(CoverallType $coverallType)
    {
        $urlEdit = route($this->routeName . 'edit', $coverallType);
        $formActionDestroy = route($this->routeName . 'destroy', $coverallType);

        return view($this->frontPath . 'show', [
            'single' => $coverallType,
            'urlEdit' => $urlEdit,
            'formActionDestroy' => $formActionDestroy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoverallType $coverallType)
    {
        $formActionUpdate = route($this->routeName . 'update', $coverallType);

        $types = [
            'перчатки' => 'gloves',
            'ботинки' => 'boots',
            'головной убор' => 'helmet',
            'верхняя одежа ' => 'robe',
            'другое' => 'other',
        ];

        return view($this->frontPath . 'edit', [
            'single' => $coverallType,
            'formActionUpdate' => $formActionUpdate,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoverallType $coverallType)
    {
        try {
            $coverallType->update($request->all());
            $message = 'Обновление выполнено успешно!';
        } catch (QueryException $exception) {
            $error = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'show', $coverallType)->with([
            'error' => $error ?? null,
            'message' => $message ?? null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoverallType $coverallType)
    {
        try {
            $coverallType->delete();
            $message = 'Удаление выполнено успешно!';
        } catch (QueryException $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'index')->with('message', $message);
    }
}
