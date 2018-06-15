<?php
  $titre='Edit Support';
?>

@extends('layouts.app')
@section('content')
    <h1>Editer</h1>

    <form method="post" action="{{ route('updatesupport', array($support->id)) }}">
        {{ csrf_field() }}
        <input type="hidden" name="supportId" value="{{$support->id}}">
        <label for="libSupp">Nom du support</label>
        <input type="text" name="libSupp" id="libSupp" value="{{$support->libSupp}}" required><br>

        <button type="submit">Modifier le support</button>
    </form>
@endsection
