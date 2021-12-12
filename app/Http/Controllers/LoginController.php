<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function test()
    {
        return ' token is ok';
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $userMatch = User::where(['email' => $email, 'password' => $password])->count();


        if ($userMatch == 1) {

            $userId  = User::where('email', $email)->first()->id;

            $key = env("ACCESS_TOKEN");

            $payload = array(
                "site" => "http://demo.com",
                "userEmail" => $email,
                "id" => $userId,
                "iat" => time(),
                "exp" => time()+31536000
            );

            $access_token = JWT::encode($payload, $key, 'HS256');

            $expiration = Carbon::parse()->addMonth(12)->toDateString();
            return response()->json(['access_token' => $access_token,'status' => 'Login successfully','expiration' => $expiration]);

        }else{
            return 'Invalid email or password';
        }
    }
}
