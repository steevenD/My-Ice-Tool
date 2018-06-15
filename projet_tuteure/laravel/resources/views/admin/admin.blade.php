<?php
  $titre='Admin';
?>

@extends('layouts.app')

@section('content')
   <div class="container-admin">
      <div class="admin-part dvid">
         <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
            <div class="titre-admin">
               <h2>ADMINISTRATION</h2>
               <a href="{{ route('mapUser') }}">Expérience utilisateur</a>
            </div>
         </div>
      </div>
      <div class="dvid admin-conf">
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des zones</h3>
               <a href="{{ route('map') }}">Ajouter / Supprimer / Modifier une zone</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box admin-box">
               <h3>Gestion des cascades</h3>
               <a href="{{ route('ajoutercascade') }}">Ajouter une cascade</a><br />
               <a href="{{ route('supprimermodifiercascade') }}">Supprimer / Modifier une cascade</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des structures</h3>
               <a href="{{ route('supprimermodifierstructure') }}">Ajouter / Supprimer / Modifier une structure</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des types de glace</h3>
               <a href="{{ route('supprimermodifiertype_glace') }}">Ajouter / Supprimer / Modifier un type de glace</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des types de fin de vie</h3>
               <a href="{{ route('supprimermodifiertype_fin_vie') }}">Ajouter / Supprimer / Modifier un type de fin de vie</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des constituants</h3>
               <a href="{{ route('supprimermodifierconstituant') }}">Ajouter / Supprimer / Modifier un constituant</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des supports</h3>
               <a href="{{ route('supprimermodifiersupport') }}">Ajouter / Supprimer / Modifier un support</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des utilisateurs</h3>
               <a href="{{ route('supprimeruser') }}">Supprimer un utilisateur</a><br />
            </div>
         </div>
         <div class="bxd6 bxt6 bxm12 pad-box-spe">
            <div class="box-spe admin-box">
               <h3>Gestion des partenaires</h3>
               <a href="{{ route('supprimermodifierpartenaire') }}">Ajouter / Supprimer / Modifier un partenaire</a><br />
            </div>
         </div>
      </div>
   </div>
@endsection
