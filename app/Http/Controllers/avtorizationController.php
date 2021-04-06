<?php

namespace App\Http\Controllers;

use App\pasta;
use App\avtotization;
use Illuminate\Http\Request;

class avtorizationController extends Controller
{
    public function login(Request $request) {
       //авторизация, проверка существования акаунта
       $review = new avtotization;
       $bdCheck = $review->where('login', '=', $request->input('login'))
                                -> where('password', '=', $request->input('password'))->get()->count() > 0;


        if ($bdCheck!=null){
            //заносим инфрормацию о пользователе на сайт
            $session=  $request->session()->put('login', $request->input('login'));

            $dbPasta = new pasta();
            //вывод 10 открытых паст
            $tenOpenPast=$dbPasta->where('access_limiter', '=', 'public')->get()->take(10); 

             //вывод паст авторизированного пользователя
             $loginId=$review->where('login', '=', $request->input('login'))->get("id"); 
             $loginId = preg_replace("/[^0-9]/", '', $loginId);
 
             $dbAvtotization = new avtotization;
             
             $myPasta=$dbPasta->where('avtotization_id', '=', $loginId)->get();        
   
            return view('taskOne',['login' =>  $session,'tenOpenPast' => $tenOpenPast,'myPasta' => $myPasta  ]);
        }
        return view('avtorization' ,['error' =>  "Вы ввели не правильно логин или пароль"]);
        
        
    }

    //регистрация нового пользователя
    public function registration(Request $request) {
        //проверка на существование логина
        $review = new avtotization;
        $bdcheck=$review->where('login', '=', $request->input('login'))->get()->count() > 0; 

      if ($bdcheck==null){
        if ($request->input('repeat_password')==$request->input('password')){
            //добавление в бд
            $review -> login = $request->input('login');
            $review -> password = $request->input('password');

            $review ->save(); 
            //добавление в сессию логина
            $session=  $request->session()->put('login', $request->input('login'));

            $dbPasta = new pasta();
            //вывод 10 открытых паст
            $tenOpenPast=$dbPasta->where('access_limiter', '=', 'public')->get()->take(10); 
           
            //вывод паст авторизированного пользователя
            $loginId=$review->where('login', '=', $request->input('login'))->get("id"); 
            $loginId = preg_replace("/[^0-9]/", '', $loginId);
            
            $myPasta=$dbPasta->where('avtotization_id', '=', $loginId)->get();        

            return view('taskOne',['login' =>  $session,'tenOpenPast' => $tenOpenPast,'myPasta' => $myPasta  ]);
        } 
        return view('registration', ['error' => 'Пароли не совпадают, попробуйте еще раз ']);
      }
       return view('registration', ['error' => 'Логин уже такой есть' ]);
     }

     public function registrationView() {
         return view('registration');
         
     }

     public function loginView() {
         return view('avtorization');
         
     }
     public function loginExit() {
        $review = new pasta();
        //вывод 10 открытых паст
        $tenOpenPast=$review->where('access_limiter', '=', 'public')->get()->take(10); 

        return view('taskOne',['deleteSession' =>  "delete",'tenOpenPast' => $tenOpenPast ] );
        
    }
}
