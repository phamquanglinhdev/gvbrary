<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category = "thu-vien-truong.aspx", $page = 1)
    {
        $category = Category::where("slug", "=", $category)->first();
        if (isset($category->name)) {
            $products = $category->Products()->where("status","=",0)->get();
            $count=0;
            if($products->count() !== null){
                $count = $products->count()/12;
            }
            if ($products->first() != null) {
                return view("client.products", ['category' => $category, 'products' => $products, "page" => $page,"count"=>$count ?? 0]);
            }
            return view("client.products", ['category' => $category, 'products' => $products, "page" => $page]);
        } else {
            return view("errors.404");
        }
    }
    public function indexByTags($tag = "sach-giao-khoa.aspx", $page = 1)
    {
        $tag = Tag::where("slug", "=", $tag)->first();
        if (isset($tag->name)) {
            $products = $tag->Products()->where("status","=",0)->get();
            $count=0;
            if($products->count() !== null){
                $count = $products->count()/12;
            }
            if ($products->first() != null) {
                return view("client.products", ['category' => $tag, 'products' => $products, "page" => $page,"count"=>$count ?? 0,"method"=>1]);
            }
            return view("client.products", ['category' => $tag, 'products' => $products, "page" => $page]);
        } else {
            return view("errors.404");
        }
    }

    public function show($slug)
    {
        $product = Product::where("slug", "=", $slug)->first();
        if (isset($product)) {
            if ($product->status == 0) {
                        return view("client.product",["product"=>$product]);
            } else {
                return view("errors.404");
            }
        } else {
            return view("errors.404");
        }

    }
    public function requestComment(Request $request){
        $newComment = [
            'user_id'=>backpack_user()->id,
            'product_id'=>$request->product_id,
            'rating'=>$request->rating,
            'comment'=>$request->comment,
        ];
        Comment::create($newComment);
        return redirect()->back()->with("success","Đánh giá của bạn đã được gửi xét duyệt thành công");
    }
}
