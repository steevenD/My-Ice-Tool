<?php
  $titre='Editer Profil';
?>
@extends('layouts.app')

@section('content')
    <div class="container cnt-cnt">
        <div class="edit-part-profile dvid pad-box-spe">
            <div class="edit-profile box-spe bxd12 bxt12 bxm12">
                <h2>Editer son profile</h2>
                <div class="dvid coor-profile">
                    <form method="POST" action="{{ route('updateprofil', array($user->id)) }}">
                     {{ csrf_field() }}
                        <div class=" dvid bxd6 bxt6 bxm12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="bxd12 bxt12 bxm12">Nom :</label>
                            <input id="name" class="bxd12 bxt12 bxm12" type="text" name="name" value="{{ $user->name }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="dvid bxd6 bxt6 bxm12 form-group {{ $errors->has('tel') ? ' has-error' : '' }}">
                            <label for="tel" class="bxd12 bxt12 bxm12">Téléphone :</label>
                            <input id="tel" class="bxd12 bxt12 bxm12" type="phone" name="tel" value="{{ $user->tel }}" required>

                            @if ($errors->has('tel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tel') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="dvid bxd12 bxt12 bxm12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="bxd12 bxt12 bxm12">Adresse e-mail :</label>
                            <input id="email" class="bxd12 bxt12 bxm12" type="email" name="email" value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="dvid bxd6 bxt6 bxm12 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="bxd12 bxt12 bxm12">Mot de passe :</label>
                            <input id="password" class="bxd12 bxt12 bxm12" type="password" name="password" >
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="dvid bxd6 bxt6 bxm12 form-group ">
                            <label for="password-confirm" class="bxd12 bxt12 bxm12">Confirmer mot de passe :</label>
                            <input id="password-confirm" class="bxd12 bxt12 bxm12" type="password" name="password_confirmation" >
                        </div>
                        <div class="bxd12 bxt12 bxm12 form-group-check {{ $errors->has('newsLet') ? ' has-error' : '' }}">
                            <div class="check-group cnt-left">
                                <label for="newsLet">S'inscrire à la newsletter ?</label>
                                <input id="newsLet" type="checkbox" name="newsLet" value="1" >

                                @if ($errors->has('newsLet'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newsLet') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="bxd12 bxt12 bxm12 form-group-check {{ $errors->has('alert') ? ' has-error' : '' }}">
                            <div class="check-group cnt-left">
                                <label for="alert">Être alerté ?</label>
                                <input id="alert" type="checkbox" name="alert" value="1">

                                @if ($errors->has('alert'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alert') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group bxd12 bxt12 bxm12">
                      <button type="submit">Editer</button>
                    </div>
                    <div class="form-group-suppr bxd12 bxt12 bxm12">
                      <a href="deleteAccount/{{ $user->id }}"><p>Supprimer son compte</p></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
