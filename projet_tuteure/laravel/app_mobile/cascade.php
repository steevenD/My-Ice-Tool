<?php
    require_once('co.php');
    $i =0;
    $tabCascade= [];
    $search = $_POST['search'];
    if($search == "") {
        $sql = 'select * from cascades';
        $query = mysqli_query($connect,$sql);
        while ($result = mysqli_fetch_assoc($query)) {
            $tabCascade[$i]['id'] = $result['id'];
            $tabCascade[$i]['nomcascade'] = $result['nomCascade'];
            $tabCascade[$i]['nbVoiesCascade'] = $result['nbVoiesCascades'];
            $tabCascade[$i]['altiMiniCascade'] = $result['altiMiniCascade'];
            $tabCascade[$i]['hauteurCascade'] = $result['hauteurCascade'];
            $tabCascade[$i]['niveauDifCascade'] = $result['niveauDifCascade'];
            $tabCascade[$i]['orientCascade'] = $result['orientCascade'];
            $tabCascade[$i]['longCascade'] = $result['longCascade'];
            $tabCascade[$i]['latCascade'] = $result['latCascade'];
            $i++;
        }
    }else{
        $sql = 'select * from cascades where nomCascade like "%'.mysqli_real_escape_string($connect,$search).'%"';
        $query_search = mysqli_query($connect,$sql);
        while ($result = mysqli_fetch_assoc($query_search)) {
            $tabCascade[$i]['id'] = $result['id'];
            $tabCascade[$i]['nomcascade'] = $result['nomCascade'];
            $tabCascade[$i]['nbVoiesCascade'] = $result['nbVoiesCascades'];
            $tabCascade[$i]['altiMiniCascade'] = $result['altiMiniCascade'];
            $tabCascade[$i]['hauteurCascade'] = $result['hauteurCascade'];
            $tabCascade[$i]['niveauDifCascade'] = $result['niveauDifCascade'];
            $tabCascade[$i]['orientCascade'] = $result['orientCascade'];
            $tabCascade[$i]['longCascade'] = $result['longCascade'];
            $tabCascade[$i]['latCascade'] = $result['latCascade'];
            $i++;
        }
    }
    $json = json_encode($tabCascade);
    echo $json;