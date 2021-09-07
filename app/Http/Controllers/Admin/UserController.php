<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::when(request('search'),function($query){
            $query->where('name','like','%'. request('search') .'%')->orWhere('email','like','%'. request('search') .'%')->paginate(5);
        })->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'avatar' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'role_user' => 'required'
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $image = Storage::url($request->file('avatar')->storeAs('public/user', $fileName));
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'avatar' => $image,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'address' => $request->address,
            'role_user' => $request->role_user
        ]);

        $user->save();

        return response()->json($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user){
            return response()->json($user,200);
        }else{
            return response()->json('failed',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'avatar' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'birthday' => 'required',
                'gender' => 'required',
                'role_user' => 'required'
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
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$user->password,
                'phone' => $request->phone,
                'avatar' => $image,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'address' => $request->address,
                'role_user' => $request->role_user
            ]);

            $user->save();
       
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user){
            $user->delete();
            return response()->json('success', 200);
        }
        else{
            return response()->json('failed',404);
        }
    }
    public function changePassword(Request $request,User $user) {
        $this->validate($request, [
            'new_password' => 'required| min:6',
            'confirm_password' => 'required|same:new_password'
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return response()->json('success',200);
    }
    public function changeStatus(User $user)
    {
        if($user){
            $user->update(['status'=> !$user->status]);
            return  response()->json('success', 200);
        }
        else{
            return response()->json('failed',404);
        }
     
    }
}
