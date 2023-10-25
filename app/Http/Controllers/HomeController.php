<?php

namespace App\Http\Controllers;

use App\Models\Post;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    
    // Este metodo se llama automticamente, como un constructor
    public function __invoke()
    {
        // whereIn devuelve los que coincidan con más de un dato pasados en un arreglo
        //dd(auth()->user()->followings);
       
        
            $ids = auth()->user()->followings->pluck("id")->toArray();
            $posts = Post::whereIn("user_id", $ids)->latest()->paginate(20);
    
           return view("home", [
            "posts"=> $posts
           ]);
 

    }


}
