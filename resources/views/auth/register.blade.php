@extends('layouts.app')

@section('titulo')
    Regístrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center p-5">
        <div class="md:w-6/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuario">

        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Tu Nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror

                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Tu Email de Registro"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input type="password" name="password" id="password" placeholder="Password de Registro"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror ">
                        @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Repite tu Password" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror ">
                </div>
                <input type="submit" value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>

    </div>
@endsection
