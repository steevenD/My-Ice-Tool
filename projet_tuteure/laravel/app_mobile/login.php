<?php
require_once('co.php');
$tab = [];
$json= "";
    if (isset($_POST['fonction'])) {
        $fonction = $_POST['fonction'];
        //connexion basique !
        if ($fonction == 'connect') {
            $login = mysqli_real_escape_string($connect, $_POST['login']);
            $sql_login = 'select * from users where email="' . $login . '"';
            $query = mysqli_query($connect, $sql_login) or die(mysqli_error($connect) . ' erreur dans la requete ' . $sql_login);
            $result = mysqli_fetch_assoc($query);
            if ($result != "") {
                if (password_verify($_POST['mdp'], $result['password'])) {
                    $tab[0]['connect'] = 'true';
                    $tab[0]['msg'] = 'Vous êtes bien connecté !';
                    $tab[0]['id'] = $result['id'];
                } else {
                    $tab[0]['connect'] = 'false';
                    $tab[0]['msg'] = 'Erreur de mot de passe';
                }
            } else {
                $tab[0]['connect'] = 'false';
                $tab[0]['msg'] = 'Email inexistant';
            }
        }
        if ($fonction == 'facebook') {
            $login = mysqli_real_escape_string($connect, $_POST['login']);
            $sql_login = 'select * from users where email="' . $login . '"';
            $query = mysqli_query($connect, $sql_login) or die(mysqli_error($connect) . ' erreur dans la requete ' . $sql_login);
            $result = mysqli_fetch_assoc($query);
            if ($result != "") {
                $tab[0]['connect'] = 'true';
                $tab[0]['msg'] = 'Vous êtes bien connecté';
                $tab[0]['id'] = $result['id'];
            } else {
                $tab[0]['connect'] = false;
                $tab[0]['msg'] = "Vous n'êtes pas inscrit";
            }
        }
        if ($fonction == 'google') {
            $login = mysqli_real_escape_string($connect, $_POST['login']);
            $sql_login = 'select * from users where email="' . $login . '"';
            $query = mysqli_query($connect, $sql_login) or die(mysqli_error($connect) . ' erreur dans la requete ' . $sql_login);
            $result = mysqli_fetch_assoc($query);
            if ($result != "") {
                $tab[0]['connect'] = 'true';
                $tab[0]['msg'] = 'Vous êtes bien connecté';
                $tab[0]['id'] = $result['id'];
            } else {
                $tab[0]['connect'] = false;
                $tab[0]['msg'] = "Vous n'êtes pas inscrit";
            }
        }
    } else {
        $tab[0]['connect'] = 'false';
        $tab[0]['msg'] = 'Problème de connexion avec le serveur, contacté l\'administrateur !';

    }

$json = json_encode($tab,JSON_FORCE_OBJECT);
echo $json;
