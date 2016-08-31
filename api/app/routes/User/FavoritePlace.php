<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");

$app->get("/getFavoritePlace/:id", function($id) use($app){

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("SELECT Name, Description, Latitude, Longitude FROM Place_Favorite WHERE Client_Id = :CID");
        $dbh->bindParam(':CID', $id);
        $dbh->execute();

        $favoriteplace = $dbh->fetchObject();
        
        if ($favoriteplace != false) {

            $connection = null;
            $response['Message'] = "OK";
            $response['IsError'] = false;
            $response['Data'] = $favoriteplace;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }
        else {
            $connection = null;

            $response['Message'] = "No hay favoritos..";
            $response['IsError'] = false;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }

    }catch(PDOException $e){
        //echo "Error: " . $e->getMessage();

            $response['Message'] = $e->getMessage();
            $response['IsError'] = false;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(400);
            $app->response->body(json_encode($response));

    }
});
