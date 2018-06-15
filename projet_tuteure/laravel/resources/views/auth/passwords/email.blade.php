<?php
  $titre='Mot de Passe Oublié';
?>

@extends('layouts.app')

@section('content')
<div class="container-web-site"  onclick="closeNavRight(), closeNavLeft()">
    <div class="background-contact cnt-cnt">
        <div class="dvid">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe contact-page">
                    <h2>Réinitialiser Mot de passe</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal dvid" action="{{ route('password.email') }}" method="post">
                      {{ csrf_field() }}
                        <div class="bxd12 bxt12 bxm12 pad-box-spe {{ $errors->has('email') ? ' has-error' : '' }}">
                          <input id="email" type="email" class="form-control" name="email" placeholder="Votre E-Mail" value="{{ old('email') }}" required>

                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="bxd12 bxt12 bxm12 pad-box-spe">
                          <button type="submit" class="btn btn-primary">
                              Envoyer pour réinitialiser
                          </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
