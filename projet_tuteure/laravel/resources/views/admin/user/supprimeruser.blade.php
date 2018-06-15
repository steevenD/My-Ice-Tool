<?php
  $titre='Supprimer User';
?>
@extends('layouts.app')

@section('content')
    <div class="container-admin">
        <div class="admin-part dvid">
            <div class="admin-part-back bxd12 bxt12 bxm12 cnt-cnt">
                <div class="titre-admin">
                    <h2>SUPPRIMER UTILISATEUR</h2>
                </div>
            </div>
        </div>
        <div class="dvid admin-del-add">

            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe del-box">
                    <h3><a href="{{ route('admin')}}"><i class="fa fa-arrow-left"></i> Retour au Tableau Administrateur</a></h3>
                    <p>Supprimer un utiliateur</p>
                    <table border="1">
                        <tr>
                            <th>ID de l'utilisateur</th>
                            <th>Nom de l'utilisateur</th>
                            <th>Supprimer</th>
                        </tr>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="deleteuser/{{ $user->id }}">SUPPRIMER</a></td>
                            </tr>
                        @empty
                            Aucun utilisateur
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
