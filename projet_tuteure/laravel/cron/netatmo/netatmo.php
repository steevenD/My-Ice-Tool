<?php
require_once("src/Netatmo/autoload.php");
require_once("co.php");
require_once("algo.php");
use Netatmo\Clients\NAWSApiClient;
use Netatmo\Exceptions\NAClientException;

$result=[];
$style = "";
$temp_moy = "";
$alt_moy = "";
$config = array();
$config['client_id'] = '5a8fd3c93164803d7f8b468f';
$config['client_secret'] = 'fG3pj03tXOvOpef8n5myyCAlaWMnCT';
//application will have access to station and theromstat
$config['scope'] = 'read_station';
$client = new NAWSApiClient($config);
$username = 'dieufaucheur13@gmail.com';
$pwd = 'QZPDs]c(Yq4W';
$client->setVariable('username', $username);
$client->setVariable('password', $pwd);
try
{
    $tokens = $client->getAccessToken();
    $refresh_token = $tokens['refresh_token'];
    $access_token = $tokens['access_token'];
}
catch(Netatmo\Exceptions\NAClientException $ex)
{
    echo "An error occcured while trying to retrive your tokens \n";
}
$sql_del= 'delete from stations';
$query_del = mysqli_query($connect, $sql_del) or die (mysqli_error($connect));
$alt= "";
$temp_moy="";
$req = "select * from zones";
$sql = mysqli_query($connect, $req) or die(mysqli_error($connect).' erreur sql');
while($result = mysqli_fetch_assoc($sql)) {
        $details_url = "https://api.netatmo.com/api/getpublicdata?access_token=" . $access_token . "&lat_ne=" . $result['latNEzone'] . "&lon_ne=" . $result['longNEzone'] . "&lat_sw=" . $result['latSWzone'] . "&lon_sw=" . $result['longSWzone'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);
        //echo "<pre>";
        //var_dump($response);
        $i = 0;
        $somme=0;
        //var_dump($response);
        foreach ($response['body'] as $station) {
            $i++;
            $tab1 = reset($station['measures']);
            $tab2 = reset($tab1);
            $tab3 = reset($tab2);
            $somme += $tab3[0];
            $lat = $station['place']['location'][1];
            $long = $station['place']['location'][0];
            $sql_station = 'insert into stations (latStation, longStation) VALUES ("'.$lat.'","'.$long.'")';
            $query_station = mysqli_query($connect,$sql_station) or die(mysqli_error($connect).' erreur requête');
        }
        $temp_moy = $somme / $i;
        //var_dump($temp_moy);
        $lvl = algo($result['id'],$connect);
        $sql_insert = 'insert into releves (dateReleve,heureReleve,temperatureMoyReleve,niveauDangerReleve,zone_id) 
                      VALUES (now(),now(),"'.$temp_moy.'","'.$lvl.'","'.$result["id"].'")';
        $query= mysqli_query($connect,$sql_insert) or die(mysqli_error($connect).'erreur dans la requête1');
        $sql_update = 'update zones set niveauDangerZone ="'.$lvl.'" where id = "'.$result["id"].'"';
        $query = mysqli_query($connect,$sql_update) or die(mysqli_error($connect).'erreur dans la requête2');
}
?>