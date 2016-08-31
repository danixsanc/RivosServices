˝<?php
if (!defined('SPECIALCONSTANT')) die("Acceso Denegado");


//log in and log out
$app->post("/loginAdssmin/", function() use($app){

	$json = $app->request->getBody();
    $data = json_decode($json, true);

    $dataf = $data['data'];
	$email = $dataf['Email'];
	$password = $dataf['Password'];
	$response = array();

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT idAdmin, Name, Email, Password, Salt FROM admin WHERE Email = ?");
		$dbh->bindParam(1, $email);
		$dbh->execute();

		$admin_user = $dbh->fetchObject();
		
		if ($admin_user != false) {
			
			$salt = $admin_user->Salt;
	        $encrypted_password = $admin_user->Password;

	        $hash = base64_encode(sha1($password . $salt, true) . $salt);

	        if ($encrypted_password == $hash) {
		        if (!isset($_SESSION)) {
		            session_start();
		        }
		        $_SESSION['uid'] = $admin_user->idAdmin;
		        $_SESSION['email'] = $email;
		        $_SESSION['name'] =  $admin_user->Name;
				$connection = null;

				$response['message'] = "OK";
				$response['IsError'] = false;
				$response['data'] = $admin_user;


				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(200);
				$app->response->body(json_encode($response));

	     	} else {
	            $connection = null;
				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(400);
				$app->response->body(json_encode("Contraseña Incorrecta"));
	    	}
		}

		else {
            $connection = null;
			$app->response->headers->set("Content-type", "application/json");
			$app->response->status(400);
			$app->response->body(json_encode("Correo no existe"));
        }

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});

$app->get("/sessssion/", function() use($app){

	if (!isset($_SESSION)) {
            session_start();
        }
        $sess = array();
        if(isset($_SESSION['uid']))
        {
            $sess["uid"] = $_SESSION['uid'];
            $sess["name"] = $_SESSION['name'];
            $sess["email"] = $_SESSION['email'];
        }
        else
        {
            $sess["uid"] = '';
            $sess["name"] = 'Guest';
            $sess["email"] = '';
        }
        $app->response->body(json_encode($sess));
});

$app->get("/logssout/", function() use($app){
	if (!isset($_SESSION)) {
	    session_start();
	    }
	    if(isSet($_SESSION['uid']))
	    {
	        unset($_SESSION['uid']);
	        unset($_SESSION['name']);
	        unset($_SESSION['email']);
	        $info='info';
	        if(isSet($_COOKIE[$info]))
	        {
	            setcookie ($info, '', time() - $cookie_time);
	        }
	        $msg="Logged Out Successfully...";
	    }
	    else
	    {
	        $msg = "Not logged in...";
	    }
	    $app->response->body(json_encode($msg));
});


//Clientes
$app->get("/get_clientes/", function() use($app){

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT idCliente, Name, Phone, Email FROM clientes WHERE Status = '0'");
		$dbh->execute();
		$admins = $dbh->fetchAll(PDO::FETCH_OBJ);
		$connection = null;

		$response = array();
		$response['Message'] = "OK";
		$response['IsError'] = false;
		$response['Data'] = $admins;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($response));

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});

$app->get("/get_cliente_by_id/:id", function($id) use($app){


	//$json = $app->request->getBody();
    //$data = json_decode($json, true);
	$response = array();

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT idCliente, Name, Phone, Email FROM clientes WHERE idCliente = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$admins = $dbh->fetchAll(PDO::FETCH_OBJ);
		$connection = null;

		$response = array();
		$response['Message'] = "OK";
		$response['IsError'] = false;
		$response['Data'] = $admins;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($response));

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});

$app->post("/save_cliente/", function() use($app){

	$json = $app->request->getBody();
    $data = json_decode($json, true);

    $dataf = $data['data'];
    $Name = $dataf['Name'];
    $Phone = $dataf['Phone'];
	$Email = $dataf['Email'];
	$response = array();

	try{

		$connection = getConnection();
		//$sql = "SELECT Email FROM Client WHERE Email = '$Email'";
		$dbh = $connection->prepare("SELECT Email FROM clientes WHERE Email = ?");
		$dbh->bindParam(1, $Email);
		$dbh->execute();
		$resp = $dbh->fetchObject();

		if ($resp != false) {
			$connection = null;
			$app->response->headers->set("Content-type", "application/json");
			$app->response->status(400);
			$app->response->body(json_encode("Correo Ya Existe"));
		}
		else{

            $dbh = $connection->prepare("INSERT INTO clientes (Name, Phone, Email) VALUES (:N,:P,:E)");
			$dbh->bindParam(':N', $Name);
			$dbh->bindParam(':P', $Phone);
			$dbh->bindParam(':E', $Email);
			$dbh->execute();

			if ($dbh) {
				$connection = null;

				$response['message'] = "OK";
				$response['IsError'] = false;
				$response['data'] = null;


				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(200);
				$app->response->body(json_encode($response));


			}
			else {
	            $connection = null;
				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(400);
				$app->response->body(json_encode("Contraseña Incorrecta"));
	    	}
			


		}
		

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});

$app->post("/update_cliente/:id", function($id) use($app){

	$json = $app->request->getBody();
    $data = json_decode($json, true);

    $dataf = $data['data'];
    $Name = $dataf['Name'];
    $Phone = $dataf['Phone'];
	$Email = $dataf['Email'];
	$response = array();

	try{
			$connection = getConnection();
            $dbh = $connection->prepare("UPDATE clientes SET Name = :N, Phone = :P, Email = :E WHERE idCliente = :I");
			$dbh->bindParam(':I', $id);
			$dbh->bindParam(':N', $Name);
			$dbh->bindParam(':P', $Phone);
			$dbh->bindParam(':E', $Email);
			$dbh->execute();

			if ($dbh) {
				$connection = null;

				$response['message'] = "OK";
				$response['IsError'] = false;
				$response['data'] = null;


				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(200);
				$app->response->body(json_encode($response));


			}
			else {
	            $connection = null;
				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(400);
				$app->response->body(json_encode("Contraseña Incorrecta"));
	    	}
			


		
		

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});

$app->get("/delete_cliente/:id", function($id) use($app){

	$response = array();
	$Status = '500';

	try{
			$connection = getConnection();
            $dbh = $connection->prepare("UPDATE clientes SET Status = :S WHERE idCliente = :I");
			$dbh->bindParam(':I', $id);
			$dbh->bindParam(':S', $Status);
			$dbh->execute();

			if ($dbh) {
				$connection = null;

				$response['Message'] = "OK";
				$response['IsError'] = false;
				$response['data'] = null;


				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(200);
				$app->response->body(json_encode($response));


			}
			else {
	            $connection = null;
				$app->response->headers->set("Content-type", "application/json");
				$app->response->status(400);
				$app->response->body(json_encode("Contraseña Incorrecta"));
	    	}
			


		
		

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});

















//Clientes
$app->get("/clientes/", function() use($app){

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM clientes");
		$dbh->execute();
		$propiedades = $dbh->fetchAll(PDO::FETCH_OBJ);
		$connection = null;

		$response = array();
		$response['Message'] = "OK";
		$response['IsError'] = false;
		$response['Data'] = $propiedades;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($response));

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});















//depts
$app->get("/books/", function() use($app){

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM admin");
		$dbh->execute();
		$books = $dbh->fetchObject();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($books));

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});

$app->get("/books/:id", function($id) use($app){

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM admin WHERE admin_id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$book = $dbh->fetchObject();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($book));

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});




/*
$salt = sha1(rand());
            $salt = substr($salt, 0, 10);
            $encrypted = base64_encode(sha1($Password . $salt, true) . $salt);
            $hash = array("salt" => $salt, "encrypted" => $encrypted);

            $Encrypted_Password = $hash["encrypted"];
            $Salt = $hash["salt"];
            $var = 1;
*/

