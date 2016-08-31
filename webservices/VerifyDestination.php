<?php

		    $postdata = file_get_contents("php://input"); 
		    $data = json_decode($postdata);

		    $Latitude = $data->Latitude;
		    $Longitude = $data->Longitude;

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

                $sql = "SELECT * FROM Airports";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $Lat_bd = $row['Latitude'];
                        $Lon_bd = $row['Longitude'];

                        if ((abs($Latitude - $Lat_bd) < 0.0100) && (abs($Longitude - $Lon_bd) < 0.0100)) {
                            $response["Success"] = 1;
                        }
                        else
                        {
                            $response["Success"] = 2;   
                        }
                        
                    }
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