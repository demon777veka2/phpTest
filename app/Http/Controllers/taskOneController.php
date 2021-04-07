<?php

namespace App\Http\Controllers;

use App\pasta;
use App\avtotization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;


class taskOneController extends Controller
{
    public function home() {
        $review = new pasta();
        //вывод 10 открытых паст
        $tenOpenPast=$review->where('access_limiter', '=', 'public')->get()->take(10); 

         //удаление из бд записей с истекшим сроком
         $review->where('date_delete', '<', Carbon::now())->delete();

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

        //Выставление времени удаления
        $arrDTime = explode(' ', $request->input('date_delete'));

        if ($arrDTime[1] == "мин") $date_delete= Carbon::now()->addMinute(1);
        if ($arrDTime[1] == "час" || $arrDTime[1] == "часа")  $date_delete= Carbon::now()->addHours($arrDTime[0]);
        if ($arrDTime[1] == "день")  $date_delete= Carbon::now()->addDays(1);
        if ($arrDTime[1] == "неделя")  $date_delete= Carbon::now()->addWeek(1);
        if ($arrDTime[1] == "месяц")  $date_delete= Carbon::now()->addMonth(1);

        //добавление в бд
        $review = new pasta();
        $review -> pasta_name = $request->input('pasta_name');
        $review -> pasta_text = $request->input('pasta_text');
        $review -> access_limiter = $request->input('access_limiter');
        $review -> date_delete = $date_delete;
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

            //удаление из бд записей с истекшим сроком
            $review->where('date_delete', '<', Carbon::now())->delete(); 

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
