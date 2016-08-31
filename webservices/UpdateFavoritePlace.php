<?php

                $postdata = file_get_contents("php://input"); 
                $data = json_decode($postdata);

                $Place_Favorite_Id = $data->Place_Id;
                $Latitude = $data->Latitude;
                $Longitude = $data->Longitude;
                $Place_Name = $data->Place_Name;
                $Desc_Place = $data->Desc_Place;
                $Client_Id = $data->Client_Id;
            
            require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                $sql = "UPDATE Place_Favorite SET Latitude = '$Latitude', Longitude = '$Longitude', Client_Id = '$Client_Id', 
                Place_Name = '$Place_Name', Desc_Place = '$Desc_Place' WHERE Place_Favorite_Id = '$Place_Favorite_Id'";


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