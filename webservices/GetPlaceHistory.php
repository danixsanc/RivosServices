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
                $sql = "SELECT * FROM Request WHERE Client_Id = '$Client_Id'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $row_array['Latitude'] = $row['Latitude_Fn'];
                        $row_array['Longitude'] = $row['Longitude_Fn'];
                        $row_array['Date'] = $row['Date'];
		                $User = array_push($array1,$row_array);
                        $response["Success"] = 1;
                        $response["num"] = $User;
                        $response["Place".$User] = $array1[$User - 1];

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