<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $image = '';
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $image = Storage::url($request->file('avatar')->storeAs('public/user', $fileName));
        }
        else{
            $image = $user->avatar;
        }

        $user->name = $request->name;
        $user->email = Auth::user()->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->avatar = $image;
        $user->address = $request->address;
        $user->password = Auth::user()->password;
        $user->save();


        return response()->json('success', 200);
    }
    public function changePassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required| min:6',
            'confirm_password' => 'required|same:new_password'
        ]);
    
        $user = User::find(Auth::id());
    
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['errors' => ['current'=> ['Current password does not match']]], 
        422);
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return response()->json('success',200);
    }
}
