<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Genre;
use App\Screening;
use App\moviePrice;

class Movie extends Model
{
	protected $primaryKey = 'movie_id';
	public $incrementing = false;

	 public function genre()
    {
        return $this->hasOne(Genre::class, 'id','genre_id');
    }

     public function screening()
    {
        return $this->hasMany(Screening::class, 'movie_id');
    }

      public function moviePrice()
    {
        return $this->hasOne(moviePrice::class, 'id', 'price_id');
    }
}
