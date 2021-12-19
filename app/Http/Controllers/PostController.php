<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::limit(5)->orderBy("created_at","DESC")->get();
        return view("client.posts",["posts"=>$posts]);
    }
    public function show($id){
        $post = Post::find($id);
        return view("client.post",["post"=>$post]);
    }
}
