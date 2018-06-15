<?php
  $titre='Infos Types Glace';
?>
@extends('layouts.app')

@section('content')

    <div class="container-admin">
        <div class="admin-part dvid">
            <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
                <div class="titre-admin">
                    <h2>AJOUTER TYPE DE GLACE</h2>
                </div>
            </div>
        </div>
        <div class="dvid admin-del-add">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe add-box">
                    <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                    <form method="POST" action="{{ route('ajouterUnType_glaceViaTabAdmin') }}">
                        {{ csrf_field() }}
                        <p>Nom du type de glace</p>
                        <input type="text" name="libType" id="libType" required><br>

                        <button type="submit">Ajouter le type de glace</button>
                    </form>
                </div>
            </div>
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe del-box">
                    <p>Supprimer ou modifier un type de glace</p>
                    <table border="1">
                        <tr>
                            <th>ID du type de glace</th>
                            <th>Nom du type de glace</th>
                            <th>Supprimer</th>
                        </tr>
                        @forelse($types_glace as $type_glace)
                            <tr>
                                <td>{{ $type_glace->id }}</td>
                                <td><input type="text" value="{{ $type_glace->libType }}" id="libType{{$type_glace->id}}" onblur="modifierNomType_glace({{$type_glace->id}})"></td>
                                <!--<td><a href="{{ route('edittype_glace',array($type_glace->id) )}}">MODIFIER</a></td>-->
                                <td><a href="deletetype_glace/{{ $type_glace->id }}">SUPPRIMER</a></td>
                            </tr>
                        @empty
                            Pas de type de glace
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
        function modifierNomType_glace(id){
            var req = new Xhr();
            var lib = document.getElementById('libType'+id).value;
            var rt = "{{ route('updatetype_glace', ['id' => '#ID#']) }}";
            req.open("POST", rt.replace('#ID#', id), true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('id') + '='+ encodeURIComponent(id)+'&'+encodeURIComponent('libType')+'='+encodeURIComponent(lib);
            req.send(data);
        }
    </script>
@endsection
