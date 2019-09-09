<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
	protected $hidden = array('movie_id');


     public function movie()
    {
    	  return $this->belongsTo(Movie::class, 'movie_id');
    }

      public function theater()
    {
    	  return $this->hasMany(Theater::class, 'theater_id');
    }
}
