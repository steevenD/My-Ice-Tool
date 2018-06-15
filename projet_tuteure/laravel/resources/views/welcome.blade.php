<?php
  $titre='Accueil';
?>

@extends('layouts.app')

@section('content')
    <div class="container-web-site" onclick="closeNavRight(), closeNavLeft()">
        <div class="container-home">
            <div class="back-home cnt-cnt">
                <div class="dvid">
                    <div class="bxd8 bxt12 bxm12 left-home-div">
                        <h1>MY ICE <strong>TOOL</strong></h1>
                        <h2>Obtenir des informations essentielles sur l'escalade de glace en un clic !</h2>
                        <h3>Partagez votre passion avec le monde entier !</h3>
                        <a href="{{ route('mapVisitor') }}">Accéder au site en tant que visiteur</a>
                    </div>
                    <div class="bxd4 bxt12 bxm12 right-home-div">
                        <div class="box-spe">
                            <h2>Créer un compte</h2>


                            <form class="dvid" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input type="text" name="name" class="bxd12 bxt12 bxm12"
                                           placeholder="Votre Prenom Nom" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" name="email" class="bxd12 bxt12 bxm12" placeholder="Votre email"
                                           value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" name="password" class="bxd12 bxt12 bxm12"
                                           placeholder="Votre mot de passe" value="{{ old('password') }}" onkeyup="indicationMotDepasse()" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                  <p>Force du mot de passe : <strong id="forceMDP">Faible</strong></p>
                                  <div class="progressBarconteneur">
                                      <div class="progressBarValue" id="barvalue" style="visibility: visible;">
                                      </div>
                                  </div>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" class="password bxd12 bxt12 bxm12"
                                           placeholder="Confirmation mot de passe" name="password_confirmation"
                                           required >
                                </div>
                                <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                    <input type="text" name="tel" class="bxd12 bxt12 bxm12"
                                           placeholder="Votre numéro de téléphone" value="{{ old('tel') }}" required>
                                    @if ($errors->has('tel'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('tel') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="check-group{{ $errors->has('newsLet') ? ' has-error' : '' }}">
                                    <label for="newsLet" class="bxd10 bxt10 bxm10 control-label">Newsletter</label>
                                    <div class="bxd2 bxt2 bxm2" style="text-align:right;">
                                        <input id="newsLet" type="checkbox" class="form-control" name="newsLet"
                                               value="1">

                                        @if ($errors->has('newsLet'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('newsLet') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="check-group{{ $errors->has('alert') ? ' has-error' : '' }}">
                                    <label for="alert" class="bxd10 bxt10 bxm10 control-label">Etre alerté ?</label>

                                    <div class="bxd2 bxt2 bxm2" style="text-align:right;">
                                        <input id="alert" type="checkbox" class="form-control" name="alert" value="1">

                                        @if ($errors->has('alert'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('alert') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="submit" id="creerCompte" value="Créer un compte"><br/>
                                <div class="oth-connexion">
                                    <ul>
                                        <li>
                                            <a style="text-decoration:none;color:white " href="{{route('facebook')}}"><button type="button" class="facebook-button" name="button">Facebook</button></a>
                                        </li>
                                        <li>
                                            <a style="text-decoration:none;color:white " href="{{route('google')}}"><button type="button" class="google-button" name="button">Google</button></a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function indicationMotDepasse(){
            var mdp = document.getElementById('password').value;

            var regExpCaractereSpeciaux = new RegExp("[@|!|?|$|/|\|_|-|'|\"|#|;|,|(|)|[|]|=|:|&]+","g");
            var resRegexpCaract = regExpCaractereSpeciaux.test(mdp);


            if(mdp.length > 11  && resRegexpCaract){
                document.getElementsByClassName('progressBarValue')[0].style.width='100%';
                document.getElementsByClassName('progressBarValue')[0].style.backgroundColor='green';
                document.getElementById('forceMDP').innerHTML='Fort';
                document.getElementById('forceMDP').style.color='green';
            }
            else if(mdp.length > 7 && mdp.length < 11){
                document.getElementsByClassName('progressBarValue')[0].style.width='50%';
                document.getElementsByClassName('progressBarValue')[0].style.backgroundColor='orange';
                document.getElementById('forceMDP').innerHTML='Moyen';
                document.getElementById('forceMDP').style.color='orange';
            }
            else if(mdp.length <= 7 ){
                document.getElementsByClassName('progressBarValue')[0].style.width='25%';
                document.getElementsByClassName('progressBarValue')[0].style.backgroundColor='#a52c2c';
                document.getElementById('forceMDP').innerHTML='Faible';
                document.getElementById('forceMDP').style.color='#a52c2c';
            }
            if (mdp.length < 6) {
                document.getElementsByClassName('progressBarValue')[0].style.width='0%';
                document.getElementById('forceMDP').innerHTML='6 caractéres min';
            }
        }
    </script>
@endsection
