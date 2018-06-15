<?php
  $titre='Partenaires';
?>

@extends('layouts.app')

@section('content')
    <div class="container-admin">
        <div class="admin-part dvid">
            <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
                <div class="titre-admin">
                    <h2>AJOUTER PARTENAIRE</h2>
                </div>
            </div>
        </div>
        <div class="dvid admin-del-add">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe add-box">
                    <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                    <form method="POST" action="{{ route('ajouterUnPartenaireViaTabAdmin') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p>Nom du partenaire</p>
                        <input type="text" name="nomPart" id="nomPart" required><br>
                        <p>Logo du partenaire</p>
                        <input type="file" name="logoPart" required/>
                        <p>Site web du partenaire</p>
                        <input type="text" name="sitePart" id="sitePart" required><br>

                        <button type="submit">Ajouter le partenaire</button>
                    </form>
                </div>
            </div>
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe trial-box">
                    <p>Supprimer ou modifier un type de fin de vie</p>
                    <table border="1">
                        <tr>
                            <th>ID du partenaire</th>
                            <th>Nom du partenaire</th>
                            <th>Logo du partenaire</th>
                            <th>Site du partenaire</th>
                            <th>Supprimer</th>
                        </tr>
                        @forelse($partenaires as $partenaire)
                            <tr>
                                <td>{{ $partenaire->id }}</td>

                                <td><input type="text" id="nomPart{{$partenaire->id}}" onblur="modifierPartenaire({{$partenaire->id}})" value="{{ $partenaire->nomPart }}"></td>
                                <td><img src="../../../img/partenaires/{{$partenaire->logoPart}}" width="90" /></td>
                                <td><a href="{{ $partenaire->sitePart }}">LIEN</a></td>

                            <!--<td><a href="{{ route('editpartenaire',array($partenaire->id) )}}">MODIFIER</a></td>-->
                                <td><a href="deletepartenaire/{{ $partenaire->id }}">SUPPRIMER</a></td>
                            </tr>
                        @empty
                            Pas de partenaires
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function Xhr(){
            var objRequete = null;
            try{ objRequete = new ActiveXObject("Microsoft.XMLHTTP");}
            catch(Error){ try {objRequete = new ActiveXObject("MSXML2.XMLHTTP");}
            catch(Error){ try {objRequete = new XMLHttpRequest();}
            catch(Error){alert('Impossible de faire de l\'ajax')}}}
            return objRequete;
        }
        function modifierPartenaire(id){
            var req = new Xhr();
            var lib = document.getElementById('nomPart'+id).value;

            var rt = "{{ route('updatepartenaire', ['id' => '#ID#']) }}";
            req.open("POST", rt.replace('#ID#', id), true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('id') + '='+ encodeURIComponent(id)+'&'+encodeURIComponent('nomPart')+'='+encodeURIComponent(lib);
            req.send(data);
        }
    </script>
@endsection
