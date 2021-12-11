<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $histories = History::where("user_id","=",backpack_user()->id)->get();
        return view("client.chest",["histories"=>$histories]);
    }
    public function returned($id){
        if(History::find($id)->update(['status'=>0])){
            return redirect()->back()->with("success","Thay đổi trạng thái thành công");
        }
    }
}
