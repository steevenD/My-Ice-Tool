<?php
  $titre='A Propos';
?>

@extends('layouts.app')

@section('content')
    <div class="container-web-site"  onclick="closeNavRight(), closeNavLeft()">
        <div class="title-about">
            <div class="back-about cnt-cnt">
                <p>A Propos de MY ICE TOOL</p>
            </div>
        </div>
        <div class="presentation-about">
            <p>Bienvenue sur MyIceTool. Une application permettant de connaître en temps réel les conditions d'escalade de cascades de glace partout en France. Ajoutez également en favori vos zones préférées tout en partageant vos commentaires et photos avec la communauté des grimpeurs de cascades de glace.</p>
        </div>
        <div class="video-pres bxm0 bxt0">
          <!--<video src="https://spinnewyn.ddns.net/projet_tuteure/laravel/public/video/final.mp4" controls="controls" poster="https://spinnewyn.ddns.net/projet_tuteure/laravel/public/img/posterimage.jpg">
          </video>-->
            <embed src="https://www.youtube.com/v/9gy_HdFzKf4" type="application/x-shockwave-flash" wmode="transparent" height="600px"></embed>
        </div>
        <div class="dvid team-div">
            <div class="bxd3 bxt6 bxm12 pad-box-spe">
                <div class="box-spe-nopad">
                    <div class="photo-about-profil julien">
                    </div>
                    <div class="prese-about-profil">
                        <h2>Julien Gabrielli</h2>
                        <h3>21 ans</h3>
                        <h3>WebDesigner & Développeur Web Front-End</h3>
                        <a href="https://www.julien-gabrielli.fr">www.julien-gabrielli.fr</a>
                        <p>Conception et réalisation des maquettes du site ainsi qu'intégration de celles-ci.</p>
                    </div>
                </div>
            </div>
            <div class="bxd3 bxt6 bxm12 pad-box-spe">
                <div class="box-spe-nopad">
                    <div class="photo-about-profil mickael">
                    </div>
                    <div class="prese-about-profil">
                        <h2>Mickaël Lalanne</h2>
                        <h3>21 ans</h3>
                        <h3>Développeur JavaScript</h3>
                        <a href="https://www.mickael-lalanne.fr">www.mickael-lalanne.fr</a>
                        <p>Réalisation de l'application via Google Maps API.</p>
                    </div>
                </div>
            </div>
            <div class="bxd3 bxt6 bxm12 pad-box-spe">
                <div class="box-spe-nopad">
                    <div class="photo-about-profil tristan">
                    </div>
                    <div class="prese-about-profil">
                        <h2>Tristan Spinnewyn</h2>
                        <h3>23 ans</h3>
                        <h3>Développeur Web Back-End</h3>
                        <a href="https://www.tristan-spinnewyn.com">www.tristan-spinnewyn.com</a>
                        <p>Réalisation de l'application via Google Maps API et aide à la réalisation et à la conception de Laravel.</p>
                    </div>
                </div>
            </div>
            <div class="bxd3 bxt6 bxm12 pad-box-spe">
                <div class="box-spe-nopad">
                    <div class="photo-about-profil steeven">
                    </div>
                    <div class="prese-about-profil">
                        <h2>Steeven Demay</h2>
                        <h3>20 ans</h3>
                        <h3>Chef de Projet & Développeur Web Back-End</h3>
                        <a href="https://www.steeven-demay.fr">www.steeven-demay.fr</a>
                        <p>Conception et réalisation du cahier des charges et réalisaiton de la la section Laravrel et SQL.</p>
                    </div>
                </div>
            </div>
          </div>
          <div class="partenaires-container">
            <h2>Nos partenaires</h2>
            <div class="content-part">

              <!--PARTENAIRES-->
              @foreach($partenaires as $partenaire)
                <a href="http://{{$partenaire->sitePart}}">
                  <img src="../../public/img/partenaires/{{$partenaire->logoPart}}" alt="{{ $partenaire->nomPart }}" />
                </a>
              @endforeach
              <!-- FIN PARTENAIRE-->
          </div>
        </div>
    </div>
@endsection
