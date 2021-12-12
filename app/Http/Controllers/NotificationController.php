<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::where("user_id","=",backpack_user()->id)->orderBy("created_at","DESC")->get();
        return view("client.notification",['notifications'=>$notifications]);
    }
    public function read(){
        Notification::where("user_id","=",backpack_user()->id)->update(['status'=>1]);
        return true;
    }
}
