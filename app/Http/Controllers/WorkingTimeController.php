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

    public function store(Request $request)
    {
        $result = DB::table('working_times')->insert([
            'user_id'    => $request->input('id'),
            'start_time' => $request->input('start_time')
        ]);

        return $request->input('id');
    }

    public function update(Request $request, $id)
    {
        DB::table('working_times')
        ->where('user_id', $id)
        ->whereNull('end_time')
        ->update(['end_time' => $request->input('end_time')]);

        return $id;
    }
}
