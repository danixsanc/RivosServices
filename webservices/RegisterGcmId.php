<?php

                $postdata = file_get_contents("php://input"); 
			    $data = json_decode($postdata);

			    $Client_Id = $data->Client_Id;
			    $GcmId = $data->GcmId;

            
            require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                
                $sql = "UPDATE Client SET gcm_id = '$GcmId' WHERE Client_Id = '$Client_Id'";
                if ($con->query($sql) === TRUE) 
                {
                    $response["Error"] = false;
                    $response["Message"] = "Registrado Correctamente!";
                    $response["Data"] = true;
                    $response["Success"] = 1;
                    echo json_encode($response);
                }
                else 
                {
                    $response["Error"] = true;
                    $response["Message"] = "Error al registrar GCM!";
                    $response["Data"] = false;
                    $response["Success"] = 1;
                    echo json_encode($response);
                }
                       
            }
           

?>