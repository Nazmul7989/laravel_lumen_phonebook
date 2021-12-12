<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $name     = $request->input('name');
        $email    = $request->input('email');
        $phone    = $request->input('phone');
        $gender    = $request->input('gender');
        $address  = $request->input('address');
        $password = $request->input('password');

        $userExist = User::where('email',$email)->count();

        if ($userExist != 0) {
            return "Email already exists";
        }else{

            $register = User::insert([
                'name'     => $name,
                'email'    => $email,
                'phone'    => $phone,
                'gender'   => $gender,
                'address'  => $address,
                'password' => $password
            ]);

            if ($register == true) {
                return 'Registration successfull';
            }else{
                return 'Registration failed';
            }
        }
    }
}
