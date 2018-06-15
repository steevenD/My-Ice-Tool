<?php
  $titre='Edit Type Fin de Vie';
?>


@extends('layouts.app')

@section('content')
    <h1>Editer {{$type_fin_vie->libTypeFin}}</h1>
    <form method="post" action="{{ route('updatetype_fin_vie', array($type_fin_vie->id)) }}">
        {{ csrf_field() }}
        <input type="hidden" name="type_fin_vieId" value="{{$type_fin_vie->id}}">
        <label for="libTypeFin">Nom du type de fin de vie</label>
        <input type="text" name="libTypeFin" id="libTypeFin" value="{{$type_fin_vie->libTypeFin}}" required><br>

        <button type="submit">Modifier le type de fin de vie</button>
    </form>
@endsection
