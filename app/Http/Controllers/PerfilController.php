<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {

        return view("perfil.index");
    }

    public function store(Request $request)
    {

        //Modificar el Request 

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            // 'username'=>'required|unique:users|min:3|max:20', cuando hay más de 3 restricciones Laravel recomienda pasarlo como un array
            'username' => [
                'required',
                'unique:users,username,' . auth()->user()->id, // autoriza al usuario autenticado a repetir su username
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil' //Palabras que no seran aceptadas como username, no dejar espacios
            ]
        ]);

        if ($request->imagen) {
            //$input = $request->all();
            $imagen = $request->file('imagen');

            //Esto genera un id distinto para cada imagen subida, ya que no se pueden tener 2 elementos con el mismo id

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //La imagen que se guardará en el servidor

            $imagenServidor = Image::make($imagen); // Objeto Intervention image

            $imagenServidor->fit(1000, 1000); // Efecto de intervention image que recorta la imagen a 1000*1000

            $imagenPath = public_path("perfiles") . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        // Redireccionamos al nuevo usuario modificado en lugar del autenticado por si ha cambiado su username

        return redirect()->route('posts.index', $usuario->username);



    }
}
