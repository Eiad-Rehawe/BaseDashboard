<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Size;
use App\Services\SizeService;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\DataTables\SizeDataTable;

class SizeController extends BackendController
{
    public function __construct(SizeDataTable $dataTable, Size $model){
        parent::__construct($dataTable,$model);
    }

    public function append() {
        return [
            'rows' => (new Size())->orderBy('id', 'asc')->get()
        ];
    }
    public function index()
    {
        try {
            return view('backend.sizes.index', $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request, SizeService $service){
        try {
            $row = $service->handle($request->input());
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => 'success', 'message' => 'Added success', 'status' => 'success', 'redirect' => route('backend.Sizes.index')]);
        }
        catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    public function update(Request $request, $id, SizeService $service) {
        try {
            $row = $service->handle($request->input(), $id);
            if (is_string($row)) return response()->json(['title'=>'success', 'message' => 'Updated Success', 'status' => 'success', 'redirect' => route('backend.Sizes.index')]);
        }catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }
}