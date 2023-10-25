<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use App\Models\Post;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //RELACION CON LA BD

    public function posts(){
        // Relacion de uno a muchos (Un usuario puede tener muchos posts)
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function followings(){
        return $this->belongsToMany(User::class,'followers', 'follower_id', 'user_id');
    }
    //Almacena los seguidores de un usuario
    // Al no seguir la convencion hay que añadirle el nombre de la tabla a la que hace referencia y los campos
    public function followers(){
        return $this->belongsToMany(User::class,'followers', 'user_id', 'follower_id');
    }

     // Almacenar los que seguimos
    // Cambiamos el orden
    

    //Comprobar si ya está siguiendo a un usuario

    public function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);
    }

   
}