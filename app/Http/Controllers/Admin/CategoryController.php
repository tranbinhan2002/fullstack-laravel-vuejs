<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::when(request('search'),function($query){
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
        ]);
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return response()->json('success', 200);
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
    public function edit(Category $category)
    {
        if($category){
            return response()->json($category,200);
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
    public function update(Request $request,Category $category)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return response()->json('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();
            return response()->json('success', 200);
        }
        else{
            return response()->json('failed',404);
        }
    }

    public function changeStatus(Category $category)
    {
        if($category){
            $category->update(['status'=> !$category->status]);
            return  response()->json('success', 200);
        }
        else{
            return response()->json('failed',404);
        }
     
    }
}
