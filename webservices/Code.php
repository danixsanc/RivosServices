<?php



            $postdata = file_get_contents("php://input"); 
            $data = json_decode($postdata);

            $Client_Id = $data->Client_Id;
            $Code = $data->Code;

        require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
        	$sql = "SELECT * FROM Client_Service WHERE Client_Id = '$Client_Id'";
                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $datamod = $row['Data_Mod'];

                    }
                    if ($datamod == $Code) {
                    	$sql = "UPDATE Client_Service SET Data_Mod = 0 WHERE Client_Id = '$Client_Id'";
                	$result = $con->query($sql);
			$response["Success"] = 1;
                        echo json_encode($response);
	            }
	            else 
	                {
	                    $response["error"] = 1;
	                    $response["error_msg"] = "Error occured in code verification";
	                    echo json_encode($response);
	                }
                }

		}

?>