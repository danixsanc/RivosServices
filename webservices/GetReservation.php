<?php

                $postdata = file_get_contents("php://input"); 
                $data = json_decode($postdata);

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

                $sql = "SELECT * FROM Reservation WHERE Client_Id = '$Client_Id'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $response["Success"] = 1;
                        $response['Date'] = $row['Date'];
                        $response['Latitude_In'] = $row['Latitude_In'];
                        $response['Longitude_In'] = $row['Longitude_In'];
                        $response['Latitude_Fn'] = $row['Latitude_Fn'];
                        $response['Longitude_Fn'] = $row['Longitude_Fn'];
                        echo json_encode($response);
                    }
                }
                else 
                {
                    $response["Error"] = 1;
                    $response["Error_Msg"] = "Error al obtener datos";
                    echo json_encode($response);
                }
            }
?>