<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){

        //$input = $request->all();
        $imagen = $request->file('file');

        //Esto genera un id distinto para cada imagen subida, ya que no se pueden tener 2 elementos con el mismo id

        $nombreImagen = Str::uuid(). "." . $imagen->extension();

        //La imagen que se guardará en el servidor

        $imagenServidor = Image::make($imagen);// Objeto Intervention image

        $imagenServidor->fit(1000,1000);// Efecto de intervention image que recorta la imagen a 1000*1000

        $imagenPath = public_path("uploads") . '/' . $nombreImagen;

        $imagenServidor->save($imagenPath);



        return response()->json(['imagen' => $nombreImagen]);



        
    }
}
