<?php
  $titre='Infos Structure';
?>

@extends('layouts.app')

@section('content')
    <div class="container-admin">
        <div class="admin-part dvid">
            <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
                <div class="titre-admin">
                    <h2>AJOUTER STRUCTURE</h2>
                </div>
            </div>
        </div>
        <div class="dvid admin-del-add">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe add-box">
                    <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                    <form method="POST" action="{{ route('ajouterUneStructureViaTabAdmin') }}">
                        {{ csrf_field() }}
                        <p>Nom de la structure</p>
                        <input type="text" name="nomStructure" id="nomStructure" required><br>

                        <button type="submit">Ajouter la structure</button>
                    </form>
                </div>
            </div>
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe del-box">
                    <p>Supprimer ou modifier une structure</p>
                    <!--<h3><a href="{{ route('ajouterstructure')}}">Ajouter une structure</a></h3>-->
                    <table border="1">
                        <tr>
                            <th>ID de la structure</th>
                            <th>Nom de la structure</th>
                            <th>Supprimer</th>
                        </tr>
                        @forelse($structures as $structure)

                            <tr>
                                <td>{{ $structure->id }}</td>
                                <td><input id="libStruct{{$structure->id}}" type="text" onblur="modifierNomStructure({{$structure->id}})" value="{{ $structure->nomStructure }}"></td>
                                <!--<td><a href="{{ route('editstructure',array($structure->id) )}}">MODIFIER</a></td>-->
                                <td><a href="deletestructure/{{ $structure->id }}">SUPPRIMER</a></td>
                            </tr>
                        @empty
                            Il n'y a pas de structures
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
        function modifierNomStructure(id){
            var req = new Xhr();
            var lib = document.getElementById('libStruct'+id).value;
            var rt = "{{ route('updatestructure', ['id' => '#ID#']) }}";
            req.open("POST", rt.replace('#ID#', id), true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('id') + '='+ encodeURIComponent(id)+'&'+encodeURIComponent('nomStructure')+'='+encodeURIComponent(lib);
            req.send(data);
        }
    </script>

@endsection
