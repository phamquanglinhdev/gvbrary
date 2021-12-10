<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function makeRequest(Request $data){

        $exp =  date_create($data->expiry);
        $product =  Product::where("slug","=",$data->slug)->first();
        if(isset($product) && $product->status==0){
            $checks = \App\Models\Request::where("user_id","=",backpack_user()->id)->get();
            foreach ($checks as $check){
                if ($check->product_id == $product->id){
                    return redirect()->back()->with("fail","Bạn đã gửi yêu cầu một lần !");
                }
            }

            $request = [
                'product_id'=>$product->id,
                'owner_id'=>$product->Published()->first()->id,
                'user_id'=>backpack_user()->id,
                'order_id'=>null,
                'expiry'=>date_format($exp,"Y/m/d"),
                'status'=>1, // đang chờ
            ];
            \App\Models\Request::create($request);
            return  redirect()->back()->with("success","Đã gửi yêu cầu mượn sách");
        }else{
            return view("errors.404");
        }
    }
    public function acceptRequest($id){
        if(backpack_auth()->check()){
            $request =  \App\Models\Request::find($id);
            if(isset($request->id) && $request->owner_id==backpack_user()->id){
                $request->update(['status'=>0]);
                return redirect()->back()->with("success","Đã chấp nhận");
            }
        }else{
            return redirect("/");
        }
    }

    public function cancelRequest($id){
        if(backpack_auth()->check()){
            $request =  \App\Models\Request::find($id);
            if(isset($request->id) && $request->owner_id==backpack_user()->id){
                $request->update(['status'=>2]);
                return redirect()->back()->with("fail","Đã từ chối");
            }
        }else{
            return redirect("/");
        }

    }
}
