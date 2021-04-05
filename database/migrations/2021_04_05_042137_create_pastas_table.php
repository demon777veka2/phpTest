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
            $table->increments('id');
            $table->string('pasta_name');
            $table->text('pasta_text');
            $table->string('access_limiter');
            $table->string('language');
            $table->string('hash');
            $table->integer('avtotization_id')->unsigned();
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
