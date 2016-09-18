<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");

$app->post("/cabbieLogin/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);
 
    $email = $data['Email'];
    $password = $data['Password'];
    $gcm_id = $data['Gcm_Id'];
    $user_type = $data['User_Type'];

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("SELECT Cabbie_Id, FirstName, LastName, Email, Phone, Password, Salt FROM Cabbie WHERE Email = :E");
        $dbh->bindParam(':E', $email);
        $dbh->execute();
        $user = $dbh->fetchObject();
        
        if ($user != false) {

            $chk = verify_encrypt_Password($password, $user->Password, $user->Salt);
            if ($chk) {

                $connection = null;

                $userData = get_cabbie_data($user);

                $response['Message'] = "OK";
                $response['IsError'] = false;
                $response['UserData'] = $userData;

                $app->response->headers->set("Content-type", "application/json");
                $app->response->status(200);
                $app->response->body(json_encode($response));

            } else {
                $connection = null;

                $response['Message'] = "Contraseña Incorrecta";
                $response['IsError'] = false;
                $response['Data'] = null;

                $app->response->headers->set("Content-type", "application/json");
                $app->response->status(200);
                $app->response->body(json_encode($response));
            }
        }
        else {
            $connection = null;

            $response['Message'] = "El correo no existe";
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


