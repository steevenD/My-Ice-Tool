<?php
  $titre='Carte Utilisateur';
?>

@extends('layouts.app')
@section('content')
<style type="text/css">
  #pac-input-cascade{
    width : 90% ;
    max-width : 500px ;
    border : 1px solid #aaa ;
    border-radius : 5px ;
    box-shadow : 0px 0px 20px 0px rgba(0,0,0,0.5) ;
    padding : 10px 15px ;
    background-color : rgba(255,255,255,0.7) ;
  }
</style>
    <div class="aground-img-pop cnt-cnt" id="aground-img-pop" onclick="closePopUpImg()">
      <div class="position-pop cnt-cnt">
        <div class="positionIMG">
            <i class="fa fa-times" id="closePop" aria-hidden="true"></i>
            <img id="photoZoom" src="" alt="">
        </div>
      </div>
    </div>
    <div  id="map"></div>
    <div id="history-open" class="scrollbar history-open">
        <div class="closebtn" onclick="closeHistory()">
            <p><i class="fa fa-times" aria-hidden="true"></i></p>
        </div>
        <div class="list-history">
            <table id="tabHistorique">
            </table>
        </div>
    </div>
    <div id="commentary-open" class="scrollbar commentary-open">
        <div class="closebtn" onclick="closeCommentary()">
            <p><i class="fa fa-times" aria-hidden="true"></i></p>
        </div>
        <div id="lesCommentaires" class="list-commentary">
        </div>
        <div id="ajoutCommentaire" class="leave-commentary">
        </div>
    </div>

    <script type="text/javascript">
        @if($errors->any())
        alert('{{$errors->first()}}');
        @endif

        function Xhr(){
            var obj = null;
            try { obj = new ActiveXObject("Microsoft.XMLHTTP");}
            catch(Error) { try { obj = new ActiveXObject("MSXML2.XMLHTTP");}
            catch(Error) { try { obj = new XMLHttpRequest();}
            catch(Error) { alert(' Impossible de créer l\'objet XMLHttpRequest')}
            }
            }
            return  obj;
        };

        function deletePhotos() {
            var input = document.getElementById("filesToUpload");
            input.value = null;
            makeFileList();
        }

        function makeFileList() {
            var input = document.getElementById("filesToUpload");
            var ul = document.getElementById("fileList");
            while (ul.hasChildNodes()) {
                ul.removeChild(ul.firstChild);
            }
            var content = '<div class="listImages"><div class="listStrongs">';
            for (var i = 0; i < input.files.length; i++) {
                var p = document.createElement("p");
                content += '<strong>'+input.files[i].name+'</strong>';
            }
            content += '</div><button onclick="deletePhotos()">Supprimer</button></div>';
            p.innerHTML= content;
            ul.appendChild(p);

            if(!ul.hasChildNodes()) {
                var li = document.createElement("li");
                li.innerHTML = 'Aucune photo sélectionnée';
                ul.appendChild(li);
            }
        }

        function verifAjout() {
            if (document.getElementById('contentComm').value == '') {
                alert('Veuillez insérer un commentaire.');
                return false;
            }
            return true;
        }

        function addCommentary(idCascade) {

            document.getElementById("commentary-open").style.maxWidth = "550px";
            document.getElementById("commentary-open").style.width = "100%";
            document.getElementById("commentary-open").style.minWidth = "100px";

            var content = `<form action="{{ route('ajoutCommentaire') }}" onsubmit="return verifAjout()" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                <input  name="cascadeId" type="hidden" value="`+idCascade+`">
                      <div class="img-list-add">
                        <ul id="fileList">Aucune photo sélectionnée</ul>
                      </div>
                      <textarea name="contentComment" id="contentComm" rows="8" cols="80" placeholder="Votre commentaire ici ..."></textarea>
                      <div class="cnt-space-cnt">
                        <input type="file" name="filesToUpload[]" id="filesToUpload" multiple="" onChange="makeFileList();"></i></button>
                        <input type="submit" name="submit-commentary" value="Envoyer">
                      </div>
                    </form>`;


            document.getElementById("lesCommentaires").innerHTML=content;

        }

        function deleteCommentaire(idCascade, commentaireId) {
            var req = new Xhr();
            var rt = "{{ route('deleteCommentaireUser') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            req.onreadystatechange = function() {
                openCommentary(idCascade);
            }
            var data = encodeURIComponent('commentaireId') + '='+ encodeURIComponent(commentaireId);
            req.send(data);
        }

        function openCommentary(idCascade) {
            document.getElementById("commentary-open").style.maxWidth = "550px";
            document.getElementById("commentary-open").style.width = "100%";
            document.getElementById("commentary-open").style.minWidth = "100px";

            var req = new Xhr();
            var rt = "{{ route('afficherCommentaires') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            req.onreadystatechange = function() {
                if(this.readyState == this.DONE && this.status == 200 ) {
                    var oData=JSON.parse(this.responseText);
                    var content = '';
                    for(var i=0;i<oData.length;i++) { // génération de la deuxième liste déroulante
                        var dateCom = oData[i].created_at.substring(0, 10);
                        var tabDateCom = dateCom.split('-');
                        var annee = tabDateCom[0];
                        var mois = tabDateCom[1];
                        var jour = tabDateCom[2];

                        var heureCom = oData[i].created_at.substring(11,16);

                        var btnSuppr = '';
                        if ({{$user->id}} == oData[i].userId) {
                            btnSuppr = '<i onclick="deleteCommentaire('+idCascade+','+oData[i].id+')" class="fa fa-times" aria-hidden="true"></i>';
                        }

                        content+= `<div class="commentary dvid">
                          <div class="com-prof bxd12 bxt12 bxm12">
                            <div class="top-com"><h2 class="name-profile">`+oData[i].name+`<strong class="text-profile"> Le `+jour+`/`+mois+`/`+annee+` à `+heureCom+`</strong></h2>`+btnSuppr+`</div>
                            <span class="text-profile">`+oData[i].libComm+`</span>
                          </div>
                          <div class="img-com-dl bxd12 bxt12 bxm12">`;
                        for(var j=0;j<oData[i].photos.length;j++) {
                            content+=`<img id="imgComment`+oData[i].photos[j].id+`" src="https://steeven-demay.fr/projet_tuteure/laravel/public/img-comments/`+oData[i].photos[j].urlPhoto+`" onclick="openPopUpImg(`+oData[i].photos[j].id+`)" alt="Image `+oData[i].photos[j].id+`">`;
                        }
                        content+=`</div> </div>`;
                    }
                    document.getElementById("lesCommentaires").innerHTML=content;

                }
            }
            var data = encodeURIComponent('cascadeId') + '='+ encodeURIComponent(idCascade);
            req.send(data);

        }

        function infosCascade(idCascade, lat,long) {
            document.getElementById("commentary-open").style.maxWidth = "550px";
            document.getElementById("commentary-open").style.width = "100%";
            document.getElementById("commentary-open").style.minWidth = "100px";

            var req = new Xhr();
            var rt = "{{ route('infoCascade') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            req.onreadystatechange = function() {
                if(this.readyState == this.DONE && this.status == 200 ) {
                    var oData=JSON.parse(this.responseText);
                    var content = `<div class="commentary dvid">
                          <div class="com-prof bxd12 bxt12 bxm12">
                            <div class="top-com"><h2 class="name-profile">`+oData[0].nomCascade+`</strong></h2></div>
                            <span class="text-profile">Latitude : `+lat+`
                            <br>Longitude : `+long+`
                            <br><br>Altitude : `+oData[0].altiMiniCascade+` m
                            <br>Hauteur : `+oData[0].hauteurCascade+` m
                            <br>Niveau de difficulté : `+oData[0].niveauDifCascade+`
                            <br>Niveau d'engagement : `+oData[0].niveauEngCascade+`
                            <br>Orientation : `+oData[0].orientCascade+`
                            <br>Type de glace : `+oData[0].libTypeGlace+`
                            <br>Type fin de vie : `+oData[0].libTypeFin+`
                            <br>Structure : `+oData[0].libStructure+`
                            <br><br>`;
                    if (oData[0].constituants.length !=0) {
                        content+=`Constituants :`;
                        for (var i = 0; i < oData[0].constituants.length; i++) {
                            content+=`<br> `+oData[0].constituants[i].libConst +` (${oData[0].constituants[i].pivot.poids} %)`;
                        }
                    } else {
                        content+=`Aucun consituant disponible pour cette cascade.`;
                    }

                    if (oData[0].supports.length !=0) {
                        content+=`<br><br>Supports :`;
                        for (var i = 0; i < oData[0].supports.length; i++) {
                            content+=`<br>`+oData[0].supports[i].libSupp;
                        }
                    } else {
                        content+=`<br>Aucun support disponible pour cette cascade.`;
                    }


                    content+=`</span>
                      </div>
                      <div class="img-com-dl bxd12 bxt12 bxm12">
                    </div> </div>`;
                    document.getElementById("lesCommentaires").innerHTML=content;

                }
            }
            var data = encodeURIComponent('cascadeId') + '='+ encodeURIComponent(idCascade);
            req.send(data);

        }

        function closePopUpImg() {
            document.getElementById('aground-img-pop').style.height = "0px";
            document.getElementById('aground-img-pop').style.display = "none";
        }

        function openPopUpImg(idImg) {
            var id = "imgComment"+idImg;
            document.getElementById('photoZoom').src = document.getElementById(id).src;
            document.getElementById('aground-img-pop').style.height = "calc(100vh - 98px)";
            document.getElementById('aground-img-pop').style.display = "block";
        }

        function openHistory(idZone) {
            document.getElementById("history-open").style.maxWidth = "650px";
            document.getElementById("history-open").style.width = "100%";
            document.getElementById("history-open").style.minWidth = "100px";
            var req = new Xhr();
            var rt = "{{ route('historiqueComplet') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            req.onreadystatechange = function() {
                if(this.readyState == this.DONE && this.status == 200 ) {
                    var oData=JSON.parse(this.responseText);
                    var content = "<tr><th>Date</th><th>Heure</th><th>Température moyenne</th><th>Niveau de danger</th></tr>";
                    for(var i=0;i<oData.length;i++) { // génération de la deuxième liste déroulante
                        var dateCom = oData[i].dateReleve.substring(0, 10);
                        var tabDateCom = dateCom.split('-');
                        var annee = tabDateCom[0];
                        var mois = tabDateCom[1];
                        var jour = tabDateCom[2];
                        content+= '<tr><td>'+jour+'/'+mois+'/'+annee+'</td><td>'+oData[i].heureReleve+'</td><td>'+oData[i].temperatureMoyReleve+'</td><td>'+oData[i].niveauDangerReleve+'</td></tr>';

                    }
                    document.getElementById("tabHistorique").innerHTML=content;

                }
            }
            var data = encodeURIComponent('zoneId') + '='+ encodeURIComponent(idZone);
            req.send(data);
        }

        function selectCascade() {
          var req = new Xhr();
          var rt = "{{ route('rechercheCascadeBis') }}";
          req.open("POST", rt, true);
          req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
          req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
          req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          var nomCascade = document.getElementById('pac-input-cascade').value;
          var data = encodeURIComponent('nomCascade') + '='+ encodeURIComponent(nomCascade);
          req.send(data);
          req.onreadystatechange = function() {
            if(this.readyState == this.DONE && this.status == 200 ) {
              var oData=JSON.parse(this.responseText);
              map.setCenter(new google.maps.LatLng(oData[0].latCascade, oData[0].longCascade));
              map.setZoom(15);
            }
          }
        }

        function debutRecherche() {
            var debut = document.getElementById('pac-input-cascade').value;
            if(debut!='') {
              var req = new Xhr();
              var rt = "{{ route('rechercheCascade') }}";
              req.open("POST", rt, true);
              req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
              req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
              req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              var data = encodeURIComponent('debut') + '='+ encodeURIComponent(debut);
              req.send(data);
              req.onreadystatechange = function() {
                if(this.readyState == this.DONE && this.status == 200 ) {
                  var oData=JSON.parse(this.responseText);
                  var datalist= document.getElementById("cascadesDatalist");
                  datalist.innerHTML = '';

                  for(var i=0;i<oData.length;i++) { // génération de la deuxième liste déroulante
                      var optionCascade=document.createElement("option");
                      optionCascade.value=oData[i].nomCascade;
                      datalist.appendChild(optionCascade);
                  }
                }
              }
            }
        }

        function initMap() {

            var latMap = 46.52863469527167;
            var lngMap = 2.43896484375;
            var leZoom = 6;

            @if ($zoneZoom != null)
                latMap = {{$zoneZoom->latNEzone}};
                lngMap = {{$zoneZoom->longNEzone}};
                leZoom = 9;
            @endif


                map = new google.maps.Map(document.getElementById('map'), {
                zoom: leZoom,
                center: {lat: latMap, lng: lngMap},
                styles : [
                    {
                        "stylers": [
                            {
                                "hue": "#007fff"
                            },
                            {
                                "saturation": 89
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "stylers": [
                            {
                                "color": "#cee6fd"
                            }
                        ]
                    }
                ]
            });

            var input = /** @type {!HTMLInputElement} */(document.createElement("input"));
            input.id="pac-input";
            input.placeholder="Rechercher dans Google Maps";
            input.class="controls";
            input.style.width = '90%';
            input.style.maxWidth = '500px';
            input.style.borderRadius = '5px';
            input.style.border = '1px solid #aaa';
            input.style.boxShadow = '0px 0px 20px 0px rgba(0,0,0,0.5)';
            input.style.padding = '10px 15px';
            input.style.backgroundColor = 'rgba(255,255,255,0.7)';
            input.style.display = 'none';

            var divRechercherCascade = /** @type {!HTMLInputElement} */(document.createElement("div"));
            divRechercherCascade.id="divRechercherCascade";
            divRechercherCascade.style.width="90%";
            divRechercherCascade.style.display="flex";
            divRechercherCascade.style.justifyContent="center";

            divRechercherCascade.innerHTML=`
            <input id="pac-input-cascade" class="controls" placeholder="Rechercher une Cascade" onchange="selectCascade()" list="cascadesDatalist" onkeyup="debutRecherche()">
            <datalist id="cascadesDatalist">
            </datalist>
            `;

            var switchButton = /** @type {!HTMLInputElement} */(document.createElement("img"));
            switchButton.id="switchButton";
            switchButton.alt="Fleche";
            switchButton.style.marginLeft = '20px';
            switchButton.src="https://steeven-demay.fr/projet_tuteure/laravel/public/img/arrow.png";

            var clickBis = false;

            switchButton.onclick=function() {

              if (clickBis) {
                document.getElementById('switchButton').style.transition ="1s";
                document.getElementById('switchButton').style.transform ="rotate(0deg)";
                clickBis = false;
              } else {
                clickBis = true;
                document.getElementById('switchButton').style.transition ="1s";
                document.getElementById('switchButton').style.transform ="rotate(360deg)";
              }
              if (document.getElementById('pac-input').style.display=='none') {
                document.getElementById('pac-input').style.display='flex';
                document.getElementById('pac-input-cascade').style.display='none';
              } else {
                document.getElementById('pac-input').style.display='none';
                document.getElementById('pac-input-cascade').style.display='flex';
              }
            };

            divRechercherCascade.appendChild(input);
            divRechercherCascade.appendChild(switchButton);

            var types = document.getElementById('type-selector');

            map.controls[google.maps.ControlPosition.TOP_CENTER].push(divRechercherCascade);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(types);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            autocomplete.addListener('place_changed', function() {
                //marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("Aucun lieu trouvé pour : '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(15);  // Why 17? Because it looks good.
                }

                /*marker.setPosition(place.geometry.location);
                marker.setVisible(true);*/

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }


            });

            locations = [];

            @foreach($stations as $station)
            (function () {
                var markerStation = "";

                var latPosition = {{ $station->latStation }};
                var lngPosition = {{ $station->longStation }};

                var coords = {
                    'lat' : latPosition,
                    'lng' : lngPosition
                };
                locations.push(coords);

            }()); // immediate invocation
                    @endforeach

            var imageStation = {
                    url: '../img/station-icon.png',
                    // This marker is 20 pixels wide by 32 pixels high.
                };

            var imageCascade = {
                url: '../img/cascade-icon.png',
                // This marker is 20 pixels wide by 32 pixels high.
            };

            var shape = {
                coords: [0,0,0,100,100,100,100,0],
                type: 'poly'
            };

            var markers = locations.map(function(location) {
                return new google.maps.Marker({
                    position: location,
                    icon: imageStation
                });
            });

            @foreach($cascades as $cascade)
            (function () {
                var markerCascade = "";
                var latPosition = {{ $cascade->latCascade }};
                var lngPosition = {{ $cascade->longCascade }};
                var titre = '{{ $cascade->nomCascade }}';

                var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h1 id="firstHeading" class="firstHeading">{{ $cascade->nomCascade }}</h1>'+
                    '<div id="bodyContent">'+
                    '<p>Longitude : {{ $cascade->longCascade }}</p>'+
                    '<p>Latitude : {{ $cascade->latCascade }}</p>'+
                    '<p class="btn-map" onclick="addCommentary({{ $cascade->id }})">Ajouter un commentaire</p>'+
                    '<p class="btn-map" onclick="openCommentary({{ $cascade->id }})">Afficher les commentaires</p>'+
                    '<p class="btn-map" onclick="infosCascade({{ $cascade->id }},{{ $cascade->latCascade }},{{ $cascade->longCascade }})">En savoir plus</p>'+
                    '</div>'+
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                markerCascade = new google.maps.Marker({
                    position: {lat: latPosition * 1, lng: lngPosition * 1},
                    map: map,
                    icon: imageCascade,
                    shape: shape,
                    title: titre,
                    zIndex: 4
                });

                markers.push(markerCascade);
                infowindow.setPosition()
                var click = true;

                markerCascade.addListener('click', function() {
                    infowindow.open(map, markerCascade);
                    if(click) {
                        click = false;
                    } else {
                        infowindow.close();
                        click=true;
                    }
                });

                infowindow.addListener('closeclick', function () {
                    if(click) {
                        click = false;
                    } else {
                        click=true;
                    }
                })
            }()); // immediate invocation
            @endforeach

            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            setMapOnAll(null);

            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://steeven-demay.fr/projet_tuteure/laravel/public/img/n'});


            @foreach($zones as $zone)
            (function () {
                var rectangle = new google.maps.Rectangle({
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    @switch($zone->niveauDangerZone)
                            @case(1)
                    fillColor: '#47C890',
                    strokeColor: '#1F9041',
                    @break
                            @case(2)
                    fillColor: '#E99A40',
                    strokeColor: '#FE7F01',
                    @break
                            @case(3)
                    fillColor: '#E54A4A',
                    strokeColor: '#FE0101',
                    @break
                            @default
                    fillColor: '#ABA1A1',
                    strokeColor: '#918282',
                    @endswitch
                    fillOpacity: 0.35,
                    map: map,
                    editable: false,
                    draggable: false,
                    bounds: {
                        north: {{ $zone->latNEzone }},
                        south: {{ $zone->latSWzone }},
                        east: {{ $zone->longNEzone }},
                        west: {{ $zone->longSWzone }}
                    }
                });
                var bool=false;
                var temperature = "Aucun relevé disponible";
                var rt = "{{ route('derniereTemperature') }}";
                var req = new Xhr();
                req.onreadystatechange = function() {
                    //var oData=JSON.parse(this.responseText);
                    if(this.readyState == this.DONE && this.status == 200 ) {
                        var oData=this.responseText;
                        if (oData !== "") {
                            oData = JSON.parse(oData);
                            temperature = oData.temperatureMoyReleve;
                        }

                        var zoneZoom = '<p class="btn-map" id="iconeFavoris{{$zone->id}}" onClick="addZoomFavoris({{$zone->id}})">Choisir comme zone par défaut</p>';
                        @if ($zone->id == $user->zone_id)
                            zoneZoom = '<p class="btn-map" id="iconeFavoris{{$zone->id}}" onClick="deleteZoomFavoris({{$zone->id}})">Enlever comme zone par défaut</p>';
                                @endif

                        var zoneFav = '<h1 id="firstHeading" class="firstHeading"><img onclick="addZoneFavoris({{$zone->id}})" id="favoris{{$zone->id}}" src="../img/favorisnb-icon.png"/>Informations de la zone : </h1>';
                        @foreach($user->zones as $zoneFav)
                                @if ($zone->id == $zoneFav->id)
                            zoneFav = '<h1 id="firstHeading" class="firstHeading"><img onclick="deleteZoneFavoris({{$zone->id}})" id="favoris{{$zone->id}}" src="../img/favoris-icon.png"/>Informations de la zone : </h1>';
                                @endif
                                @endforeach


                        var contentString = '<div id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            zoneFav+
                            '<div id="bodyContent">'+
                            '<p><br>Dernière température : '+temperature+'</p>'+
                            '<p>Niveau de dangerosité : '+{{$zone->niveauDangerZone}}+'</p><br>'+
                        '<p class="btn-map" onclick="openHistory({{$zone->id}})">Voir l\'historique des températures</p>'+
                        zoneZoom+
                        '</div>'+
                        '</div>';

                        var outiltipEdit = new google.maps.InfoWindow({
                            content: contentString,
                            disableAutoPan : true
                        })
                        rectangle.setMap(map);


                        var dataRectangle = [{{ $zone->id }},rectangle];
                        //outiltipEdit.content.children[0].value = dataRectangle;
                        //outiltipEdit.setPosition(rectangle.getBounds().getNorthEast());
                        var click = true;

                        outiltipEdit.addListener('closeclick', function () {
                            if(click) {
                                click = false;
                            } else {
                                click=true;
                            }
                        })

                        rectangle.addListener('click', function () {
                            outiltipEdit.open(map, rectangle);
                            if(click) {
                                outiltipEdit.setPosition(rectangle.getBounds().getNorthEast())
                                click = false;
                            } else {
                                outiltipEdit.setPosition(null);
                                click=true;
                            }
                        })
                    }

                }
                req.open("POST", rt, true);
                req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                var data = encodeURIComponent('idZone') + '='+ encodeURIComponent({{$zone->id}});
                req.send(data);


            }()); // immediate invocation

            @endforeach

        }

        function addZoomFavoris(idZone) {
            var idZ = 'iconeFavoris'+String(idZone);
            document.getElementById(idZ).innerHTML = '<p class="btn-map" id="iconeFavoris{{$zone->id}}" onClick="deleteZoomFavoris('+idZone+')">Enlever comme zone par défaut</p>';

            var req = new Xhr();
            var rt = "{{ route('addZoomFavoris') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('zoneId') + '='+ encodeURIComponent(idZone);
            req.send(data);
            req.onreadystatechange = function() {
                if(this.readyState == this.DONE && this.status == 200 ) {
                    document.location.reload(true);
                }
            }

        }

        function deleteZoomFavoris(idZone) {
            var idZ = 'iconeFavoris'+String(idZone);
            document.getElementById(idZ).innerHTML = '<p class="btn-map" id="iconeFavoris{{$zone->id}}" onClick="addZoomFavoris('+idZone+')">Choisir comme zone par défaut</p>'

            var req = new Xhr();
            var rt = "{{ route('deleteZoomFavoris') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            req.send();
        }

        function addZoneFavoris(idZone) {
            var req = new Xhr();
            var rt = "{{ route('addZoneFavoris') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('zoneId') + '='+ encodeURIComponent(idZone);
            req.send(data);
            var idP = 'favoris'+String(idZone);
            document.getElementById(idP).src='../img/favoris-icon.png';
            document.getElementById(idP).onclick = function() { deleteZoneFavoris(idZone); };
        }

        function deleteZoneFavoris(idZone) {
            var req = new Xhr();
            var rt = "{{ route('deleteZoneFavoris') }}";
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('zoneId') + '='+ encodeURIComponent(idZone);
            req.send(data);
            var idP = 'favoris'+String(idZone);
            document.getElementById(idP).src='../img/favorisnb-icon.png';
            document.getElementById(idP).onclick = function() { addZoneFavoris(idZone); };
        }

    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiDds3g6WAElTYpZdJHggYO98HVnG5zWs&callback=initMap&libraries=geometry,places">
    </script>
@endsection
