<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class apiUsers extends Model
{

    protected $table = "";

    protected $fillable =[
        "id",
        "name",
        "worker" 
    ];
}

