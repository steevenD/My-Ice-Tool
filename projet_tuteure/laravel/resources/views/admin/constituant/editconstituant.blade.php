<?php
  $titre='Edit Constituant';
?>

@extends('layouts.app')
@section('content')
    <h1>Editer</h1>

    <form method="post" action="{{ route('updateconstituant', array($constituant->id)) }}">
        {{ csrf_field() }}
        <input type="hidden" name="constituantId" value="{{$constituant->id}}">
        <label for="libConst">Nom du constituant</label>
        <input type="text" name="libConst" id="libConst" value="{{$constituant->libConst}}" required><br>

        <button type="submit">Modifier le constituant</button>
    </form>
@endsection
