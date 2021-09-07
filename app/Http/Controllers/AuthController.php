<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required| email| unique:users',
            'password' => 'required| min:6| confirmed',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
    public function login(Request $request){
       $this->validate($request,[
           'email'=> ['required','email'],
           'password' => ['required']
       ]);
       if(Auth::attempt($request->only('email','password'))){
           return response()->json(Auth::user(),200);
       }
       throw ValidationException::withMessages([
           'email' => ['The provided credentials are incorrect.']
       ]);
    }

    public function logout() {
        Auth::logout();
    }
}
