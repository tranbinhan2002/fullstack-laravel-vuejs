<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Banner::when(request('search'),function($query){
            $query->where('name','like','%'. request('search') .'%')->paginate(5);
        })->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'description' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $image = Storage::url($request->file('image')->storeAs('public/banner', $fileName));
        }

        $banner= Banner::create([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        $banner->save();

        return response()->json($banner, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        if ($banner) {
            return response()->json($banner, 200);
        } else {
            return response()->json('failed', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $image = Storage::url($request->file('image')->storeAs('public/banner', $fileName));
        }else {
            $image = $banner->image;
        }

        $banner->update([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        $banner->save();

        return response()->json($banner, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        if ($banner) {
            $bannerImage = $banner->image;
            $imagePath = public_path($bannerImage);
            if ($bannerImage && file_exists($imagePath)) {
                unlink($imagePath);
            }
            $banner->delete();
            return response()->json('success', 200);
        } else {
            return response()->json('failed', 404);
        }
    }

    public function changeStatus(Banner $banner)
    {
        if($banner){
            $banner->update(['status'=> !$banner->status]);
            return  response()->json('success', 200);
        }
        else{
            return response()->json('failed',404);
        }
     
    }
}
