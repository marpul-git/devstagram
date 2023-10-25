<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }
    public function index(User $user)
    {
        // ALMACENAMOS TODOS LOS POSTS QUE CORRESPONDEN A ESE USUARIO

        $posts = Post::where('user_id', $user->id)->latest()->simplePaginate(16);
        // Le pasamos tanto el usuario como los posts a la vista
        return view('dashboard', [
            'user' => $user,
            'posts'=> $posts
        ]);
    }

    public function create()
    {
        //dd('Creando Post');
        return view('posts.create');
    }


    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);
        /* 
       Post::create([
        'titulo'=> $request->input('titulo'),
        'descripcion'=> $request->input('descripcion'),
        'imagen'=> $request->input('imagen'),   
        'user_id'=> auth()->user()->id
       ]);
       */
        /*
       $post = new Post;
       $post->user_id =auth()->user()->id;
       $post->titulo = $request->titulo;
       $post->descripcion = $request->descripcion;
       $post->imagen = $request->imagen;
       $post->save();
       */

        // Una vez hecha la relacion de las tablas se pueden guardar los datos asi

        $request->user()->posts()->create([
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'imagen' => $request->input('imagen'),
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    // Muestra un elemento (post) concreto
    public function show(User $user, Post $post){
        return view('posts.show',[
            'post'=> $post,
            'user'=> $user
        ]);
    }

    public function destroy(Post $post){
        
        //dd('Elominando', $post->id);
        
        //$post->delete();

        $this->authorize('delete', $post);
        $post->delete();
         
        // Eliminar la imagen del servidor

        $imagen_path = public_path('uploads/'. $post->imagen);

        if (file_exists($imagen_path)) { // ó File::exists($imagen_path);
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);

    }
}
