<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");



$app->post("/setCard/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);

    $conekta_token = $data['Conekta_Token'];
    $client_id = $data['Client_Id'];

    $response = array();

    try{

        $connection = getConnection();
        
        $dbh = $connection->prepare("INSERT INTO Card (Conekta_Card, Client_Id) VALUES(:CC, :CID)");
        $dbh->bindParam(':CC', $conekta_token);
        $dbh->bindParam(':CID', $client_id);
        $dbh->execute();
        $result = $dbh->fetchObject();

        if ($result) {

            $cardIdArray = array();
            $cardIdArray['CardId'] = $connection->lastInsertId();

            $connection = null;
            $response['Message'] = "Tarjeta registrada correctamente";
            $response['IsError'] = true;
            $response['Data'] = $cardIdArray;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }
        else{

            $connection = null;
            $response['Message'] = "No se pudo registrar la tarjeta";
            $response['IsError'] = false;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }

    }catch(PDOException $e){
        $response['Message'] = $e->getMessage();
        $response['IsError'] = false;
        $response['Data'] = null;

        $app->response->headers->set("Content-type", "application/json");
        $app->response->status(200);
        $app->response->body(json_encode($response));
    }
});




$app->get("/getCard/:id", function($id) use($app){

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("SELECT Conekta_Id FROM Client WHERE Client_Id = :CID");
        $dbh->bindParam(':CID', $id);
        $dbh->execute();
        $result = $dbh->fetchObject();
        
        if ($result != false) {

            $customer = Conekta_Customer::find($result->Conekta_Id);

            $connection = null;
            $response['Message'] = "OK";
            $response['IsError'] = false;
            $response['Data'] = $customer->cards;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }
        else {
            $connection = null;

            $response['Message'] = "El usuario no existe";
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


$app->delete("/deleteCard/:id", function($id) use($app){


    $json = $app->request->getBody();
    $data = json_decode($json, true);

    $tokenCard = $data['TokenCard'];
    $position = $data['CardPosition'];
    $response = array();

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("DELETE FROM Card WHERE (Client_Id = :CID) AND (Conekta_Card = :CC)");
        $dbh->bindParam(':CID', $id);
        $dbh->bindParam(':CC', $tokenCard);
        $dbh->execute();

        $customer = Conekta_Customer::find("cus_k2D9DxlqdVTagmEd400001");
        $card = $customer->cards[$position]->delete();

        if ($dbh == true) {
            $connection = null;
            $response['message'] = "OK";
            $response['IsError'] = false;
            $response['data'] = "Lugar eliminado correctamente";

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }
        else {
            $connection = null;
            $response['message'] = "OK";
            $response['IsError'] = false;
            $response['data'] = "No se pudo eliminar el lugar";

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(400);
            $app->response->body(json_encode($response));
        }

    }catch(PDOException $e){
        $connection = null;
        $response['message'] = "OK";
        $response['IsError'] = false;
        $response['data'] = "Error: " . $e->getMessage();

        $app->response->headers->set("Content-type", "application/json");
        $app->response->status(400);
        $app->response->body(json_encode($response));
    }
});

