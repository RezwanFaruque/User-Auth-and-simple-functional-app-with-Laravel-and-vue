<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
    // user registration function
    public function register(Request $request){
        
        // validate user input request
        $request->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'phonenumber' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);


        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phonenumber = $request->phonenumber;
        $user->email = $request->email;
        
        $user->password = Hash::make($request->password);

        // saving user registration data
        $user->save();

        $accessToken = $user->createToken('authToken')->accessToken;

        if($user->save()){

            // if user saved return this resposnse
            $data = [
                "status" => "success",
                "message" => "Register Successfull",
            ];
        }else{
            // if user not save return this response
            $data = [
                "status" => "error",
                "message" => "Register Unsuccessfull",
            ];
        }

        // returning json response after each request

        return response()->json($data);

    }


    // user login method for api call
    public function login(Request $request){

        // validate usre input for login request
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);


        // authentication attempt for user
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){

            // if user request match with database create token
            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            // return response with token and user information 
            $data = [
                'status' => 'success',
                'message' => 'login successful',
                'user' => auth()->user(),
                'token' => $accessToken,
            ];

            return response()->json($data);
        }else{

            // if user login attempt data does not match
            $data = [
                'status' => 'error',
                'message' => 'login Unsuccessfull',
               
            ];

            return response()->json($data);
        }
    }
}
