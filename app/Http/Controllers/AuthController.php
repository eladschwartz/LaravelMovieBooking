<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\QueryException;
use HttpException;
use Auth;

class AuthController extends Controller
{
	public function register(Request $data)
	{
		try
		{
			$user = User::create([
				'first_name' => $data['firstName'],
				'last_name' => $data['lastName'],
				'email' => $data['email'],
				'phoneNumber' =>$data['phoneNumber'],
				'password' => Hash::make($data['password']),
			]);
			$token = auth()->login($user);

			return $this->respondWithToken($token);
		} 
		catch (QueryException $e) 
		{
			$errorCode = $e->errorInfo[1];
			if($errorCode == 1062)
			{
			  throw new \ErrorException($e->getMessage());
			}
		}
	}

	public function login()
	{
		$credentials = request(['email', 'password']);

		if (! $token = auth()->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}

		return $this->respondWithToken($token);
	}

	public function logout()
	{
		auth()->logout();

		return response()->json(['message' => 'Successfully logged out']);
	}

	protected function respondWithToken($token)
	{
		$currentUser = Auth::user();

		return response()->json([
			'user_details' =>  $currentUser,
			'access_token' => $token,
			'token_type'   => 'bearer',
			'expires_in'   => auth()->factory()->getTTL() * 60
		]);
	}
}
