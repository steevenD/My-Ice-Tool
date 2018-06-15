<?php
require_once("co.php");

function algo($id, $connect)
{
    $tab_temp=[];
    $sql = 'select * from releves where zone_id = '.$id.' order by ID DESC limit 0,72';
    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $i=0;
    while($result = mysqli_fetch_assoc($query)){
        $tab_temp[$i] = $result['temperatureMoyReleve'];
        $i++;
    }
    if(sizeof($tab_temp)< 72){
        return 0;
    }
    $i = 0;
    $tab_temp_24h = [];
    while($i <  24){
        $tab_temp_24h[$i] = $tab_temp[$i];
        $i++;
    }
    $i=0;
    $tab_temp_48h= [];
    while($i<48){
        $tab_temp_48h[$i] = $tab_temp[$i];
        $i++;
    }
    $i=0;
    $tab_temp_14h = [];
    while($i<14){
        $tab_temp_14h[$i] = $tab_temp[$i];
        $i++;
    }

    $min = min($tab_temp_48h);
    if($min > 0) {
        return 3;
    }

    //***********************************************   24H  ***********************************************
    //baisse de 12 degrès en 24h!
    $min = min($tab_temp_24h);
    $max = max($tab_temp_24h);
    $diff = $max - $min;
    if($diff >11){
        return 3;
    }//baisse de 8° mais inférieur a 12°
    elseif ($diff>7){
        return 2;
    }
    //différence de 7° mais température negative
    if($max < 0){
        if($diff > 6){
            return 2;
        }
    }
    //***********************************************   14H  ***********************************************
    $min = min($tab_temp_14h);
    $max = max($tab_temp_14h);
    $diff = $max - $min;
    if($diff > 7){
        return 2;
    }
    //***********************************************   48H  ***********************************************
    //max a > 5° et min a < -5°
    $min = min($tab_temp_48h);
    $max = max($tab_temp_48h);
    if($min < -5 && $max > 5){
        return 3;
    }
    //température positive pendant 48h !

    if($max <0){
        return 1;
    }
    //***********************************************   72H  ***********************************************
    $min = min($tab_temp);
    $max = max($tab_temp);
    $diff = $max - $min;
    if($max < 0){
        if($diff < 5){
            return 1;
        }
    }
}