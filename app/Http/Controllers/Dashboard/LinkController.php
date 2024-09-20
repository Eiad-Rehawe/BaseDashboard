<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\LinksDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Http\Services\LinkService;
use App\Models\Icon;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(LinksDataTable $dataTable,Link $data)
    {
        
        // $this->middleware(['permission:Display Links|Update Link|Delete Link|عرض اللينكات|إضافة لينك|تعديل لينك|Create Link|حذف لينك'], ['only' => ['index', 'show']]);
        // $this->middleware(['permission:Create Link|إضافة لينك'], ['only' => ['create','store']]);
        // $this->middleware(['permission:Update Link|تعديل لينك'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:Delete Link|حذف لينك'], ['only' => ['destroy']]);
        // $this->middleware(['permission:Delete Multible|حذف متعدد'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable,$data);
    }

    public function append()
    {
        return[
           'icons'=>Icon::get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request, LinkService $service)
    {
      
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.links.index')]);
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
    public function update(LinkRequest $request,$id, LinkService $service)
    {
        try {
            $row = $service->handle($request->all(),$id);
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.links.index')]);
            } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
