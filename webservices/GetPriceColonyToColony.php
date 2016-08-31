<?php

                $postdata = file_get_contents("php://input"); 
			    $data = json_decode($postdata);

			    $Distance = $data->Distance;
            
            require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {

                if ($Distance < 3) {
                   $response["Success"] = 1;
                   $response["Price"] = 50;
                   echo json_encode($response);
                }
                else if ($Distance <= 5) {
                    $response["Success"] = 1;
                   $response["Price"] = 70;
                   echo json_encode($response);
                }
                else if ($Distance > 5) {
                    $response["Success"] = 1;
                   $response["Price"] = 100;
                   echo json_encode($response);
                }
                else 
                {
                    $response["Error"] = 1;
                    $response["Error_Msg"] = "Error al obtener datos";
                    echo json_encode($response);
                }
            }
      

?>