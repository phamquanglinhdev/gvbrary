<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category="thu-vien-truong.aspx",$page=1){
        $category = Category::where("slug","=",$category)->first();
        if(isset($category->name)){
           $products =  $category->Products()->get();
           if($products->first()!=null){
               return view("client.products",['category'=>$category,'products'=>$products,"page"=>$page]);
           }
            return view("client.products",['category'=>$category,'products'=>$products,"page"=>$page]);
        }else{
            return  view("errors.404");
        }
    }
    public function show($slug="sp1"){
        return view("client.product");
    }
}
