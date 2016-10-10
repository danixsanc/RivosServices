<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");

$app->post("/sendMessage/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);
 
    $client_Id = $data['Client_Id'];
    $subject = $data['Subject'];
    $message = $data['Message'];

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("INSERT INTO Message_Client (Client_Id, Subject, Message) 
            VALUES(:CID, :S, :M)");
        $dbh->bindParam(':CID', $client_Id);
        $dbh->bindParam(':S', $subject);
        $dbh->bindParam(':M', $message);
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
        else{

            $connection = null;

            $response['Message'] = "Error al registrar mensaje";
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





$app->post("/GetPrice/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);
 
    $Latitude_In = $data['Latitude_In'];
    $Longitude_In = $data['Longitude_In'];
    $Latitude_Fn = $data['Latitude_Fn'];
    $Longitude_Fn = $data['Longitude_Fn'];
    $Distance = $data['Distance'];

    $may = null;
    $distMay = null;
    $priceF = 0;

    $resp = array();

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("SELECT LC.Latitude, LC.Longitude, C.FirstName, C.Gcm_Id,
            C.PaymentSystem_Id, C.Cabbie_Id, CONCAT(C.FirstName, ' ', C.LastName) AS Name
            FROM Location_Cabbie LC
            INNER JOIN Cabbie C ON LC.Cabbie_Id = C.Cabbie_Id 
            INNER JOIN Cabbie_Status CS ON CS.Cabbie_Status_Id = C.Cabbie_Status_Id 
            WHERE CS.Cabbie_Status_Id  = 1");
        $dbh->execute();
        $cabbie = $dbh->fetchAll(PDO::FETCH_ASSOC);

        if ($cabbie != false) {
            foreach($cabbie as $row) {
                $Lat_bd = $row['Latitude'];
                $Lon_bd = $row['Longitude'];

                $dis = distance($Latitude_In, $Longitude_In, $Lat_bd, $Lon_bd);
                if ($may == null) {
                    $may = $row;
                    $distMay = $dis;
                }
                else{
                    if ($distMay < $dis) {
                        $may = $row;
                        $distMay = $dis;
                    }
                }      
            }

            if ($may['PaymentSystem_Id'] == 1) {
                $dbh = $connection->prepare("SELECT Price, RangD
                    FROM PSystem_Range
                    WHERE Cabbie_Cabbie_Id = :CID");
                $dbh->bindParam(':CID', $may['Cabbie_Id']);
                $dbh->execute();
                $prices = $dbh->fetchAll(PDO::FETCH_ASSOC);

                foreach($prices as $row) {
                    list($rangeA, $rangeB) = explode(',', $row['RangD']);
                    if (($distMay >= $rangeA) && ($distMay < $rangeB)) {
                        $priceF = $row['Price'];
                    }
                }
            }

            $var = 3;
            $connection = getConnection();
            $dbh = $connection->prepare("UPDATE Cabbie SET Cabbie_Status_Id = :CS, Date_Selection = NOW() WHERE Cabbie_Id = :CID");
            $dbh->bindParam(':CS', $var);
            $dbh->bindParam(':CID', $may['Cabbie_Id']);
            $dbh->execute();

            if ($dbh) {
                $resp['Cabbie_Id'] = $may['Cabbie_Id'];
                $resp['Cabbie_Name'] = $may['Name'];
                $resp['LatCabbie'] = $may['Latitude'];
                $resp['LongCabbie'] = $may['Longitude'];
                $resp['GcmIdCabbie'] = $may['Gcm_Id'];
                $resp['Price'] = $priceF;

                $connection = null;

                $response['Message'] = "Ok";
                $response['IsError'] = false;
                $response['Data'] = $resp;

                $app->response->headers->set("Content-type", "application/json");
                $app->response->status(200);
                $app->response->body(json_encode($response));

            }
        }
        else{
            $response['Message'] = "No hay taxistas disponibles";
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

$app->post("/cancelCabbie/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);
 
    $cabbie_Id = $data['Cabbie_Id'];

    try{

        $var = 1;
        $connection = getConnection();
        $dbh = $connection->prepare("UPDATE Cabbie SET Cabbie_Status_Id = :CS, Date_Selection = 'NULL' WHERE Cabbie_Id = :CID");
        $dbh->bindParam(':CS', $var);
        $dbh->bindParam(':CID', $cabbie_Id);
        $dbh->execute();

        if($dbh){
            $response['Message'] = "Actualizado";
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

$app->post("/setRequest/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);
 
    $latitude_In = $data['Latitude_In'];
    $longitude_In = $data['Longitude_In'];
    $latitude_Fn = $data['Latitude_Fn'];
    $longitude_Fn = $data['Longitude_Fn'];
    $inicio = $data['Inicio'];
    $destino = $data['Destino'];
    $precio = $data['Precio'];
    $client_Id = $data['Client_Id'];
    $cabbie_Id = $data['Cabbie_Id'];
    $paymentType_Id = $data['PaymentType_Id'];
 

    $Ref = date('ymd')."$cabbie_Id".'-'."$client_Id".date('His');

    try{

        $var = 1;
        $connection = getConnection();
        $dbh = $connection->prepare("INSERT INTO Request (Date, Latitude_In, Longitude_In, Latitude_Fn, Longitude_Fn, Inicio, Destino, Ref, Price, Client_Id, Cabbie_Id, PaymentType_Id, RequestStatus_Id) 
        VALUES( NOW(), :LAI, :LOI, :LAF, :LOF, :INI, :DES, :REF, :PR, :CLID, :CID, :PT, :RSI)");
        $dbh->bindParam(':LAI', $latitude_In);
        $dbh->bindParam(':LOI', $longitude_In);
        $dbh->bindParam(':LAF', $latitude_Fn);
        $dbh->bindParam(':LOF', $longitude_Fn);
        $dbh->bindParam(':INI', $inicio);
        $dbh->bindParam(':DES', $destino);
        $dbh->bindParam(':REF', $Ref);
        $dbh->bindParam(':PR', $precio);
        $dbh->bindParam(':CLID', $client_Id);
        $dbh->bindParam(':CID', $cabbie_Id);
        $dbh->bindParam(':PT', $paymentType_Id);
        $dbh->bindParam(':RSI', $var);
        $dbh->execute();

        $lastId = $connection->lastInsertId();

        if($dbh){

            $dbh = $connection->prepare("UPDATE Cabbie SET Cabbie_Status_Id = 2 WHERE Cabbie_Id = :CID");
            $dbh->bindParam(':CID', $cabbie_Id);
            $dbh->execute();
            if ($dbh) {

                $dbh = $connection->prepare("SELECT Ref, Date FROM Request WHERE Request_Id = :RID");
                $dbh->bindParam(':RID', $lastId);
                $dbh->execute();
                $req = $dbh->fetchObject();

                $response['Message'] = "Actualizado";
                $response['IsError'] = false;
                $response['Data'] = $req;

                $app->response->headers->set("Content-type", "application/json");
                $app->response->status(200);
                $app->response->body(json_encode($response));
            }

        }
    

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
});