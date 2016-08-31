<?php
if (!defined('SPECIALCONSTANT')) die("Acceso Denegado");



$app->delete("/delete_card/:id", function($id) use($app){


	$json = $app->request->getBody();
    $data = json_decode($json, true);

    $dataf = $data['data'];
    $Client_Id = $dataf['Client_Id'];
	$response = array();

	try{

		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM Card WHERE (Client_Id = :CID) AND (Card_Id = :CCID)");
		$dbh->bindParam(':CID', $Client_Id);
		$dbh->bindParam(':CCID', $id);
		$dbh->execute();

		if ($dbh == true) {
			$connection = null;
			$response['message'] = "OK";
			$response['IsError'] = false;
			$response['data'] = "Tarjeta Eliminada Correctamente";

			$app->response->headers->set("Content-type", "application/json");
			$app->response->status(200);
			$app->response->body(json_encode($response));
		}
		else {
            $connection = null;
			$response['message'] = "OK";
			$response['IsError'] = false;
			$response['data'] = "No se pudo eliminar la tarjeta";

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