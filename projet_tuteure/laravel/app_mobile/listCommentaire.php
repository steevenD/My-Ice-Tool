<?php
    require_once('co.php');
    $i=0;
    $tabCommentaire = [];
    if(isset($_POST['id'])){
        $sql = 'select * from commentaires where cascade_id = "'.mysqli_real_escape_string($connect,$_POST['id']).'" order by id DESC';
        $query = mysqli_query($connect,$sql);
        while($result = mysqli_fetch_assoc($query)){
            $sql = 'select * from photos where commentaire_id = "'.$result['id'].'"';
            $query_photo = mysqli_query($connect,$sql);
            $j=0;
            $tabCommentaire[$i]['id'] = $result['id'];
            //photos
            while($result_photo = mysqli_fetch_assoc($query_photo)){
                $tabCommentaire[$i]['photo'][$j]['id'] = $result_photo['id'];
                $tabCommentaire[$i]['photo'][$j]['url'] = $result_photo['urlPhoto'];
                $j++;
            }
            $tabCommentaire[$i]['libComm'] = $result['libComm'];
            //utilisateur
            $sql = 'select * from users where id ='.$result['user_id'];
            $query_user = mysqli_query($connect,$sql);
            $result_user = mysqli_fetch_assoc($query_user);
            $tabCommentaire[$i]['user_id'] = $result_user['name'];
            $tabCommentaire[$i]['created_at'] = $result['created_at'];
            $i++;
        }
    }
    $json = json_encode($tabCommentaire);
    echo $json;