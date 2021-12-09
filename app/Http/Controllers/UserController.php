<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($email = null ){
        if($email==null){
            $email = backpack_user()->email;
        }
        $user = User::where("email","=",$email)->first();
        if($user->name != null){
            $products=Product::where("published_id","=",$user->id)->get();
            return view('client.profile',['user'=>$user,'products'=>$products]);
        }else{
            return view("errors.404");
        }

    }
}
