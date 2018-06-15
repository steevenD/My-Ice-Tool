<?php
  $titre='Editer Cascade';
?>

@extends('layouts.app')

@section('content')

@include('admin.support.ajoutersupport')
@include('admin.structure.ajouterstructure')
@include('admin.constituant.ajouterconstituant')
@include('admin.type_glace.ajoutertype_glace')
@include('admin.type_fin_vie.ajoutertype_fin_vie')

<div class="container-admin">
    <div class="admin-part dvid">
        <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
            <div class="titre-admin">
                <h2>MODIFIER CASCADE</h2>
            </div>
        </div>
    </div>
    <div class="dvid admin-del-add">
        <div class="bxd12 bxt12 bxm12 pad-box-spe">
            <div class="box-spe add-box">
                <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                <h3><a href="{{ route('ajoutercascade')}}">Ajouter une cascade</a></h3>
                <a href="{{ route('supprimermodifiercascade')}}">Supprimer / Modifier une cascade</a><br /><br />
                <h4>Editer la cascade <b>{{$cascade->nomCascade}}</b></h4>
                <form method="post" class="dvid" action="{{ route('update', array($cascade->id)) }}">
                    {{ csrf_field() }}
                  <div class="bxd12 bxt12 bxm12">
                    <label for="nomCascade">Nom de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="text" name="nomCascade" id="nomCascade" value="{{$cascade->nomCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="nbVoiesCascades">Nombre de voies de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="number" name="nbVoiesCascades" id="nbVoiesCascades" value="{{$cascade->nbVoiesCascades}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="altiMiniCascade">Altitude minimum de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="number" step="any" name="altiMiniCascade" id="altiMiniCascade" value="{{$cascade->altiMiniCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="hauteurCascade">Hauteur de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="number" step="any" name="hauteurCascade" id="hauteurCascade" value="{{$cascade->hauteurCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="niveauDifCascade">Niveau de difficulté de la cascade</label>

                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="text" name="niveauDifCascade" id="niveauDifCascade" value="{{$cascade->niveauDifCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="niveauEngCascade">Niveau Eng de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="text" name="niveauEngCascade" id="niveauEngCascade" value="{{$cascade->niveauEngCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="orientCascade">Orientation de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="text" name="orientCascade" id="orientCascade" value="{{$cascade->orientCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="longCascade">Longueur de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="number" step="any" name="longCascade" id="longCascade" value="{{$cascade->longCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <label for="latCascade">Latitude de la cascade</label>
                  </div>
                  <div class="bxd12 bxt12 bxm12">
                    <input type="number" step="any" name="latCascade" id="latCascade" value="{{$cascade->latCascade}}" required>
                  </div>
                  <div class="bxd12 bxt12 bxm12 dvid button-add-cascade">
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <label for="structure_id">Structure de la cascade</label>
                    </div>
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <select name="structure_id" id="structure_id">
                          @foreach($structures as $structure)
                              <option value="{{$structure->id}}" {{$cascade->structure_id==$structure->id ? 'selected':null}}>{{$structure->nomStructure}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="bxd12 bxt12 bxm12 dvid button-add-cascade">
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <label for="type_id">Type de glace de la cascade</label>
                    </div>
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <select name="type_id" id="type_id">
                          @foreach($types_glace as $type_glace)
                              <option value="{{$type_glace->id}}" {{$cascade->type_id==$type_glace->id ? 'selected':null}}>{{$type_glace->libType}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="bxd12 bxt12 bxm12 dvid button-add-cascade">
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <label for="typeFin_id">Type de fin de vie de la cascade</label>
                    </div>
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <select name="typeFin_id" id="typeFin_id">
                          @foreach($types_fin_vie as $type_fin_vie)
                              <option value="{{$type_fin_vie->id}}" {{$cascade->typeFin_id==$type_fin_vie->id ? 'selected':null}}>{{$type_fin_vie->libTypeFin}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="bxd12 bxt12 bxm12 dvid button-add-cascade">
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <label for="constituant_id">Constituants de la cascade :</label>
                    </div>
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                          @foreach($constituants as $key=>$constituant)
                              @php $key=$key+1 @endphp
                              <div class="input-spe">
                                <div class="consti-casc">
                                  {{$constituant->libConst}} <input type="checkbox" value="{{$constituant->id}}" name="{{'constituant_id_' . $key}}">
                                </div>
                                <input type="number" step="any" placeholder="poids (%)" name="{{'poids_id_' . $key}}">
                              </div>
                          @endforeach
                    </div>
                  </div>

                  <div class="bxd12 bxt12 bxm12 dvid button-add-cascade">
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      <label for="support_id">Supports de la cascade :</label>
                    </div>
                    <div class="bxd6 bxt12 bxm12 add-cascade">
                      @foreach($supports as $support)
                        <div class="consti-casc">
                          {{$support->libSupp}} <input type="checkbox" value="{{$support->id}}" name="support_id[]">
                        </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="bxd12 bxt12 bxm12 dvid add-cascade">
                    <button type="submit">Modifier la cascade</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
