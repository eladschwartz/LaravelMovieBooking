<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Seat;
use Tymon\JWTAuth\Facades\JWTAuth;

class MovieController extends Controller
{
    public function index(Request $request)
    {
    	$headerAuth = $request->header('Authorization');
    	if ($headerAuth) 
    	{
    		if ($tokenFetch = JWTAuth::parseToken()->authenticate()) 
    		{
    		 	return Movie::with('genre','screening','moviePrice')->get();
    		}
    		else 
    		{
    			return response()->json(['error' => 'Unauthorized'], 401);
    		}
    	}
    }

     public function getSeats(Request $request)
    {
    	$headerAuth = $request->header('Authorization');
    	if ($headerAuth) 
    	{
    		if ($tokenFetch = JWTAuth::parseToken()->authenticate()) 
    		{
    			$data = $request->all();
    			$theater_id = $data["theaterID"];
    			return Seat::where('theater_id', $theater_id)->with('seatstate')->get();
    		}
    		else 
    		{
    			return response()->json(['error' => 'Unauthorized'], 401);
    		}
    	}
    }

      public function updateSeat(Request $request)
    {
        $headerAuth = $request->header('Authorization');
        if ($headerAuth) 
        {
            if ($tokenFetch = JWTAuth::parseToken()->authenticate()) 
            {
                $data = $request->all();
                $seat_id = $data["seatID"];
                $user_id = $data["userID"];
                $seat = Seat::find($seat_id);
                if ($seat->selected_by_user) 
                { 
                   $selectedbyuser = $seat->selected_by_user;
                   if ($selectedbyuser == $user_id)
                   {
                        $seat->update(['state_id' => 1, 'selected_by_user' =>  null]);
                   }
                } 
                else 
                {
                    $seat->update(['state_id' => 3, 'selected_by_user' => $user_id]);
                }

                return Array($seat);
                
            }
            else 
            {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
    }
}
