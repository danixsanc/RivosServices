<?php

                $postdata = file_get_contents("php://input"); 
			    $data = json_decode($postdata);

			    $Place_Favorite_Id = $data->Place_Id;

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

                $sql = "SELECT * FROM Place_Favorite WHERE Place_Favorite_Id = '$Place_Favorite_Id'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $row_array['Place_Favorite_Id'] = $row['Place_Favorite_Id'];
                        $row_array['Latitude'] = $row['Latitude'];
                        $row_array['Longitude'] = $row['Longitude'];
                        $row_array['Desc_Place'] = $row['Desc_Place'];
                        $row_array['Place_Name'] = $row['Place_Name'];
                  $User = array_push($array1,$row_array);
                        $response["Success"] = 1;
                        $response["num"] = $User;
                        $response["Place".$User] = $array1[$User - 1];
                        //$response['Cabbie_Id'] = $row['Cabbie_Id'];
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