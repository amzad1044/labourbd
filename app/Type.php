<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Type extends Eloquent
{
    protected $fillable = [
        'name'
    ];
}

