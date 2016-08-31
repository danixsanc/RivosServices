<?php


            $postdata = file_get_contents("php://input"); 
            $data = json_decode($postdata);

            $Client_Id = $data->Client_Id;
            $Password = $data->Password;

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

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) 
                    {
                        $salt = $row['Salt'];
                        $encrypted_password = $row['Encrypted_Password'];
                        $hash = base64_encode(sha1($Password . $salt, true) . $salt);
                        
                        if ($encrypted_password == $hash) 
                        {
                            $response["Success"] = 1;
                            $response["User"]["Client_Id"] = $row["Client_Id"];
                            $response["User"]["Name"] = $row["Name"];
                            $response["User"]["Phone"] = $row["Phone"];
                            $response["User"]["Email"] = $row["Email"];
                            $response["User"]["Created_At"] = $row["Created_At"];
                            echo json_encode($response);
                        }
                        else
                        {
                            $response["Error"] = 1;
                            $response["Error_msg"] = "Contrase単a Incorrecta";
                            echo json_encode($response);
                        }
                    }
                }
            }

?>