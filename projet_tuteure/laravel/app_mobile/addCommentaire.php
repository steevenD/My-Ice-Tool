<?php
require_once('co.php');
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Afficher les erreurs et les avertissements
error_reporting('e_all');
$uploads_dir = '/image';
if(isset($_POST['commentaire'])) {
    $com = mysqli_real_escape_string($connect, $_POST['commentaire']);
    $user = mysqli_real_escape_string($connect, $_POST['user_id']);
    $cascade = mysqli_real_escape_string($connect, $_POST['cascade_id']);
    $sql_comment = "insert into commentaires (libComm, user_id, cascade_id, created_at) VALUES ('".$com."','".$user."','".$cascade."',now())";
    if(mysqli_query($connect,$sql_comment) or die(mysqli_error($connect))) {
        $id_com = mysqli_insert_id($connect);
        for ($j = 0; $j < count($_FILES["photo"]['name']); $j++) {
            $tmp_name = $_FILES["photo"]["tmp_name"][$j];
            $extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'][$j], '.'),1));
            $name = md5($_FILES["photo"]["name"][$j]).'.'.$extension_upload;
            if (!move_uploaded_file($tmp_name, "../public/img-comments/" . $name))
                mail('tristan.spinnewyn@gmail.com', 'on est bien aller sur le fichier', $_FILES["photo"]["tmp_name"][$j]);
            else{
                $sql_photos = "insert into photos (urlPhoto, commentaire_id) VALUES ('".$name."','".$id_com."')";
                mysqli_query($connect,$sql_photos);
            }

        }
    }else{
        echo mysqli_error($connect);
    }
}else{
    echo 'héhé tu ne rentre jamais';
}
?>