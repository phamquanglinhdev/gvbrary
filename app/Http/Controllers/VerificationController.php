<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index(){
        if(backpack_user()->id!=3){
            return redirect("/")->with("success","Đã xác minh, không cần xác minh lại");

        }else{
            return view("client.verification");
        }

    }
    public function store(Request $request){
        $data = [
            'user_id'=>backpack_user()->id,
            'id_card'=>$request->id_card,
            'card_image'=>$request->card_image,
            'grade'=>$request->grade,
        ];
        Verification::create($data);
        return redirect()->back()->with("success","Đã gửi xác minh, đang chờ xác nhận");
    }
    public function accept($id){
        $verification = Verification::find($id)->first();
        if(isset($verification)){
            User::find($verification->user_id)->update(['role'=>2,'id_card'=>$verification->id_card]);
            Verification::find($id)->delete();
            return redirect()->back()->with("success","Đã xác minh");
        }
    }
    public function cancel($id){
        $verification = Verification::find($id)->delete();
        return redirect()->back()->with("faile","Đã từ chối xác minh");
    }
}
