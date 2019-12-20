<?php

namespace App\application;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $pk = 'g_id';
    protected $table ='good';
    public $timestamps = false;
}
