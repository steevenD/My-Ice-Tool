<?php
  $titre='Infos Cascade';
?>

@extends('layouts.app')

@section('content')


<div class="container-admin">
  <div class="admin-part dvid">
    <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
      <div class="titre-admin">
        <h2>SUPPRIMER OU MODIFIER UNE CASCADE</h2>
      </div>
    </div>
  </div>
  <div class="dvid admin-del-add">
    <div class="bxd12 bxt12 bxm12 pad-box-spe">
      <div class="box-spe add-box">
        <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
        <h3><a href="{{ route('ajoutercascade')}}">Ajouter une cascade</a></h3>
        </div>
      </div>
    </div>
    <div class="dvid admin-del-add">
      @forelse($cascades as $cascade)
      <div class="bxd12 bxt12 bxm12 pad-box-spe">
        <div class="box-spe data-casc-box">
          <table>
            <tr>
              <th>ID de la cascade</th>
              <td>{{ $cascade->id }}</td>
            </tr>
            <tr>
              <th>Nom de la cascade</th>
              <td>{{ $cascade->nomCascade }}</td>
            </tr>
            <tr>
              <th>Latitude</th>
              <td>{{ $cascade->latCascade }}</td>
            </tr>
            <tr>
              <th>Longitude</th>
              <td>{{ $cascade->longCascade }}</td>
            </tr>
            <tr>
              <th>Niveau de danger</th>
              <td>{{ $cascade->niveauDifCascade }}</td>
            </tr>
            <tr>
              <th>Modifier</th>
              <td><a href="{{ route('edit',array($cascade->id) )}}">MODIFIER</a></td>
            </tr>
            <tr>
              <th>Supprimer</th>
              <td><a href="delete/{{ $cascade->id }}">SUPPRIMER</a></td>
            </tr>
          </table>
        </div>
      </div>
      @empty
        Pas de cascades
      @endforelse
    </div>
  </div>
@endsection
