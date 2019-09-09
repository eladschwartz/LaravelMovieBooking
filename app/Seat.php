<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SeatState;

class Seat extends Model
{
   protected $fillable = array('state_id', 'selected_by_user');
   protected $hidden = array('state_id');

    public function seatstate()
    {
        return $this->hasOne(SeatState::class, 'id','state_id');
    }

}
