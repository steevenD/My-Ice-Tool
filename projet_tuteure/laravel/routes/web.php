<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin','HomeController@admin')->name('admin');

//CASCADES
Route::get('/admin/cascade/ajoutercascade','HomeController@ajoutercascade')->name('ajoutercascade');
Route::post('/admin/cascade/ajouterUneCascade','HomeController@ajouterUneCascade')->name('ajouterUneCascade');

Route::get('/admin/cascade/supprimermodifiercascade','HomeController@supprimermodifiercascade')->name('supprimermodifiercascade');
Route::get('/admin/cascade/delete/{id}', 'HomeController@delete');

Route::get('/admin/cascade/edit/{id}', 'HomeController@edit')->name("edit");
Route::post('/admin/cascade/update/{id}', 'HomeController@update')->name("update");


//STRUCTURE
Route::get('/admin/structure/ajouterstructure','StructureController@ajouterstructure')->name('ajouterstructure');
Route::post('/admin/structure/ajouterstructure','StructureController@ajouterUneStructure')->name('ajouterUneStructure');
Route::post('/admin/structure/ajouterstructureViaTabAdmin','StructureController@ajouterUneStructureViaTabAdmin')->name('ajouterUneStructureViaTabAdmin');



Route::get('/admin/structure/supprimermodifierstructure','StructureController@supprimermodifierstructure')->name('supprimermodifierstructure');
Route::get('/admin/structure/deletestructure/{id}', 'StructureController@deletestructure');

Route::get('/admin/structure/editstructure', 'StructureController@editstructure')->name("editstructure");
Route::post('/admin/structure/updatestructure/{id}', 'StructureController@updatestructure')->name("updatestructure");


//TYPE DE GLACE
Route::get('/admin/type_glace/ajoutertype_glace','Type_glaceController@ajoutertype_glace')->name('ajoutertype_glace');
Route::post('/admin/type_glace/ajoutertype_glace','Type_glaceController@ajouterUnType_glace')->name('ajouterUnType_glace');
Route::post('/admin/type_glace/ajoutertype_glaceViaTabAdmin','Type_glaceController@ajouterUnType_glaceViaTabAdmin')->name('ajouterUnType_glaceViaTabAdmin');


Route::get('/admin/type_glace/supprimermodifiertype_glace','Type_glaceController@supprimermodifiertype_glace')->name('supprimermodifiertype_glace');
Route::get('/admin/type_glace/deletetype_glace/{id}', 'Type_glaceController@deletetype_glace');

Route::get('/admin/type_glace/edittype_glace/{id}', 'Type_glaceController@edittype_glace')->name("edittype_glace");
Route::post('/admin/type_glace/updatetype_glace/{id}', 'Type_glaceController@updatetype_glace')->name("updatetype_glace");


//TYPE DE FIN DE VIE
Route::get('/admin/type_fin_vie/ajoutertype_fin_vie','Type_fin_vieController@ajoutertype_fin_vie')->name('ajoutertype_fin_vie');
Route::post('/admin/type_fin_vie/ajoutertype_fin_vie','Type_fin_vieController@ajouterUnType_fin_vie')->name('ajouterUnType_fin_vie');
Route::post('/admin/type_fin_vie/ajoutertype_fin_vieViaTabAdmin','Type_fin_vieController@ajouterUnType_fin_vieViaTabAdmin')->name('ajouterUnType_fin_vieViaTabAdmin');

Route::get('/admin/type_fin_vie/supprimermodifiertype_fin_vie','Type_fin_vieController@supprimermodifiertype_fin_vie')->name('supprimermodifiertype_fin_vie');
Route::get('/admin/type_fin_vie/deletetype_fin_vie/{id}', 'Type_fin_vieController@deletetype_fin_vie');

Route::get('/admin/type_fin_vie/edittype_fin_vie/{id}', 'Type_fin_vieController@edittype_fin_vie')->name("edittype_fin_vie");
Route::post('/admin/type_fin_vie/updatetype_fin_vie/{id}', 'Type_fin_vieController@updatetype_fin_vie')->name("updatetype_fin_vie");


//GESTION DES CONSTITUANTS
Route::get('/admin/constituant/ajouterconstituant','ConstituantController@ajouterconstituant')->name('ajouterconstituant');
Route::post('/admin/constituant/ajouterconstituant','ConstituantController@ajouterUnConstituant')->name('ajouterUnConstituant');
Route::post('/admin/constituant/ajouterUnConstituantViaTabAdmin','ConstituantController@ajouterUnConstituantViaTabAdmin')->name('ajouterUnConstituantViaTabAdmin');

Route::get('/admin/constituant/supprimermodifierconstituant','ConstituantController@supprimermodifierconstituant')->name('supprimermodifierconstituant');
Route::get('/admin/constituant/deleteconstituant/{id}', 'ConstituantController@deleteconstituant');

Route::get('/admin/constituant/editconstituant/{id}', 'ConstituantController@editconstituant')->name("editconstituant");
Route::post('/admin/constituant/updateconstituant/{id}', 'ConstituantController@updateconstituant')->name("updateconstituant");

//GESTION DES SUPPORTS
Route::get('/admin/support/ajoutersupport','SupportController@ajoutersupport')->name('ajoutersupport');
Route::post('/admin/support/ajoutersupport','SupportController@ajouterUnSupport')->name('ajouterUnSupport');
Route::post('/admin/support/ajouterUnSupportViaTabAdmin','SupportController@ajouterUnSupportViaTabAdmin')->name('ajouterUnSupportViaTabAdmin');


Route::get('/admin/support/supprimermodifiersupport','SupportController@supprimermodifiersupport')->name('supprimermodifiersupport');
Route::get('/admin/support/deletesupport/{id}', 'SupportController@deletesupport');

Route::get('/admin/support/editsupport/{id}', 'SupportController@editsupport')->name("editsupport");
Route::post('/admin/support/updatesupport/{id}', 'SupportController@updatesupport')->name("updatesupport");



//GESTION USERS PAR L'ADMIN
Route::get('/admin/user/supprimeruser','HomeController@supprimeruser')->name('supprimeruser');
Route::get('/admin/user/deleteuser/{id}', 'HomeController@deleteuser');


//GESTION DES PARTENAIRES
Route::post('/admin/partenaire/ajouterpartenaireViaTabAdmin','PartenaireController@ajouterUnPartenaireViaTabAdmin')->name('ajouterUnPartenaireViaTabAdmin');

Route::get('/admin/partenaire/supprimermodifierpartenaire','PartenaireController@supprimermodifierpartenaire')->name('supprimermodifierpartenaire');
Route::get('/admin/partenaire/deletepartenaire/{id}', 'PartenaireController@deletepartenaire');

Route::get('/admin/partenaire/editpartenaire', 'PartenaireController@editpartenaire')->name("editpartenaire");
Route::post('/admin/partenaire/updatepartenaire/{id}', 'PartenaireController@updatepartenaire')->name("updatepartenaire");


//EDITER LE PROFIL
Route::get ('/auth/getEdit/{id}', 'HomeController@getEdit')->name('getEdit');
Route::post('/auth/updateprofil/{id}', 'HomeController@updateprofil')->name("updateprofil");
Route::get('/auth/getEdit/deleteAccount/{id}', 'HomeController@deleteAccount');

//GESTION DES ZONES
Route::get('/admin/zone/supprimermodifierzone','ZoneController@supprimermodifierzone')->name('supprimermodifierzone');


//FOOTER
Route::get ('/mentions_legales' ,'FooterController@mentions_legales')->name('mentions_legales');
Route::get ('/conditions_generales' ,'FooterController@conditions_generales')->name('conditions_generales');

//MENU
Route::get ('/a_propos' ,'MenuController@a_propos')->name('a_propos');
Route::get ('/contact' ,'MenuController@contact')->name('contact');
Route::get ('/accueil_visiteur' ,'MenuController@accueil_visiteur')->name('accueil_visiteur');


//CONNEXION FACEBOOK GOOGLE
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('google');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFacebook')->name('facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackFacebook');

//MAP
Route::get('/map', 'MapController@index')->name('map');
Route::get('/mapUser', 'MapUserController@index')->name('mapUser');
Route::get('/mapVisitor', 'MapUserController@indexVisitor')->name('mapVisitor');

Route::post('/map/zones', 'MapController@enregistrerZone')->name('enregistrerZone');
Route::post('/map/zones/edit', 'MapController@editZone')->name('editZone');
Route::post('/map/zones/delete', 'MapController@deleteZone')->name('deleteZone');
Route::post('/mapUser/derniereTemperature', 'MapUserController@recupDerniereTemperature')->name('derniereTemperature');

Route::post('/mapUser/addZoneFavoris', 'MapUserController@addZoneFavoris')->name('addZoneFavoris');
Route::post('/mapUser/deleteZoneFavoris', 'MapUserController@deleteZoneFavoris')->name('deleteZoneFavoris');
Route::post('/mapUser/addZoomFavoris', 'MapUserController@addZoomFavoris')->name('addZoomFavoris');
Route::post('/mapUser/deleteZoomFavoris', 'MapUserController@deleteZoomFavoris')->name('deleteZoomFavoris');

Route::post('/mapUser/historiqueComplet', 'MapUserController@historiqueComplet')->name('historiqueComplet');
Route::post('/mapUser/afficherCommentaires', 'MapUserController@afficherCommentaires')->name('afficherCommentaires');
Route::post('/mapUser/infoCascade', 'MapUserController@infoCascade')->name('infoCascade');
Route::post('/mapUser', 'MapUserController@ajoutCommentaire')->name('ajoutCommentaire');
Route::post('/mapUser/deleteCommentaireUser', 'MapUserController@deleteCommentaireUser')->name('deleteCommentaireUser');
Route::post('/map/deleteCommentaireAdmin', 'MapController@deleteCommentaireAdmin')->name('deleteCommentaireAdmin');
Route::post('/mapUser/rechercheCascade', 'MapUserController@rechercheCascade')->name('rechercheCascade');
Route::post('/mapUser/rechercheCascadeBis', 'MapUserController@rechercheCascadeBis')->name('rechercheCascadeBis');