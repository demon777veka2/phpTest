<?php

namespace App\Http\Controllers\TaskTwo;

use App\apiUsers;
use Illuminate\Http\Request;

class taskTwoController extends Controller
{
    public function home()
    {
        return view('taskTwo');
    }
}
