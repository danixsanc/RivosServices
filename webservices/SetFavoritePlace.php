<?php



                $postdata = file_get_contents("php://input"); 
                $data = json_decode($postdata);

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
                $sql = "INSERT INTO Place_Favorite (Latitude, Longitude, Client_Id, Place_Name, Desc_Place) 
                VALUES('$Latitude', '$Longitude', '$Client_Id', '$Place_Name', '$Desc_Place')";

                        if ($con->query($sql) === TRUE) 
                        {



                            $sql = "SELECT * FROM Place_Favorite  WHERE Client_Id = '$Client_Id' AND Desc_Place = '$Desc_Place'";

                            $result = $con->query($sql);

                            if ($result->num_rows > 0) 
                            {
                                while($row = $result->fetch_assoc()) 
                                {
                                    //$response['Place_Favorite_Id'] = $row['Place_Favorite_Id'];
                                    $response["Success"] = 1;
                                    $response["Error"] = false;
                                    $response["Message"] = "Mensaje Enviado Correctamente!";
                                    $response["Data"] = $row['Place_Favorite_Id'];
                                    echo json_encode($response);
                                }
                            }
                        }
                        else 
                        {
                            $response["Error"] = true;
                            $response["Message"] = "Ocurrio un error, por favor intentelo de nuevo!";
                            $response["Data"] = NULL;
                            echo json_encode($response);
                        }
            }
?>
