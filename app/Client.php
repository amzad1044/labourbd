<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Client extends Eloquent
{
        protected $fillable = [
        	'name', 'email' ,'phone', 'password'
    	];
}
