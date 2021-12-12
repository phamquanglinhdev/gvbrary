<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index(){
        return view("client.coin");
    }
    public function store(Request $request){
        $coin = [
            'user_id'=>backpack_user()->id,
            'bill'=>$request->bill,
            'value'=>$request->value,
            'method'=>($request->methods=="atm"?0:1),
            'status'=>0,
        ];
        Coin::create($coin);
        return redirect()->back()->with("success","Gủi thành công, đang chờ xác nhận");
    }
    public function accept($id){
        $coin= Coin::find($id);
        $user = User::find($coin->user_id);
        $user->update(['coin'=>$user->coin+$coin->value]);
        $coin->update(["status"=>1]);
        Notification::create(["user_id"=>$user->id,"type"=>0,"title"=>"Nạp tiền thành công","message"=>"Đã nạp thành công ".number_format($coin->value)." GVB Coin vào tài khoản"]);
        return redirect()->back()->with("success","Xác nhận thành công");
    }
}
