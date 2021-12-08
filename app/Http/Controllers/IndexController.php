<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $members =  Product::where("category_id","=",2)->get();
        $libraries =  Product::where("category_id","=",1)->get();
        $frees =  Product::where("category_id","=",3)->get();
        $frees_2 =  Product::where("price","=",null)->get();
        $reviews = Review::limit(6)->get();
        //return $members;
        return view("client.index",['libraries'=>$libraries,'members'=>$members,"frees"=>$frees,"frees_2"=>$frees_2,"reviews"=>$reviews]);
    }
}
