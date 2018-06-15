<?php
  $titre='Infos Types Fin de Vie';
?>


@extends('layouts.app')

@section('content')
    <div class="container-admin">
        <div class="admin-part dvid">
            <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
                <div class="titre-admin">
                    <h2>AJOUTER TYPE DE FIN DE VIE</h2>
                </div>
            </div>
        </div>
        <div class="dvid admin-del-add">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe add-box">
                    <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                    <form method="POST" action="{{ route('ajouterUnType_fin_vieViaTabAdmin') }}">
                        {{ csrf_field() }}
                        <p>Nom du type de fin de vie</p>
                        <input type="text" name="libTypeFin" id="libTypeFin" required><br>

                        <button type="submit">Ajouter le type de fin de vie</button>
                    </form>
                </div>
            </div>
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe del-box">
                    <p>Supprimer ou modifier un type de fin de vie</p>
                    <table border="1">
                        <tr>
                            <th>ID du type de fin de vie</th>
                            <th>Nom du type de fin de vie</th>
                            <th>Supprimer</th>
                        </tr>
                        @forelse($types_fin_vie as $type_fin_vie)
                            <tr>
                                <td>{{ $type_fin_vie->id }}</td>
                                <td><input type="text" id="libTypeFin{{$type_fin_vie->id}}" onblur="modifierNomType_fin_vie({{$type_fin_vie->id}})" value="{{ $type_fin_vie->libTypeFin }}"></td>
                                <!--<td><a href="{{ route('edittype_fin_vie',array($type_fin_vie->id) )}}">MODIFIER</a></td>-->
                                <td><a href="deletetype_fin_vie/{{ $type_fin_vie->id }}">SUPPRIMER</a></td>
                            </tr>
                        @empty
                            Pas de type de fin de vie
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
        function modifierNomType_fin_vie(id){
            var req = new Xhr();
            var lib = document.getElementById('libTypeFin'+id).value;
            var rt = "{{ route('updatetype_fin_vie', ['id' => '#ID#']) }}";
            req.open("POST", rt.replace('#ID#', id), true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('id') + '='+ encodeURIComponent(id)+'&'+encodeURIComponent('libTypeFin')+'='+encodeURIComponent(lib);
            req.send(data);
        }
    </script>
@endsection
