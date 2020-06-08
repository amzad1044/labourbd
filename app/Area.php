<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Area extends Eloquent
{
    protected $fillable = [
        'name'
    ];
}
