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
}
