<?php

namespace App\Http\Controllers\TaskOne;

use App\pasta;
use App\avtotization;
use Illuminate\Http\Request;
use Carbon\Carbon;

class avtorizationController extends Controller
{
    public function login(Request $request)
    {
        $pathClassTaskOne = new taskOneController;
        $review = new avtotization;
        $dbPasta = new pasta();

        $pathClassTaskOne->deleteExpiredRecord();

        //авторизация, проверка существования акаунта
        $bdCheck = $review->where('login', '=', $request->input('login'))
            ->where('password', '=', $request->input('password'))->get()->count() > 0;

        if ($bdCheck != null) {
            //заносим инфрормацию о пользователе на сайт
            $session =  $request->session()->put('login', $request->input('login'));

            $tenOpenPast = $pathClassTaskOne->tenOpenPast();

            //вывод паст авторизированного пользователя
            $loginId = $review->where('login', '=', $request->input('login'))->get("id");
            $loginId = preg_replace("/[^0-9]/", '', $loginId);

            $myPasta = $dbPasta->where('avtotization_id', '=', $loginId)->paginate(10);

            return view('taskOne', ['login' =>  $session, 'tenOpenPast' => $tenOpenPast, 'myPasta' => $myPasta]);
        }
        return view('avtorization', ['error' =>  "Вы ввели не правильно логин или пароль"]);
    }

    //регистрация нового пользователя
    public function registration(Request $request)
    {
        $pathClassTaskOne = new taskOneController;
        $review = new avtotization;
        $dbPasta = new pasta;

        $pathClassTaskOne->deleteExpiredRecord();

        //проверка на существование логина
        $bdcheck = $review->where('login', '=', $request->input('login'))->get()->count() > 0;

        if ($bdcheck == null) {
            if ($request->input('repeat_password') == $request->input('password')) {
                //добавление в бд
                $review->login = $request->input('login');
                $review->password = $request->input('password');

                $review->save();

                //добавление в сессию логина
                $session =  $request->session()->put('login', $request->input('login'));

                $tenOpenPast = $pathClassTaskOne->tenOpenPast();

                //вывод паст авторизированного пользователя
                $loginId = $review->where('login', '=', $request->input('login'))->get("id");
                $loginId = preg_replace("/[^0-9]/", '', $loginId);

                $myPasta = $dbPasta->where('avtotization_id', '=', $loginId)->paginate(10);

                return view('taskOne', ['login' =>  $session, 'tenOpenPast' => $tenOpenPast, 'myPasta' => $myPasta]);
            }
            return view('registration', ['error' => 'Пароли не совпадают, попробуйте еще раз ']);
        }
        return view('registration', ['error' => 'Логин уже такой есть']);
    }

    public function registrationView()
    {
        return view('registration');
    }

    public function loginView()
    {
        return view('avtorization');
    }

    //удаление сессий
    public function loginExit()
    {
        $review = new pasta();
        $pathClassTaskOne = new taskOneController;

        $pathClassTaskOne->deleteExpiredRecord();
        $tenOpenPast = $pathClassTaskOne->tenOpenPast();

        return view('taskOne', ['deleteSession' =>  "delete", 'tenOpenPast' => $tenOpenPast]);
    }
}
