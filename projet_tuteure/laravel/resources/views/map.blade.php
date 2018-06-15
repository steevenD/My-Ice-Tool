<?php
  $titre='Carte Admin';
?>

@extends('layouts.app')
@section('content')
    <div class="aground-img-pop cnt-cnt" id="aground-img-pop" onclick="closePopUpImg()">
      <div class="position-pop cnt-cnt">
        <div class="positionIMG">
            <i class="fa fa-times" id="closePop" aria-hidden="true"></i>
            <img id="photoZoom" src="" alt="">
        </div>
      </div>
    </div>
    <div  id="map"></div>
    <div id="commentary-open" class="commentary-open">
        <div class="closebtn" onclick="closeCommentary()">
            <p><i class="fa fa-times" aria-hidden="true"></i></p>
        </div>
        <div id="lesCommentaires" class="list-commentary">
        </div>
    </div>
    <script type="text/javascript">

        var zonesDeleted =[];

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

        function windowEditZone(rectangle, zoneId) {
            var div = document.createElement('div')
            div.className = 'outiltip'

            var span = document.createElement('span')
            span.hidden = true
            span.id = 'polygone'
            div.appendChild(span)

            // Button delete
            var spanDelete = document.createElement('span')
            spanDelete.className = 'material-icons'
            spanDelete.textContent = 'Supprimer'
            var linkDelete = document.createElement('a')
            linkDelete.onclick = function() {
                if (typeof zoneId !== 'undefined') {
                    zonesDeleted.push(zoneId);
                }
                rectangle.setMap(null);
            }
            linkDelete.appendChild(spanDelete)
            div.appendChild(linkDelete)

            // Button edit
            var spanEdit = document.createElement('span')
            spanEdit.className = 'material-icons'
            spanEdit.textContent = 'Editer'
            var linkEdit = document.createElement('a')
            linkEdit.onclick = function() {
                rectangle.setOptions({editable: true});
                rectangle.setOptions({draggable: true});
            }
            linkEdit.appendChild(spanEdit)
            div.appendChild(linkEdit)

            // Button valided
            var spanValid = document.createElement('span')
            spanValid.className = 'material-icons'
            spanValid.textContent = 'Valider'
            var linkValid = document.createElement('a')
            linkValid.onclick = function() {
                rectangle.setOptions({editable: false});
                rectangle.setOptions({draggable: false});
                outiltipEdit.setPosition(null);
            }
            linkValid.appendChild(spanValid)
            div.appendChild(linkValid)

            var outiltipEdit = new google.maps.InfoWindow({
                content: div,
                disableAutoPan : true
            })

            return outiltipEdit;
        }

        function CenterControl(controlDiv, map, center) {
            // We set up a variable for this since we're adding event listeners
            // later.
            var control = this;

            // Set the center property upon construction
            control.center_ = center;
            controlDiv.style.clear = 'both';

            // Set CSS for the control border
            var ajoutZone = document.createElement('div');
            ajoutZone.id = 'ajoutZone';
            ajoutZone.title = 'Click to recenter the map';
            controlDiv.appendChild(ajoutZone);

            // Set CSS for the control interior
            var ajoutZoneText = document.createElement('div');
            ajoutZoneText.id = 'ajoutZoneText';
            ajoutZoneText.innerHTML = 'Ajouter zone';
            ajoutZone.appendChild(ajoutZoneText);

            // Set CSS for the setCenter control border
            var enregistrerZone = document.createElement('div');
            enregistrerZone.id = 'enregistrerZone';
            enregistrerZone.title = 'Click to change the center of the map';
            controlDiv.appendChild(enregistrerZone);

            // Set CSS for the control interior
            var enregistrerZoneText = document.createElement('div');
            enregistrerZoneText.id = 'enregistrerZoneText';
            enregistrerZoneText.innerHTML = 'Enregistrer les modifications';
            enregistrerZone.appendChild(enregistrerZoneText);


            ajoutZone.addEventListener('click', function() {
                control.ajoutZone();
            });

            enregistrerZone.addEventListener('click', function() {
                control.enregistrerZone();
            });
        }


        CenterControl.prototype.ajoutZone = function() {


            var coordonnees = map.getBounds();
            var longitudeSud = (coordonnees.b.b);
            var longitudeNord = (coordonnees.b.f);
            var latitudetudeNord = (coordonnees.f.f);
            var latitudetudeSud = (coordonnees.f.b);
            var bounds = {
                north: map.getBounds().f.f-(0.25 * (map.getBounds().f.f - map.getBounds().f.b)),
                south: map.getBounds().f.b+(0.25 * (map.getBounds().f.f - map.getBounds().f.b)),
                east: map.getBounds().b.f-(0.25 * (map.getBounds().b.f-map.getBounds().b.b)),
                west: map.getBounds().b.b+(0.25 * (map.getBounds().b.f-map.getBounds().b.b)),
            };


            var rectangle = new google.maps.Rectangle({
                bounds: bounds,
                editable: true,
                draggable: true
            });

            var outiltipEdit = windowEditZone(rectangle);

            rectangle.setMap(map);
            rectangle.addListener('bounds_changed', showNewRect);

            function showNewRect(event) {

                var click = false;
                rectangle.addListener('click', function () {
                    if(click) {
                        outiltipEdit.setPosition(rectangle.getBounds().getNorthEast())
                        click = false;
                    } else {
                        outiltipEdit.setPosition(null);
                        click=true;
                    }
                })

                outiltipEdit.open(map, rectangle)
                outiltipEdit.content.children[0].value = rectangle
                outiltipEdit.setPosition(rectangle.getBounds().getNorthEast())

            }
        };

        CenterControl.prototype.enregistrerZone = function() {
            var zones= [];

            for (var i = 0; i < zonesDeleted.length; i++) {
                var req = new Xhr();
                var rt = "{{ route('deleteZone') }}";
                req.open("POST", rt, true);
                req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                var data = encodeURIComponent('zoneId') + '='+ encodeURIComponent(zonesDeleted[i]);
                req.send(data);
            }

            for (var i = 0; i < document.getElementsByClassName('outiltip').length; i++) {
                var req = new Xhr();
                if (typeof document.getElementsByClassName('outiltip')[i].firstChild.value[2] != 'undefined') {
                    if (document.getElementsByClassName('outiltip')[i].firstChild.value[2]==true) {
                        var rt = "{{ route('editZone') }}";
                        var zone = [document.getElementsByClassName('outiltip')[i].firstChild.value[0],document.getElementsByClassName('outiltip')[i].firstChild.value[1]];
                        var tabZone = {};
                        tabZone.id = zone[0];
                        tabZone.longSw = zone[1].bounds.b.b;
                        tabZone.longNe = zone[1].bounds.b.f;
                        tabZone.latSw = zone[1].bounds.f.b;
                        tabZone.latNe = zone[1].bounds.f.f;
                        zoneJson = JSON.stringify(tabZone);
                        req.open("POST", rt, true);
                        req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        var data = encodeURIComponent('zone') + '='+ encodeURIComponent(zoneJson);
                        req.send(data);
                    }
                }
                else {
                    var coords = {
                        'longSw' : document.getElementsByClassName('outiltip')[i].firstChild.value.bounds.b.b,
                        'longNe' : document.getElementsByClassName('outiltip')[i].firstChild.value.bounds.b.f,
                        'latSw' : document.getElementsByClassName('outiltip')[i].firstChild.value.bounds.f.b,
                        'latNe' : document.getElementsByClassName('outiltip')[i].firstChild.value.bounds.f.f
                    };
                    zones.push(coords);
                }


            };
            var rt = "{{ route('enregistrerZone') }}";

            var req = new Xhr();

            test = JSON.stringify(zones);
            req.open("POST", rt, true);
            req.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = encodeURIComponent('zones') + '='+ encodeURIComponent(test);
            req.send(data);

            alert('Toutes les modifications ont bien été prises en compte !');
            document.location.reload(true);

        };

        function initMap() {

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: {lat: 46.52863469527167, lng: 2.43896484375},
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

            // Create the DIV to hold the control and call the CenterControl()
            // constructor
            // passing in this DIV.
            var centerControlDiv = document.createElement('div');
            var centerControl = new CenterControl(centerControlDiv, map, map.center);

            centerControlDiv.index = 1;
            centerControlDiv.style['padding-top'] = '10px';
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);

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
                {imagePath: 'https://spinnewyn.ddns.net/projet_tuteure/laravel/public/img/n'});

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
                    fillColor: '#BDBDBD',
                    strokeColor: '#848484',
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
                var outiltipEdit = windowEditZone(rectangle, {{ $zone->id }});
                rectangle.setMap(map);

                var f = function(){
                    showNewRect2(rectangle,outiltipEdit);
                };

                var f2 = function(){
                    aEteModifie({{ $zone->id }}, rectangle, outiltipEdit);
                };

                rectangle.addListener('bounds_changed', f);
                rectangle.addListener("dragend", f2);
                rectangle.addListener("bounds_changed", f2);

                outiltipEdit.open(map, rectangle);
                var dataRectangle = [{{ $zone->id }},rectangle, false];
                outiltipEdit.content.children[0].value = dataRectangle;
                //outiltipEdit.setPosition(rectangle.getBounds().getNorthEast());
                var click = true;
                rectangle.addListener('click', function () {
                    if(click) {
                        outiltipEdit.setPosition(rectangle.getBounds().getNorthEast())
                        click = false;
                    } else {
                        outiltipEdit.setPosition(null);
                        click=true;
                    }
                })

            }()); // immediate invocation

            @endforeach
            function aEteModifie(zoneId, rectangle, outiltipEdit) {
                var dataRectangle = [zoneId ,rectangle, true];
                outiltipEdit.content.children[0].value = dataRectangle;
            }

            function showNewRect2(rectangle, outiltipEdit) {
                var click = false;
                rectangle.addListener('click', function () {
                    if(click) {
                        outiltipEdit.setPosition(rectangle.getBounds().getNorthEast())
                        click = false;
                    } else {
                        outiltipEdit.setPosition(null);
                        click=true;
                    }
                })

                outiltipEdit.open(map, rectangle)
                outiltipEdit.content.children[0].value = rectangle
                outiltipEdit.setPosition(rectangle.getBounds().getNorthEast())

            }

        }

        function deleteCommentaire(idCascade, commentaireId) {
            var req = new Xhr();
            var rt = "{{ route('deleteCommentaireAdmin') }}";
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
                    console.log(oData);
                    var content = '';
                    for(var i=0;i<oData.length;i++) { // génération de la deuxième liste déroulante
                        var dateCom = oData[i].created_at.substring(0, 10);
                        var tabDateCom = dateCom.split('-');
                        var annee = tabDateCom[0];
                        var mois = tabDateCom[1];
                        var jour = tabDateCom[2];

                        var heureCom = oData[i].created_at.substring(11,16);


                        content+= `<div class="commentary dvid">
                        <div class="com-prof bxd12 bxt12 bxm12">
                          <div class="top-com cnt-space-cnt"><h2 class="name-profile-map">`+oData[i].name+`<strong class="text-profile"> Le `+jour+`/`+mois+`/`+annee+` à `+heureCom+`</strong></h2><i onclick="deleteCommentaire(`+idCascade+`,`+oData[i].id+`)" class="fa fa-times" aria-hidden="true"></i></div>
                          <span class="text-profile">`+oData[i].libComm+`</span>
                        </div>
                        <div class="img-com-dl bxd12 bxt12 bxm12">`;
                        for(var j=0;j<oData[i].photos.length;j++) {
                            content+=`<img id="imgComment`+oData[i].photos[j].id+`" src="https://spinnewyn.ddns.net/projet_tuteure/laravel/public/img-comments/`+oData[i].photos[j].urlPhoto+`" onclick="openPopUpImg(`+oData[i].photos[j].id+`)" alt="Image `+oData[i].photos[j].id+`">`;
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
                          <br>Hauteur : `+oData[0].hauteurCascade+`
                          <br>Niveau de difficulté : `+oData[0].niveauDifCascade+`
                          <br>Niveau d'engagement : `+oData[0].hauteurCascade+`
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

    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiDds3g6WAElTYpZdJHggYO98HVnG5zWs&callback=initMap&libraries=geometry">
    </script>
@endsection
