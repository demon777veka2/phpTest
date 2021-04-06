<?php

namespace App\Http\Controllers;

use App\avtotization;
use Illuminate\Http\Request;

class avtorizationController extends Controller
{
    public function login(Request $request) {
       //авторизация, проверка существования акаунта
       $review = new avtotization;
       $bdCheckLogin=$review->where('login', '=', $request->input('login'))->get()->count() > 0; 
       $bdCheckPass = $review->where('login', '=', $request->input('login'))
                                -> where('password', '=', $request->input('password'))->get()->count() > 0;


        if ($bdCheckPass!=null){
            //заносим инфрормацию о пользователе на сайт
            $session=  $request->session()->put('login', $request->input('login'));
            return view('taskOne',['login' =>  $session] );
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
           
            return view('taskOne',['login' =>  $session] );
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
        return view('taskOne',['deleteSession' =>  "delete"]);
        
    }
}
