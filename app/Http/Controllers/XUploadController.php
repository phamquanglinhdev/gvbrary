<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class XUploadController extends Controller
{
    public function index(){
        return view("vendor.backpack.page.x-upload");
    }
    public function upload(Request $request){
       if($request->{"excel"}->storeAs("import","data.xlsx")){
            Excel::import(new ProductImport(),"import/data.xlsx");
            return "ok";
       }
    }
}
