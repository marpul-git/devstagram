<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function store(User $user,Request $request) // User es el usuario al que queremos seguir, Request contiene el usuario autenticado
    {
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user) // User es el usuario al que queremos seguir, Request contiene el usuario autenticado
    {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
