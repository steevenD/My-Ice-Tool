<?php
  $titre='Edit Constituant';
?>

@extends('layouts.app')

@section('content')
    <div class="container-admin">
        <div class="admin-part dvid">
            <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
                <div class="titre-admin">
                    <h2>AJOUTER CONSTITUANT</h2>
                </div>
            </div>
        </div>
        <div class="dvid admin-del-add">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe add-box">
                    <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                    <form method="POST" action="{{ route('ajouterUnConstituantViaTabAdmin') }}">
                        {{ csrf_field() }}
                        <p>Nom du constituant</p>
                        <input type="text" name="libConst" id="libConst" required><br>

                        <button type="submit">Ajouter le constituant</button>
                    </form>
                </div>
            </div>
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe del-box">
                    <p>Supprimer ou modifier un support</p>
                    <table border="1">
                        <tr>
                            <th>ID du constituant</th>
                            <th>Nom du constituant</th>
                            <th>Supprimer</th>
                        </tr>
                        @forelse($constituants as $constituant)
                            <tr>
                                <td>{{ $constituant->id }}</td>
                                <td><input type="text" id="libConst{{$constituant->id}}" onblur="modifierNomConstituant({{$constituant->id}})" value="{{ $constituant->libConst }}" ></td>
                                <!--<td><a href="{{ route('editconstituant',array($constituant->id) )}}">MODIFIER</a></td>-->
                                <td><a href="deleteconstituant/{{ $constituant->id }}">SUPPRIMER</a></td>
                            </tr>

                        @empty
                            Pas de constituants
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
        function modifierNomConstituant(id){
            var req = new Xhr();
            var lib = document.getElementById('libConst'+id).value;
            var rt = "{{ route('updateconstituant', ['id' => '#ID#']) }}";
            req.open("POST", rt.replace('#ID#', id), true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('id') + '='+ encodeURIComponent(id)+'&'+encodeURIComponent('libConst')+'='+encodeURIComponent(lib);
            req.send(data);
        }
    </script>
@endsection
