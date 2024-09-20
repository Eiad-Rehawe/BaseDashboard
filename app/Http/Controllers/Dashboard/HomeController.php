<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $today = User::whereDate('created_at', Carbon::today())->get();
        $this_week = User::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $this_month = User::whereMonth('created_at',Carbon::now()->month)->get();
        return response()->json([
            'today'=>$today,
            'this_week'=>$this_week,
            'this_month'=>$this_month
        ]);
    }
}
