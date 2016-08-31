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


            	$sql = "SELECT * FROM Client WHERE Client_Id = '$Client_Id'";
                
                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        
                            $response["Success"] = 1;
                            $response["User"]["Client_Id"] = $row["Client_Id"];
                            $response["User"]["Name"] = $row["Name"];
                            $response["User"]["Phone"] = $row["Phone"];
                            $response["User"]["Email"] = $row["Email"];
                            $response["User"]["Created_At"] = $row["Created_At"];
                            echo json_encode($response);
                        
                    }
                } 
                else 
                {
                    $response["Error"] = 2;
                    $response["Error_Msg"] = "Error al obtener datos";
                    echo json_encode($response);
                }
                }

?>