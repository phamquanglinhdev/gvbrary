<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $acceptItems = \App\Models\Request::where("user_id","=",backpack_user()->id)->where("status","=",0)->where("order_id","=",null)->get();
        $banItems= \App\Models\Request::where("user_id","=",backpack_user()->id)->where("status","=",2)->where("order_id","=",null)->get();
        $waitItems = \App\Models\Request::where("user_id","=",backpack_user()->id)->where("status","=",1)->where("order_id","=",null)->get();
        return view("client.cart",['acceptItems'=>$acceptItems,'banItems'=>$banItems,'waitItems'=>$waitItems]);
    }
    public function makeOrder(Request $data){

        $total = 0;
        $items = \App\Models\Request::where("user_id","=",backpack_user()->id)->where("order_id","=",null)->get();
        foreach ($items as $item){
            $total+=$item->Product()->first()->price;
        }
        if($data->payment_method == "coin"){
            if(backpack_user()->coin < $total){
                return redirect()->back()->with("out-of-coin","Không đủ coin để thanh toán");
            }else{
                User::find(backpack_user()->id)->update(['coin'=>backpack_user()->coin-$total]);
                $this->addOrder($data,$items);
                return redirect()->back()->with("success","Đã thuê thành công");
            }
        }
        if($data->payment_method == "cash"){
            if(backpack_user()->role > 2){
                return redirect()->back()->with("out-of-coin","Bạn không phải học sinh GVB, không thể dùng chức năng này");
            }else{
                $this->addOrder($data,$items);
                return redirect()->back()->with("success","Đã thuê thành công");
            }
        }
    }
    public function  addOrder($data,$items){
        $orderData = [
            'customer_id'=>backpack_user()->id,
            'address'=>$data->address,
            'phone'=>$data->phone,
            'note'=> $data->note ?? null,
            'payment_method'=>$data->payment_method == "coin" ? 0:1,
        ];
        $order=Order::create($orderData);
        foreach ($items as $item){
            \App\Models\Request::find($item->id)->update(["order_id"=>$order->id]);
            $publisher = User::find($item->owner_id);
            $publisher->update(['coin'=>$publisher->coin + 0.75*($item->Product()->first()->price)]);
            $nof = [
                'user_id'=>$publisher->id,
                'title'=>"Nhận tiền cho thuê truyện",
                'message'=>"Bạn nhận được ".number_format( 0.75*($item->Product()->first()->price))."đ từ việc cho thuê cuốn sách '".$item->Product()->first()->name."'",
            ];
            Notification::create($nof);
        }
    }
}
