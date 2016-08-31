<?php


            $Request_Id = $_REQUEST['Request_Id'];

                $postdata = file_get_contents("php://input"); 
			    $data = json_decode($postdata);

			    $Request_Id = $data->Request_Id;

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
                $sql = "SELECT * FROM Request 
                INNER JOIN Cabbie ON Request.Cabbie_Id = Cabbie.Cabbie_Id
                INNER JOIN Price ON Request.Price_Id = Price.Price_Id 
                WHERE Request_Id = '$Request_Id'";
                 

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $row_array['Request_Id'] = $row['Request_Id'];
                        $row_array['Date'] = $row['Date'];
                        $row_array['Latitude_In'] = $row['Latitude_In'];
                        $row_array['Longitude_In'] = $row['Longitude_In'];
                        $row_array['Latitude_Fn'] = $row['Latitude_Fn'];
                        $row_array['Longitude_Fn'] = $row['Longitude_Fn'];
                        $row_array['Name'] = $row['Name'];
                        $row_array['Price'] = $row['Price'];
                        $row_array['Ref'] = $row['Ref'];
                        $row_array['Cabbie_Id'] = $row['Cabbie_Id'];
                        $User = array_push($array1,$row_array);
                        $response["Success"] = 1;
                        $response["num"] = $User;
                        $response["Request".$User] = $array1[$User - 1];

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