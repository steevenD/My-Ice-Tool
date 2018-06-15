<?php
  $titre='Edit Structure';
?>

@extends('layouts.app')
@section('content')
    <h1>Editer</h1>

    <form method="post" action="{{ route('updatestructure', array($structure->id)) }}">
        {{ csrf_field() }}
        <input type="hidden" name="structureId" value="{{$structure->id}}">
        <label for="nomStructure">Nom de la structure</label>
        <input type="text" name="nomStructure" id="nomStructure" value="{{$structure->nomStructure}}" required><br>

        <button type="submit">Modifier la structure</button>
    </form>
@endsection
