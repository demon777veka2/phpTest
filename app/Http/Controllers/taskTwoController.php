<?php

namespace App\Http\Controllers;

use App\apiUsers;
use Illuminate\Http\Request;

class taskTwoController extends Controller
{
    public function home()
    {
        return view('taskTwo');
    }
}
