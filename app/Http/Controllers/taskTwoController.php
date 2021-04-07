<?php

namespace App\Http\Controllers;

use App\apiUsers;
use Illuminate\Http\Request;

class taskTwoController extends Controller
{
    public function home() {
        
        $client = new GuzzleHttp\Client();
         $res = $client->get('https://api.github.com/user', ['auth' => ['user', 'pass']]);
          echo $res->getStatusCode();
           // 200 echo $res->getBody();
            // { "type": "User", ....


        return response()->json(apiUsers::get(),200);

    }  

}
