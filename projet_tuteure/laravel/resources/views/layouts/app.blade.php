<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php $titre=''; ?>
    <title>{{ config('','MyIceTool'.$titre ) }}</title>

    <!-- Styles -->

    <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
    <link href="{{ asset('css/boxrex.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/index.js') }}"></script>


</head>
<body>
@guest
    <div class="header-base">
        <div class="structure-header-base" id="header-tab-base">
            <div id="menu-open-left" class="menu-open-left">
                <div onclick="closeNavLeft()">
                    <p>+</p>
                </div>
                <div class="menu-list">
                    <ul>
                        <li><a href="{{ url('/') }}">Accueil</a></li>
                        <li><a href="{{ route('mapVisitor') }}">Carte Visiteur</a></li>
                        <li><a href="{{route('a_propos')}}">A Propos</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div id="menu-open-right" class="menu-open-right">
                <p id="close-menuRight" onclick="closeNavRight()">Fermer <i class="fa fa-times" aria-hidden="true"></i></p>
                <div class="menu-list-co">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <ul>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <li><input type="text" placeholder="Votre email" name="email" value="{{ old('email') }}"
                                           required autofocus></li>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <li><input type="password" placeholder="Mot de passe" name="password" required></li>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                @endif
                            </div>
                            <div class="check-remenber">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Se souvenir de moi
                            </div>
                            <li><input type="submit" value="Connexion"></li>
                            <li>
                                <a href="{{route('facebook')}}"><button type="button" class="facebook-button" name="button">Facebook</button></a>
                            </li>
                            <li>
                                <a href="{{route('google')}}"><button type="button" class="google-button" name="button">Google</button></a>
                            </li>
                            <li class="btn-mdp-f">
                                <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="menu-header-base cnt-cnt">
                <i class="fa fa-bars" onclick="openNavLeft()" aria-hidden="true"></i>
                <p class="bxm0">MY ICE <strong>TOOL</strong></p>
            </div>
            <div class="menu-header" id="button-co-ad" onclick="openNavRight()">
                Connexion <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    @else
        <div class="header-base" id="header-pad">
            <div id="menu-open-left" class="menu-open-left">
                <div onclick="closeNavLeft()">
                    <p>+</p>
                </div>
                <div class="menu-list">
                    <ul>
                        <li><a href="{{ route('mapUser') }}">Carte Utilisateur</a></li>
                        <li><a href="{{route('a_propos')}}">A Propos</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div id="menu-open-right" class="menu-open-right">
                <p id="close-menuRight" onclick="closeNavRight()">Fermer <i class="fa fa-times" aria-hidden="true"></i></p>
                <div class="menu-list-co-co">
                    <ul>
                        <li><a href="{{route('getEdit',array( Auth::user()->id))}}">Editer le profil</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu-header-base cnt-cnt">
                <i class="fa fa-bars" onclick="openNavLeft()" aria-hidden="true"></i>
                <p class="bxm0">MY ICE <strong>TOOL</strong></p>
            </div>
            <div class="menu-header" id="button-co-ad" onclick="openNavRight()">
                {{ Auth::user()->name }} <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @endguest
        @yield('content')
        <div class="footer  cnt-space-cnt">
            <p>2018 © MY ICE TOOL</p>
            <div class="menu-footer">
                <a href="{{route('conditions_generales')}}">Conditions d'utilisation</a>
                <a href="{{ route('mentions_legales') }}">Mentions légales</a>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <script>
            $.ajax
        </script>
</body>
</html>
