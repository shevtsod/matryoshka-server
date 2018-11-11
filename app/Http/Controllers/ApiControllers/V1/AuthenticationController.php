<?php

namespace App\Http\Controllers\ApiControllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiControllers\V1;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    /**
     * Handle an authentication attempt
     * 
     * Testing script:
     * 
     * curl -X POST localhost:8000/api/v1/login
     *  -H "Accept: application/json"
     *  -H "Content-type: application/json"
     *  -d '{ "email": "email", "password": "password" }'
     * 
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], 200);
        }

        return response()->json(['error' => 'Unauthorised'], 401);
    }


    /**
     * Handle a registration attempt
     * 
     * Testing script:
     * 
     * curl -X POST http://localhost:8000/api/v1/register
     *  -H "Accept: application/json"
     *  -H "Content-Type: application/json"
     *  -d '{ "name": "First Last", "email": "email", "password": "password" }'
     * 
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        $validator = Validator::make($credentials, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);
        $success['token'] = $user->createToken('MyApp')->accessToken;

        return response()->json(['success' => $success], 200);
    }

    /**
     * Return currently authenticated user's information
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }
}
