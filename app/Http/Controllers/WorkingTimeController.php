<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WorkingTimeController extends Controller
{
    public function index(Request $request)
    {
        $times = DB::table('working_times')->get();
        return $times;
    }
}
