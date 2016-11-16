<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");



$app->post("/getClosesCabbies/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);

    $longitude = $data['Longitude'];
    $Latitude = $data['Latitude'];

    $response = array();


    try{


        $sf = 3.14159 / 180; // scaling factor
        $er = 6350; // earth radius in miles, approximate
        $mr = 100; // max radius


        $connection = getConnection();
        $dbh = $connection->prepare("SELECT Latitude, Longitude, Cabbie_Id 
            FROM Location_Cabbie ORDER BY (POW((Longitude-:LON),2) + POW((Latitude-:LAT),2)) LIMIT 5");
        $dbh->bindParam(':LON', $longitude);
        $dbh->bindParam(':LAT', $Latitude);
        $dbh->execute();
        $cc = $dbh->fetchAll(PDO::FETCH_ASSOC);

        if ($cc != false) {

            $connection = null;

            $response['Message'] = "OK";
            $response['IsError'] = false;
            $response['Data'] = $cc;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }
        else {
            $connection = null;

            $response['Message'] = "Error al actualizar";
            $response['IsError'] = false;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));  
        }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
});