@extends('layouts.app')

@section('content')
<div class="container-web-site"  onclick="closeNavRight(), closeNavLeft()">
    <div class="background-contact cnt-cnt">
      <div class="dvid">
          <div class="bxd12 bxt12 bxm12 pad-box-spe">
              <div class="box-spe contact-page">
                  <h2>Réinitialiser Mot de passe</h2>


                    <form class="form-horizontal dvid" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input placeholder="Votre mail" id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <input placeholder="Votre mot de passe" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                <input placeholder="Confirmez votre mot de passe" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                                <button type="submit" class="btn btn-primary">
                                    Envoyer pour réinitialiser
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsectio