<?php

namespace App\Services;

use App\Models\Size;
use Illuminate\Support\Facades\DB;

class SizeService {
    public function handle($request, $id = null) {
        try {
            DB::beginTransaction();
            $data = $request->all(); 
            $row = Size::updateOrCreate(['id' => $id], $data);
            DB::commit();
            return $row;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }
}
