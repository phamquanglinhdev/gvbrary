<?php

namespace App\Http\Controllers;

use App\Mail\RequestBook;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index(){
        $members =  Product::where("category_id","=",2)->where("status","=","0")->get();
        $libraries =  Product::where("category_id","=",1)->where("status","=","0")->get();
        $frees =  Product::where("category_id","=",3)->where("status","=","0")->get();
        $frees_2 =  Product::where("status","=","0")->where("price","=",0)->orWhere("price","=",null)->get();
        $reviews = Review::limit(6)->get();
        //return $members;
        return view("client.index",['libraries'=>$libraries,'members'=>$members,"frees"=>$frees,"frees_2"=>$frees_2,"reviews"=>$reviews]);
    }

}
