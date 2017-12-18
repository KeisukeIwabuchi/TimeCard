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
        $user_id = $request->input('id');
        $start = $request->input('start_time');

        $result = DB::table('working_times')->insert([
            'user_id' => $user_id,
            'year' => 2017,
            'month' => 12,
            'date' => 19,
            'start_time' => $start
        ]);

        return $result;
    }

    public function update(Request $request, $id)
    {
        $end = $request->input('end_time');
        DB::table('working_times')->where('id', $id)->update([
            'end_time' => $end
        ]);
    }
}
