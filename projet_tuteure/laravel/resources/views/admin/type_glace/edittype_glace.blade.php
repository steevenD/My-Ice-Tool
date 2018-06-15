<?php
  $titre='Edit Type Glace';
?>

@extends('layouts.app')

@section('content')
    <h1>Editer {{$type_glace->libType}}</h1>
    <form method="post" action="{{ route('updatetype_glace', array($type_glace->id)) }}">
        {{ csrf_field() }}
        <input type="hidden" name="type_glaceId" value="{{$type_glace->id}}">
        <label for="libType">Nom du type de glace</label>
        <input type="text" name="libType" id="libType" value="{{$type_glace->libType}}" required><br>

        <button type="submit">Modifier le type de glace</button>
    </form>
@endsection
