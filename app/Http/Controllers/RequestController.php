<?php

namespace App\Http\Controllers;

use App\Mail\RequestBook;
use App\Mail\respondRequest;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                if ($check->product_id == $product->id && $check->order_id==null){
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
            Mail::to($product->Published()->first()->email)->send(new RequestBook(backpack_user()->name,$product->name));
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
                Mail::to($request->User()->first()->email)->send(new respondRequest(1,$request->Product()->first()->name));
                $message = "Yêu cầu mượn cuốn \"".$request->Product()->first()->name."\" đã được chấp nhận , vào ngay giỏ hàng để kiểm tra";
                Notification::create(["user_id"=>$request->User()->first()->id,"type"=>0,"title"=>"Yêu cầu mượn sách được chấp nhận","message"=>$message]);
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
                Mail::to($request->User()->first()->email)->send(new respondRequest(0,$request->Product()->first()->name));
                $message = "Yêu cầu mượn cuốn \"".$request->Product()->first()->name."\" đã bị từ chối";
                Notification::create(["user_id"=>$request->User()->first()->id,"type"=>0,"title"=>"Yêu cầu mượn sách bị từ chối","message"=>$message]);
                return redirect()->back()->with("fail","Đã từ chối");
            }
        }else{
            return redirect("/");
        }

    }
}
