<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
       $posts = Post::paginate(6);
       $data =[
        'success'=> true,
        'results'=>$posts
       ];

       return response()->json($data);
    }
    public function show($slug){
       $single_post = Post::where('slug', '=', $slug)->first();
        $data = [
            'success' => true,
            'results' => $single_post,
        ];

        return response()->json($data);
    }
}
