<?php
  $titre='Infos Supports';
?>

@extends('layouts.app')

@section('content')


    <div class="container-admin">
        <div class="admin-part dvid">
            <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
                <div class="titre-admin">
                    <h2>AJOUTER SUPPORT</h2>
                </div>
            </div>
        </div>
        <div class="dvid admin-del-add">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe add-box">
                    <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                    <form method="POST" action="{{ route('ajouterUnSupportViaTabAdmin') }}">
                        {{ csrf_field() }}
                        <p>Nom du support :</p>
                        <input type="text" name="libSupp" id="libSupp" required><br>

                        <button type="submit">Ajouter le support</button>
                    </form>
                </div>
            </div>
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe del-box">
                    <p>Supprimer ou modifier un support</p>
                <!--<h3><a href="{{ route('ajoutersupport')}}">Ajouter un support</a></h3>
            <h3><a href="{{ route('admin')}}">Tableau Administrateur</a></h3>-->
                    <table border="1">
                        <tr>
                            <th>ID du support</th>
                            <th>Nom du support</th>
                            <th>Supprimer</th>
                        </tr>
                        @forelse($supports as $support)
                            <tr>
                                <td>{{ $support->id }}</td>
                                <td><input id="libSupp{{$support->id}}" type="text" onblur="modifierNomSupport({{$support->id}})" value="{{ $support->libSupp }}" ></td>
                            <!--<td><a href="{{ route('editsupport',array($support->id) )}}">MODIFIER</a></td>-->
                                <td><a href="deletesupport/{{ $support->id }}">SUPPRIMER</a></td>
                            </tr>

                        @empty
                            Pas de support
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
        function modifierNomSupport(id){
            var req = new Xhr();
            var lib = document.getElementById('libSupp'+id).value;
            var rt = "{{ route('updatesupport', ['id' => '#ID#']) }}";
            req.open("POST", rt.replace('#ID#', id), true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('id') + '='+ encodeURIComponent(id)+'&'+encodeURIComponent('libSupp')+'='+encodeURIComponent(lib);
            req.send(data);
        }
    </script>
@endsection
