<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Client_Id = $data->Client_Id;

	$array1 = array();
	    
require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {

        $sql = "SELECT * FROM Place_Favorite WHERE Client_Id = '$Client_Id'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) 
        {

            while($row = $result->fetch_assoc()) 
            {
                $rows[] = array(
                "PlaceFavoriteId" => $row['Place_Favorite_Id'],
                "Desc" => $row['Desc_Place'],
                "Latitude" => $row['Latitude'],
                "Longitude" => $row['Longitude'],
                "Name" => $row['Place_Name']);
            }
            header('Content-Type: application/json');
            $response["Data"] = $rows;
            $response["Success"] = 1;
            $response["Error"] = false;
            $response["Message"] = "Taxistas Favoritos Correcto";
            echo json_encode($response);

        }
        else 
        {
            $response["Error"] = true;
            $response["Message"] = "Error al obtener datos";
            $response["Data"] = NULL;
            $response["Success"] = 0;
            echo json_encode($response);
        }
    }



?>