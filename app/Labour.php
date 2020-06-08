<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Labour extends Eloquent
{
        protected $fillable = [
        'name','phone'
    ];
    public function jointype()
    {
  		return $this->belongsTo(Type::class,'typeId');
	  }
    public function joinarea()
  	{
  		return $this->belongsTo(Area::class,'areaId');
    }
    public function joinuser()
    {
      return $this->belongsTo(User::class,'userId');
    }

}
