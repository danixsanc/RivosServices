<?php
if (!defined('SPECIALCONSTANT')) die("Acceso Denegado");

$app->get("/get_cabbies/", function() use($app){

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT Cabbie_Id, Name, Phone, Email, Contract, actv FROM Cabbie");
		$dbh->execute();
		$cabbies = $dbh->fetchAll(PDO::FETCH_OBJ);
		$connection = null;

		$response = array();
		$response['Message'] = "OK";
		$response['IsError'] = false;
		$response['Data'] = $cabbies;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($response));

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});


$app->get("/get_cabbies_coordinates/", function() use($app){

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("SELECT C.Cabbie_Id, C.Name, LC.Longitude, LC.Latitude FROM Cabbie C
			INNER JOIN Location_Cabbie LC ON C.Cabbie_Id = LC.Cabbie_Id");
		$dbh->execute();
		$cabbies = $dbh->fetchAll(PDO::FETCH_OBJ);
		$connection = null;

		$response = array();
		$response['Message'] = "OK";
		$response['IsError'] = false;
		$response['Data'] = $cabbies;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($response));

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
});