<!--la directiva entends apunta directamente a la carpeta views, la / se sustituye por . -->

@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')

  <x-listar-post :posts="$posts"/>
@endsection