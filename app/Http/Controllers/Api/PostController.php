<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
       $posts = Post::paginate(6);

    //    Assegno l'url dell'immagine se al post ne è assegnata una
       foreach($posts as $post){
        if($post->cover){
            $post->cover = asset('storage/' . $post->cover);
        };
       }
       $data =[
        'success'=> true,
        'results'=>$posts
       ];

       return response()->json($data);
    }
    public function show($slug){
       $single_post = Post::where('slug', '=', $slug)->with('tags', 'category')->first();  //with() è una shorthand per le join


        if($single_post->cover){
            $single_post->cover = asset('storage/' . $single_post->cover);
        };
       

       if($single_post){
            $data = [
                'success' => true,
                'results' => $single_post,
            ];
       } else { //tengo conto del caso di uno slug errato/non presente nel db
            $data = [
                'success' => false,
            ];
       };
        

        return response()->json($data);
    }
}
