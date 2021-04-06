<?php

namespace App\Http\Controllers;

use App\pasta;
use App\avtotization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class taskOneController extends Controller
{
    public function home() {
        $review = new pasta();
        //вывод 10 открытых паст
        $tenOpenPast=$review->where('access_limiter', '=', 'public')->get()->take(10); 

         //вывод паст авторизированного пользователя
         if(!empty(session('login'))) {
            $dbAvtotization = new avtotization();
            $loginId=$dbAvtotization->where('login', '=', session('login'))->get("id"); 
            $loginId = preg_replace("/[^0-9]/", '', $loginId);

            $myPasta=$review->where('avtotization_id', '=', $loginId)->paginate(10);
            return view('taskOne', ['tenOpenPast' => $tenOpenPast,'myPasta' => $myPasta ]);
         }  

        return view('taskOne', ['tenOpenPast' => $tenOpenPast]);
    }

    public function addPasta(Request $request) {
        $serchId = new avtotization;

        //Генерация хеша
        $hash = bin2hex(random_bytes(5));
 
        //поиск пользователя
        if (!empty(session('login'))){
            $loginId=$serchId->where('login', '=', session('login'))->get('id'); 
            $loginId = preg_replace("/[^0-9]/", '', $loginId);
        }
        else $loginId=1;

        //добавление в бд
        $review = new pasta();
        $review -> pasta_name = $request->input('pasta_name');
        $review -> pasta_text = $request->input('pasta_text');
        $review -> access_limiter = $request->input('access_limiter');
        $review -> language = $request->input('language');
        $review -> hash = $hash;
        $review -> avtotization_id = $loginId;

        $review ->save(); 
        
       return redirect('/taskOne/'.$hash);
      
    }

    public function hash($hash) {
        $review = new pasta();

        //вывод 10 открытых паст
        $tenOpenPast=$review->where('access_limiter', '=', 'public')->get()->take(10);
        
        $bdcheck=$review->where('hash', '=', $hash)->get()->count() > 0; 
           //проверка на существование hash
        if($bdcheck==null) 
            return view('taskOneResult', ['error' => 'Такой пасты нет' ]);

            $bdInfo=$review->where('hash', '=', $hash)->get(); 
        
            //вывод паст авторизированного пользователя
            if(!empty(session('login'))) {
                $dbAvtotization = new avtotization();
                
                $loginId=$dbAvtotization->where('login', '=', session('login'))->get("id"); 
                $loginId = preg_replace("/[^0-9]/", '', $loginId);
                
                $myPasta=$review->where('avtotization_id', '=', $loginId)->paginate(10);
                return view('taskOneResult', ['review' => $bdInfo, 'tenOpenPast' => $tenOpenPast,'myPasta' => $myPasta ]);
            }   

        return view('taskOneResult', ['review' => $bdInfo, 'tenOpenPast' => $tenOpenPast ]);
        
    }



    
}
