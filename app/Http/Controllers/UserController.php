<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')->get();
        return $users;
    }
}
