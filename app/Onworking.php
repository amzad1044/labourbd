<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Onworking extends Eloquent
{
    protected $fillable = [
        'clientName'
    ];
    public function joinlab()
    {
  		return $this->belongsTo(Labour::class,'labourid');
	}
}
