<?php

                $postdata = file_get_contents("php://input"); 
			    $data = json_decode($postdata);

			    $Latitude_In = $data->Latitude_In;
			    $Longitude_In = $data->Longitude_In;
			    $Latitude_Fn = $data->Latitude_Fn;
			    $Longitude_Fn = $data->Longitude_Fn;
			    $Client_Id = $data->Client_Id;
			    $Price_Id = $data->Price_Id; 

           require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                $sql = "INSERT INTO Request (Date,     Latitude_In,    Longitude_In,    Latitude_Fn,    Longitude_Fn,    Client_Id, Cabbie_Id, Price_Id,   Status) 
                                      VALUES( NOW(), '$Latitude_In', '$Longitude_In', '$Latitude_Fn', '$Longitude_Fn', '$Client_Id', '1',       '$Price_Id', 404)";

                        if ($con->query($sql) === TRUE) 
                        {
                            $response["Success"] = 1;
                            echo json_encode($response);
                        }
                        else 
                        {
                            $response["Error"] = 1;
                            $response["Error_msg"] = "Error al registrar lugar favorito";
                            echo json_encode($response);
                        }
            }
           
?>