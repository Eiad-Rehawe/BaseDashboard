<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ComplaimentUsersDataTable;
use App\DataTables\ComplaintsDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintsRequest;
use App\Http\Services\ComplaintsService;
use App\Models\Complaints;
use Illuminate\Http\Request;

class ComplaintsController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(ComplaintsDataTable $dataTable,Complaints $data)
    {
        // $this->middleware(['permission:Display Complaiments|عرض الشكاوي'], ['only' => ['index']]);
        // $this->middleware(['permission:Create Complaiments|إضافة شكوى'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable,$data);
    }

    public function usersComplaiment(ComplaimentUsersDataTable $dataTable)
    {
        try {
     
            return $dataTable->render('backend.includes.table');

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintsRequest $request,ComplaintsService $service)
    {
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.complaints.index')]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintsRequest $request,$id,ComplaintsService $service)
    {
        try {
            $row = $service->handle($request->all(),$id);
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.complaints.index')]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

}
