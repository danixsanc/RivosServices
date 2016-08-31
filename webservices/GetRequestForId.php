<?php

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
                $sql = "SELECT Cabbie.Name, Request.Date, Price.Price, Request.Status FROM Request 
                INNER JOIN Cabbie ON Request.Cabbie_Id = Cabbie.Cabbie_Id 
                INNER JOIN Price ON Request.Price_Id = Price.Price_Id
                WHERE Request_Id = '$Request_Id'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    
                    while($row = $result->fetch_assoc()) 
                    {
                        $response["Success"] = 1;
                        $response["Name"] = $row['Name'];
                        $response["Date"] = $row['Date'];
                        $response["Price"] = $row['Price'];
                        $response["Status"] = $row['Status'];
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