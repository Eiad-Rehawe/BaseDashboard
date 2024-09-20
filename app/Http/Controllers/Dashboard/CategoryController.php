<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(CategoriesDataTable $dataTable, Category $cat)
    {
        // $this->middleware(['permission:Display Category|عرض الأقسام|Update Category|تعديل قسم|حذف قسم|إضافة قسم|Delete Category'], ['only' => ['index', 'show']]);
        // $this->middleware(['permission:Create Category|إضافة قسم'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:Update Category|تعديل قسم'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:Delete Category|حذف قسم'], ['only' => ['destroy']]);
        // $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable, $cat);
    }

    public function append()
    {
        return [
            'rows' => (new Category())->getDataAsLang()->where('status', 1)->get(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $service)
    {
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) {
                return $this->throwException($row);
            }

            return response()->json(['title' => __('messages.success'), 'message' =>__('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.categories.index')]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id, CategoryService $service)
    {
        try {
            $row = $service->handle($request->all(), $id);
            if (is_string($row)) {
                return $this->throwException($row);
            }

            return response()->json(['title' => __('messages.success'), 'message' =>__('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.categories.index')]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

}
