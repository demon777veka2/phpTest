<?php

namespace App\Http\Controllers;

use App\pasta;
use Illuminate\Http\Request;

class taskOneController extends Controller
{
    public function home() {
        return view('taskOne');

    }

    public function addPasta(Request $request) {
        
        //Генерация хеша
        $hash = bin2hex(random_bytes(5));

        //добавление в бд
        $review = new pasta();

        $review -> pasta_name = $request->input('pasta_name');
        $review -> pasta_text = $request->input('pasta_text');
        $review -> access_limiter = $request->input('access_limiter');
        $review -> language = $request->input('language');
        $review -> hash = $hash;
        $review -> avtotization_id = 1;

        $review ->save(); 
        
        

        

       // return view('taskOneResult');
       //return view('taskOne/'.$hash, ['review' => $review->all()]);
       // return redirect()->route('/taskOne');
       return redirect('/taskOne/'.$hash);
      
    }

    public function hash($hash) {
        $review = new pasta();
        $qewr=$review->where('hash', '=', $hash)->get(); 
 
        return view('taskOneResult', ['review' => $qewr]);
        
    }
    
}
