<?php
  $titre='Contact';
?>

@extends('layouts.app')

@section('content')
    <div class="container-web-site"  onclick="closeNavRight(), closeNavLeft()">
        <div class="background-contact cnt-cnt">
            <div class="dvid">
                <div class="bxd12 bxt12 bxm12 pad-box-spe">
                    <div class="box-spe contact-page">
                        <h2>Besoin de nous contacter ?</h2>
                        <form class="dvid" action="index.html" method="post">
                            <div class="bxd6 bxt6 bxm12 pad-box-spe">
                                <input type="text" name="first_name" placeholder="Jean">
                            </div>
                            <div class="bxd6 bxt6 bxm12 pad-box-spe">
                                <input type="text" name="last_name" placeholder="Bon">
                            </div>
                            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                                <input type="email" name="email" placeholder="E-mail">
                            </div>
                            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                                <input type="text" name="object" placeholder="Titre de votre demande">
                            </div>
                            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                                <textarea name="name" rows="8" cols="80" placeholder="Votre message ici ..."></textarea>
                            </div>
                            <div class="bxd12 bxt12 bxm12 pad-box-spe">
                                <input type="submit" name="submit" value="Envoyé">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
