<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function index(){
        return Product::where("status","=",0)->get();
    }
}
