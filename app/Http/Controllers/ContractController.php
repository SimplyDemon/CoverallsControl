<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\CoverallType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    protected string $routeName = 'contracts.';
    protected string $frontPath = 'pages.contracts.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Contract::orderBy('id', 'desc')->get();
        $buttonUrlAddNew = route($this->routeName . 'create');

        return view($this->frontPath . 'index', [
            'all' => $all,
            'title' => 'Контракты',
            'buttonUrlAddNew' => $buttonUrlAddNew,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formActionCreate = route($this->routeName . 'store');
        $coverallTypes = CoverallType::orderBy('name', 'desc')->get();

        return view($this->frontPath . 'create', [
            'formActionCreate' => $formActionCreate,
            'coverallTypes' => $coverallTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('base_file');
        $coverallTypesIds = $request->input('coverall_types_ids');
        $quantitiesPlanned = $request->input('quantities_planned');
        $sizes = $request->input('sizes');

        if ($file) {
            $postfixFolder = date('Y/m/d');
            $fileName = time() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/contracts/' . $postfixFolder, $fileName, 'public');

            $request->merge(['file' => $filePath]);
        }

        try {
            $single = Contract::create($request->except([
                'base_file',
                'coverall_types_ids',
                'quantities_planned',
                'sizes',
            ]));

            if (!empty($coverallTypesIds)) {
                $i = 0;
                foreach ($coverallTypesIds as $coverallTypesId) {
                    $single->coverallTypes()->attach($coverallTypesId, [
                        'quantity_planned' => $quantitiesPlanned[$i],
                        'size' => $sizes[$i++],
                    ]);
                }
            }
            $messageText = $single->name . ' Добавлено успешно';
            $messageLink = route($this->routeName . 'show', $single);
        } catch (QueryException $exception) {
            if (isset($single)) {
                $single->delete();
            }
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
    public function show(Contract $contract)
    {
        $urlEdit = route($this->routeName . 'edit', $contract);
        $formActionDestroy = route($this->routeName . 'destroy', $contract);

        return view($this->frontPath . 'show', [
            'single' => $contract,
            'urlEdit' => $urlEdit,
            'formActionDestroy' => $formActionDestroy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        $formActionUpdate = route($this->routeName . 'update', $contract);
        $coverallTypes = CoverallType::orderBy('name', 'desc')->get();

        return view($this->frontPath . 'edit', [
            'single' => $contract,
            'formActionUpdate' => $formActionUpdate,
            'coverallTypes' => $coverallTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $file = $request->file('base_file');
        $coverallTypesIds = $request->input('coverall_types_ids');
        $quantitiesPlanned = $request->input('quantities_planned');
        $sizes = $request->input('sizes');

        if ($file) {
            $fileName = time() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/resources', $fileName, 'public');

            $request->merge(['file' => $filePath]);
        }

        try {
            $contract->update($request->except([
                'base_file',
                'coverall_types_ids',
                'quantities_planned',
                'sizes',
            ]));

            /* Delete all coverall types values and write again it's much better than make 1000 checks */
            DB::table('contract_coverall_type')->where([
                ['contract_id', '=', $contract->id],
            ])->delete();

            if (!empty($coverallTypesIds)) {
                $i = 0;
                foreach ($coverallTypesIds as $coverallTypesId) {
                    $contract->coverallTypes()->attach($coverallTypesId, [
                        'quantity_planned' => $quantitiesPlanned[$i],
                        'size' => $sizes[$i++],
                    ]);
                }
            }
            $message = 'Обновление выполнено успешно!';
        } catch (QueryException $exception) {
            $error = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'show', $contract)->with([
            'error' => $error ?? null,
            'message' => $message ?? null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        try {
            $contract->delete();
            $message = 'Удаление выполнено успешно!';
        } catch (QueryException $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->route($this->routeName . 'index')->with('message', $message);
    }
}
