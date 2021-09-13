<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return Product::when(request('search'),function($query){
            $query->where('name','like','%'. request('search') .'%')->paginate(8);
        })->with('category','user')->paginate(8);
    }
    public function productFilter($id) {
        return Product::when(request('search'),function($query){
            $query->where('name','like','%'. request('search') .'%')->paginate(8);
        })->where('category_id',$id)->with('category','user')->paginate(8);
    }
}
