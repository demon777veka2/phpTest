<?php

namespace App\Http\Controllers\TaskOne;

use App\pasta;
use App\avtotization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;

class taskOneController extends Controller
{
    public function home()
    {
        $pathClass = new taskOneController;
        $review = new pasta;
        $dbAvtotization = new avtotization;

        //проверка cуществования неизвестного пользователя
        $checkFirstId = $dbAvtotization->where('id', '=', 1)->count() > 0;
        if ($checkFirstId == null) {
            $dbAvtotization->id = 1;
            $dbAvtotization->login = "Noname";
            $dbAvtotization->password = "Noname";

            $dbAvtotization->save();
        }

        $tenOpenPast = $pathClass->tenOpenPast();
        $pathClass->deleteExpiredRecord();

        //вывод паст авторизированного пользователя
        if (!empty(session('login'))) {
            $dbAvtotization = new avtotization();
            $loginId = $dbAvtotization->where('login', '=', session('login'))->get("id");
            $loginId = preg_replace("/[^0-9]/", '', $loginId);

            $myPasta = $review->where('avtotization_id', '=', $loginId)->paginate(10);
            return view('taskOne', ['tenOpenPast' => $tenOpenPast, 'myPasta' => $myPasta]);
        }

        return view('taskOne', ['tenOpenPast' => $tenOpenPast]);
    }

    public function addPasta(Request $request)
    {
        $serchId = new avtotization;

        //Генерация хеша
        $hash = bin2hex(random_bytes(5));

        //поиск пользователя
        if (!empty(session('login'))) {
            $loginId = $serchId->where('login', '=', session('login'))->get('id');
            $loginId = preg_replace("/[^0-9]/", '', $loginId);
        } else $loginId = 1;

        //Выставление времени удаления
        $arrDTime = explode(' ', $request->input('date_delete'));

        $date_delete = ""; // срок хранения без ограничений
        if ($arrDTime[1] == "мин") $date_delete = Carbon::now()->addMinute(1);
        if ($arrDTime[1] == "час" || $arrDTime[1] == "часа")  $date_delete = Carbon::now()->addHours($arrDTime[0]);
        if ($arrDTime[1] == "день")  $date_delete = Carbon::now()->addDays(1);
        if ($arrDTime[1] == "неделя")  $date_delete = Carbon::now()->addWeek(1);
        if ($arrDTime[1] == "месяц")  $date_delete = Carbon::now()->addMonth(1);

        //добавление в бд
        $review = new pasta();
        $review->pasta_name = $request->input('pasta_name');
        $review->pasta_text = $request->input('pasta_text');
        $review->access_limiter = $request->input('access_limiter');
        if ($date_delete != "") $review->date_delete = $date_delete;
        $review->language = $request->input('language');
        $review->hash = $hash;
        $review->avtotization_id = $loginId;

        $review->save();

        return redirect('/taskOne/' . $hash);
    }

    public function hash($hash)
    {
        $pathClass = new taskOneController;
        $review = new pasta;
        $dbAvtotization = new avtotization;

        $tenOpenPast = $pathClass->tenOpenPast();

        //проверка на существование hash
        $bdcheck = $review->where('hash', '=', $hash)->get()->count() > 0;
        if ($bdcheck == null)
            return view('taskOneResult', ['error' => 'Такой пасты нет']);

        //получение id через логин
        if (!empty(session('login'))) {
            $loginId = $dbAvtotization->where('login', '=', session('login'))->get("id");
            $loginId = preg_replace("/[^0-9]/", '', $loginId);
        } else $loginId = 1;

        //проверка на ограничение unlisted
        $checkUnlisted = $review->where('hash', '=', $hash)->where('access_limiter', '=', "unlisted")->get()->count() > 0;

        if ($checkUnlisted != null) {

            //получаем id pasta
            $avtotization_id = $review->where('hash', '=', $hash)->get("avtotization_id");
            $avtotization_id = preg_replace("/[^0-9]/", '', $avtotization_id);

            if ($loginId != $avtotization_id) {
                $checkNullUnlisted = $review->where('hash', '=', $hash)->where('access_limiter_id', '=', null)->get()->count() > 0;

                if ($checkNullUnlisted != null)
                    $review->where('hash', '=', $hash)->update(['access_limiter_id' => $loginId]);
                else {
                    $access_limiter_id = $review->where('hash', '=', $hash)->get("access_limiter_id");
                    $access_limiter_id = preg_replace("/[^0-9]/", '', $access_limiter_id);

                    if ($loginId !=  $access_limiter_id)
                        return view('taskOneResult', ['error' => 'Доступ закрты']);
                }
            }
        }

        $pathClass->deleteExpiredRecord();

        $bdInfo = $review->where('hash', '=', $hash)->get();

        //вывод паст авторизированного пользователя
        if (!empty(session('login'))) {
            $myPasta = $review->where('avtotization_id', '=', $loginId)->paginate(10);
            return view('taskOneResult', ['review' => $bdInfo, 'tenOpenPast' => $tenOpenPast, 'myPasta' => $myPasta]);
        }
        return view('taskOneResult', ['review' => $bdInfo, 'tenOpenPast' => $tenOpenPast]);
    }

    //удаление из бд записей с истекшим сроком
    public function deleteExpiredRecord()
    {
        $review = new pasta;
        $review->where('date_delete', '<', Carbon::now())->delete();
    }

    //вывод 10 открытых паст
    public function tenOpenPast()
    {
        $review = new pasta;
        $tenOpenPast = $review->where('access_limiter', '=', 'public')->get()->take(10);
        return  $tenOpenPast;
    }
}
