<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Slider::when(request('search'),function($query){
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
            $image = Storage::url($request->file('image')->storeAs('public/slider', $fileName));
        }

        $slider= Slider::create([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        $slider->save();

        return response()->json($slider, 200);
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
    public function edit(Slider $slider)
    {
        if ($slider) {
            return response()->json($slider, 200);
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
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $image = Storage::url($request->file('image')->storeAs('public/slider', $fileName));
        }else {
            $image = $slider->image;
        }

        $slider->update([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        $slider->save();

        return response()->json($slider, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if ($slider) {
            $sliderImage = $slider->image;
            $imagePath = public_path($sliderImage);
            if ($sliderImage && file_exists($imagePath)) {
                unlink($imagePath);
            }
            $slider->delete();
            return response()->json('success', 200);
        } else {
            return response()->json('failed', 404);
        }
    }
    
    public function changeStatus(Slider $slider)
    {
        if($slider){
            $slider->update(['status'=> !$slider->status]);
            return  response()->json('success', 200);
        }
        else{
            return response()->json('failed',404);
        }
     
    }
}
