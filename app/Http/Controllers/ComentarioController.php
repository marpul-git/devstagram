<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // User es el usuario dueño del post, se podria quitar(tambien habria que quitarlo del formulario)
    public function store(Request $request, User $user, Post $post){
        //dd('Comentando...');
        // Validar


        $this->validate(request(), [
            "comentario"=> "required|max:255",
        ]) ;

        //Almacenar el resultado

        Comentario::create([
            'user_id' => auth()->user()->id ,// Usuario autenticado (el que está comentando el post)
            'post_id' => $post->id,
            'comentario'=> $request->comentario
            ]);


            // back() devuelve a la página desde donde se envio
            return back()->with('mensaje','Comentario almacenado correctamente');
    }
}
