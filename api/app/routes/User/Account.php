<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");

$app->post("/userLogin/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);
 
    $email = $data['Email'];
    $password = $data['Password'];
    $gcm_id = $data['Gcm_Id'];
    $user_type = $data['User_Type'];
    $login_fb = $data['Login_Fb'];

    try{

        $connection = getConnection();
        $dbh = $connection->prepare("SELECT Cl.Client_Id, Cl.Conekta_Id, Cl.FirstName, Cl.FLastName, Cl.SLastName, Cl.Email, Cl.Phone, Cl.Password, Cl.Salt, Ca.Conekta_Card
            FROM Client Cl
            LEFT JOIN Card Ca ON Cl.Client_Id = Ca.Client_Id WHERE Email = :E");
        $dbh->bindParam(':E', $email);
        $dbh->execute();
        $user = $dbh->fetchObject();
        
        if ($user != false) {

            if ($login_fb) {
                $connection = null;

                $response['Message'] = "OK";
                $response['IsError'] = false;
                $response['Data'] = $user;

                $app->response->headers->set("Content-type", "application/json");
                $app->response->status(200);
                $app->response->body(json_encode($response));
            }
            else{
                $chk = verify_encrypt_Password($password, $user->Password, $user->Salt);
                if ($chk) {

                    $connection = null;

                    $userData = get_user_data($user);

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
                    $app->response->status(400);
                    $app->response->body(json_encode($response));
                }
            }
            
        }

        else {
            $connection = null;

            $response['Message'] = "El correo no existe";
            $response['IsError'] = false;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(400);
            $app->response->body(json_encode($response));
        }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
});

$app->post("/userRegister/", function() use($app){

    $json = $app->request->getBody();
    $data = json_decode($json, true);

    $firstname = $data['FirstName'];
    $flastname = $data['FLastName'];
    $slastname = $data['SLastName'];
    $phone = $data['Phone'];
    $email = $data['Email'];
    $password = $data['Password'];
    $gcm_id = $data['Gcm_Id'];
    $user_type = $data['User_Type'];
    $register_fb = $data['Register_Fb'];
    $client_actv = '1';

    $response = array();

    try{

        $connection = getConnection();
        
        $dbh = $connection->prepare("SELECT Email, Phone FROM Client WHERE Email = :E OR Phone = :P");
        $dbh->bindParam(':E', $email);
        $dbh->bindParam(':P', $phone);
        $dbh->execute();
        $user = $dbh->fetchObject();

        if ($user) {
            if ($user->Email == $email) {

            $connection = null;
            $response['Message'] = "El correo ya se encuentra registrado";
            $response['IsError'] = true;
            $response['Data'] = null;

            $app->response->headers->set("Content-type", "application/json");
            $app->response->status(400);
            $app->response->body(json_encode($response));
            }
            else if ($user->Phone == $phone) {

                $connection = null;
                $response['Message'] = "El telefono ya se encuentra registrado";
                $response['IsError'] = true;
                $response['Data'] = null;

                $app->response->headers->set("Content-type", "application/json");
                $app->response->status(400);
                $app->response->body(json_encode($response));
            }
        }
        
        else{
            
            $customer = Conekta_Customer::create(
              array(
                'name'  => $firstname . ' ' . $flastname . ' ' . $slastname,
                'email' => $email,
                'phone' => $phone
              )
            );

            if ($register_fb) {
                $hash = encrypt_password(sha1(rand()));
                $Encrypted_Password = $hash["encrypted"];
                $Salt = $hash["salt"];
            }
            else{
                $hash = encrypt_password($password);
                $Encrypted_Password = $hash["encrypted"];
                $Salt = $hash["salt"];
            }

            $dbh = $connection->prepare("INSERT INTO Client (Conekta_Id, FirstName, FLastName, SLastName, Phone, Email, Password, Salt, Gcm_Id, Created_At, Client_Type_Id, ClientActv_Id) 
                VALUES( :CI, :FN, :FLN, :SLN, :P, :E, :EP, :S, :GI, NOW(), :CT, :CA)");
            $dbh->bindParam(':CI', $customer->id);
            $dbh->bindParam(':FN', $firstname);
            $dbh->bindParam(':FLN', $flastname);
            $dbh->bindParam(':SLN', $slastname);
            $dbh->bindParam(':P', $phone);
            $dbh->bindParam(':E', $email);
            $dbh->bindParam(':EP', $Encrypted_Password);
            $dbh->bindParam(':S', $Salt);
            $dbh->bindParam(':GI', $gcm_id);
            $dbh->bindParam(':CT', $user_type);
            $dbh->bindParam(':CA', $client_actv);
            $dbh->execute();

            if ($dbh) {
                $connection = null;
                $response['Message'] = "Registrado Correctamente";
                $response['IsError'] = false;
                $response['Data'] = null;

                $app->response->headers->set("Content-type", "application/json");
                $app->response->status(400);
                $app->response->body(json_encode($response));
            }
        }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
});

function verify_encrypt_Password ($Password, $Encrypted_Password, $Salt){

    $hash = base64_encode(sha1($Password . $Salt, true) . $Salt);
    if ($Encrypted_Password == $hash)
        return true;
    return false;
    
};

function encrypt_password ($Password){

    $salt = sha1(rand());
    $salt = substr($salt, 0, 10);
    $encrypted = base64_encode(sha1($Password . $salt, true) . $salt);
    $hash = array("salt" => $salt, "encrypted" => $encrypted);
    return $hash;
    
};

function get_user_data($user){
    $dataResp = array();
    $dataResp['Client_Id'] = $user->Client_Id;
    $dataResp['Name'] = $user->FirstName . ' ' . $user->FLastName . ' ' . $user->SLastName;
    $dataResp['Email'] = $user->Email;
    $dataResp['Phone'] = $user->Phone;
    return $dataResp;
}
