<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    //protected $table = "posts";
    //public $timestamps = false; // Impide que se rellenen los campos updated_at y created_at al ejecutar Factory

    protected $fillable = [
        "titulo",
        'descripcion',
        'imagen',
        'user_id' 
        ];
        // Relacion uno a uno

        // Un post solo puede pertenecer a un usuario
        // Con el metodo select seleccionamos solo los campos que queremos recuperar
        public function user(){
            return $this->belongsTo(User::class)->select(['name','username']);
        }

        // Un post puede tener multiples comentarios
        public function comentarios(){
            return $this->hasMany(Comentario::class);
        }
        // Un post puede tener multiples likes
        public function likes(){

            return $this->hasMany(Like::class);
        }

        public function checkLike (User $user){
            // Se situa en la tabla likes y compara si existe algún 'user_id'coincidente con el mismo post
            return $this->likes->contains('user_id',$user->id);
        }

}
