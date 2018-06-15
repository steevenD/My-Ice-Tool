<?php
  $titre='Connexion';
?>

@extends('layouts.app')

@section('content')
<div class="container-web-site"  onclick="closeNavRight(), closeNavLeft()">
    <div class="background-contact cnt-cnt">
        <div class="dvid">
            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                <div class="box-spe contact-page">
                    <h2>Connexion</h2>
                    <form class="form-horizontal dvid" action="{{ route('login') }}" method="post">
                      {{ csrf_field() }}
                        <div class="bxd12 bxt12 bxm12 pad-box-spe {{ $errors->has('email') ? ' has-error' : '' }}">
                          <input id="email" type="email" class="form-control" placeholder="Votre E-mail" name="email" value="{{ old('email') }}" required autofocus>
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="bxd12 bxt12 bxm12 pad-box-spe {{ $errors->has('password') ? ' has-error' : '' }}">
                          <input id="password" type="password" class="form-control" name="password" required>
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="bxd12 bxt12 bxm12 pad-box-spe checkbox">
                          <label>
                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
                          </label>
                        </div>
                        <div class="bxd12 bxt12 bxm12 pad-box-spe">
                          <button type="submit" class="btn btn-primary">
                              Connecter
                          </button>

                          <a class="btn-link" href="{{ route('password.request') }}">
                              Oublie de mot de passe ?
                          </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
