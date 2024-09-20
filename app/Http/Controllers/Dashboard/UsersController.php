<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(UsersDataTable $dataTable,User $user)
    {
        // $this->middleware(['permission:Display Users|عرض المستخدمين'], ['only' => ['index']]);
        // $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable,$user);
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

   

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

   
}
