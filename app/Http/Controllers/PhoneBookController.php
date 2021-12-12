<?php

namespace App\Http\Controllers;

use App\Models\Phone_Book;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = env("ACCESS_TOKEN");
        $token = $request->input('access_token');
        $decodedData = JWT::decode($token, new Key($key, 'HS256'));
        $decodeArray = (array)$decodedData;
        $userId = $decodeArray['id'];

       $allData = Phone_Book::where('user_id', $userId)->get();
       return $allData;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key = env("ACCESS_TOKEN");
        $token = $request->input('access_token');
        $decodedData = JWT::decode($token, new Key($key, 'HS256'));
        $decodeArray = (array)$decodedData;
        $userId = $decodeArray['id'];

        $name    = $request->input('name');
        $email   = $request->input('email');
        $phone1  = $request->input('phone1');
        $phone2  = $request->input('phone2');
        $address = $request->input('address');

        $result = Phone_Book::insert([
            'name'    => $name,
            'email'   => $email,
            'phone1'  => $phone1,
            'phone2'  => $phone2,
            'address' => $address,
            'user_id' => $userId
        ]);

        if ($result == true) {
            return 'Phone book saved successfully';
        }else {
            return 'Phone book save failed';
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone_Book  $phone_Book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone_Book $phone_Book, Request $request)
    {
        $key = env("ACCESS_TOKEN");
        $token = $request->input('access_token');
        $decodedData = JWT::decode($token, new Key($key, 'HS256'));
        $decodeArray = (array)$decodedData;
        $userId = $decodeArray['id'];

        $id = $request->input('id');

        $result = Phone_Book::where(['user_id' => $userId, 'id' => $id])->delete();

        if ($result == true) {
            return 'Phone book deleted successfully';
        }else {
            return 'Phone book delete failed';
        }
    }
}
