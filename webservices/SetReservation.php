<?php

                $postdata = file_get_contents("php://input"); 
			    $data = json_decode($postdata);

			    $Client_Id = $data->Client_Id;
			    $Latitude_In = $data->Latitude_In;
			    $Longitude_In = $data->Longitude_In;
			    $Latitude_Fn = $data->Latitude_Fn;
			    $Longitude_Fn = $data->Longitude_Fn;

            require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                $sql = "INSERT INTO Reservation (Client_Id,Price_Id, Date, Latitude_In, Longitude_In, Latitude_Fn, Longitude_Fn) VALUES('$Client_Id','1', NOW(), '$Latitude_In', '$Longitude_In', '$Latitude_Fn', '$Longitude_Fn')";
                

                        if ($con->query($sql) === TRUE) 
                        {
                            $response["Success"] = 1;
                            echo json_encode($response);
                        }
                        else 
                        {
                            $response["Error"] = 1;
                            $response["Error_msg"] = "Error al registrar reservacion";
                            echo json_encode($response);
                        }
            }
           

?>