<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	protected $hidden = array('movie_id', 'id');


    public function movie()
    {
    	  return $this->belongsTo(Movie::class);
    }

}
