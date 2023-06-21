<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\medical;


class PassportAuthController extends Controller
{

    public function register(Request  $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required|min:6|max:255',
            'C_password' => 'required|min:6|max:255',
            'age' => 'required',
            'gender' => 'required',
            'smoke' => 'required',
            'disease'=>'required',

        ]);
        $password = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $password,
            'age' => $request->age,
            'gender' => $request->gender,
            'smoke' => $request->smoke,
            'disease'=>$request->disease,
        ]);
        $token = $user->createToken('Mohammed')->accessToken;
        header('Content-Type: application/json');
        return response()->json(['token' => $token], 200);
    }
    public function login(Request  $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,

        ];


        if (auth()->attempt($data)) {

            $token = auth()->user()->createToken('Mohammed')->accessToken;
            header('Content-Type: application/json');
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Error'], 401);
        }
    }




    public function userInfo(Request $request)
    {
        $user = auth()->User();
        return response()->json(['user' => $user], 200);
    }



    public function logout(Request $request)

    {
        $user = Auth::guard('api')->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
