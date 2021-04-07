<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastas', function (Blueprint $table) {
            $table->increments('id');                               //ID
            $table->string('pasta_name');                           //Название пасты
            $table->text('pasta_text');                             //Текст пасты  
            $table->string('access_limiter');                       //Потуп к пасте
            $table->integer('access_limiter_id')->nullable();       //ID пользователя при переходе на пасту с доступом unlisted
            $table->dateTime('date_delete')->nullable();            //Дата удаление
            $table->string('language');                             //язык для подсветки
            $table->string('hash');                                 //Хеш страницы
            $table->integer('avtotization_id')->unsigned();         //Внешний ключ класса avtotization
            $table->foreign('avtotization_id')->references('id')->on('avtotizations');
    
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pastas');
    }
}
