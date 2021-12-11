<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){

        if(isset($request->keyword)){
           $products =  Product::where("name","like","%".$request->keyword."%")->get();
           $categories =  Category::where("name","like","%".$request->keyword."%")->get();
           return  view("client.result",["products"=>$products,"categories"=>$categories]);

        }else{
            return view("errors.404");
        }
    }
}
