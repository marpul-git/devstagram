<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');// no se necesita especificar el metodo, ejecuta el metodo __invoke



/*Si las rutas se denominan igual(solo cambia el metodo), no es necesario nombrar ambas*/

Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Rutas para el perfil

Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');



Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');

Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');
// Like a las fotos
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');

Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');

// Al utilizar {} lo convierte en una variable, se conoce como Route Model Binding (ruta asociada a un modelo)
// Al tener solo la variable tras la / es conveniente colocar al final para que interceda en otras rutas , 
// ya que al sser una variable acepta cualquier cosa
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');


//Siguiendo a usuarios

Route:: post('/{user:username}/follow',[FollowerController::class, 'store'])->name('users.follow');
// No le colocamos destroy porque se podria interpretar como eliminar usuario
Route:: delete('/{user:username}/unfollow',[FollowerController::class, 'destroy'])->name('users.unfollow');
