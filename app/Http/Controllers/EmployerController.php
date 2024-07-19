<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employer;
use App\Models\Position;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    protected string $routeName = 'employers.';
    protected string $frontPath = 'pages.employers.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Employer::orderBy('name', 'desc')->get();
        $buttonUrlAddNew = route($this->routeName . 'create');

        return view($this->frontPath . 'index', [
            'all' => $all,
            'title' => 'Работники',
            'buttonUrlAddNew' => $buttonUrlAddNew,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::orderBy('name', 'asc')->get();
        $positions = Position::orderBy('name', 'asc')->get();
        $formActionCreate = route($this->routeName . 'store');

        return view($this->frontPath . 'create', [
            'formActionCreate' => $formActionCreate,
            'divisions' => $divisions,
            'positions' => $positions,
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
            $imgPath = $img->storeAs('uploads/employers/' . $postfixFolder, $imgName, 'public');


            $request->merge(['img' => $imgPath]);
        }

        try {
            $single = Employer::create($request->except('image'));
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
    public function show(Employer $employer)
    {
        $urlEdit = route($this->routeName . 'edit', $employer);
        $formActionDestroy = route($this->routeName . 'destroy', $employer);

        return view($this->frontPath . 'show', [
            'single' => $employer,
            'urlEdit' => $urlEdit,
            'formActionDestroy' => $formActionDestroy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer)
    {
        $formActionUpdate = route($this->routeName . 'update', $employer);
        $divisions = Division::orderBy('name', 'asc')->get();
        $positions = Position::orderBy('name', 'asc')->get();

        return view($this->frontPath . 'edit', [
            'single' => $employer,
            'formActionUpdate' => $formActionUpdate,
            'divisions' => $divisions,
            'positions' => $positions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employer $employer)
    {
        $img = $request->file('image');

        if ($img) {
            $imgName = time() . '-' . Str::slug(pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.' . $img->getClientOriginalExtension();
            $imgPath = $img->storeAs('uploads/resources', $imgName, 'public');

            $request->merge(['img' => $imgPath]);
        }

        try {
            $employer->update($request->except('image'));
            $message = 'Обновление выполнено успешно!';
        } catch (QueryException $exception) {
            $error = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'show', $employer)->with([
            'error' => $error ?? null,
            'message' => $message ?? null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer)
    {
        try {
            $employer->delete();
            $message = 'Удаление выполнено успешно!';
        } catch (QueryException $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'index')->with('message', $message);
    }
}
