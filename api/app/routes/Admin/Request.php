<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");

$app->get("/get_Requests/", function() use($app){

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("SELECT RQ.Request_Id,RQ.Inicio,RQ.Destino,RQ.Date,RQ.Price,
            RQ.PaymentType_Id,PT.Description,CONCAT(CB.FirstName, ' ', CB.LastName) AS cabbie_name FROM request RQ
            INNER JOIN paymenttype PT ON RQ.PaymentType_Id = PT.PaymentType_Id
            INNER JOIN cabbie CB ON RQ.Cabbie_Id = CB.Cabbie_Id");
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



$app->post("/save_cabbie/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);
 
    $dataf = $data['data'];
    $FirstName = $dataf['FirstName'];
    $LastName = $dataf['LastName'];
    $Phone = $dataf['Phone'];
    $Email = $dataf['Email'];
    $Born = $dataf['Born'];
    $Password = $dataf['Password'];


    try{

        $connection = getConnection();
        $dbh = $connection->prepare("INSERT INTO cabbie (FirstName, LastName,Phone,Email,Born,Password) VALUES(:FN, :LN  , :PH, :EM, :BR, :PW)");
        $dbh->bindParam(':FN', $FirstName);
        $dbh->bindParam(':LN', $LastName);
        $dbh->bindParam(':PH', $Phone);
        $dbh->bindParam(':EM', $Email);
        $dbh->bindParam(':BR', $Born);
        $dbh->bindParam(':PW', $Password);
        $dbh->execute();

        if ($dbh) {

            $connection = null;


            $response['Message'] = "OK";
            $response['IsError'] = false;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));
        }
        else {
            $connection = null;

            $response['Message'] = "Error al enviar mensaje";
            $response['IsError'] = true;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(200);
            $app->response->body(json_encode($response));  
        }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
});