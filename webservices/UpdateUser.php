<?php


    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Client_Id = $data->Client_id;
    $Name = $data->Name;
    $Phone = $data->Phone;
    $Email = $data->Email;
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
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $salt = $row['Salt'];
                $encrypted_password = $row['Encrypted_Password'];
                $hash = base64_encode(sha1($Password . $salt, true) . $salt);
                
                if ($encrypted_password == $hash) 
                {
                    $sql = "UPDATE Client SET Name = '$Name', Email='$Email', Phone='$Phone' WHERE Client_Id= '$Client_Id'";
                    if ($con->query($sql) === TRUE) 
                    {
                        $sql = "SELECT * FROM Client WHERE Client_Id = '$Client_Id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                $response["Success"] = 1;
                                $response["Error"] = false;
                                $response["Message"] = "Actualizacion Exitosa!";
                                $row_array['Client_Id'] = $row['Client_Id'];
                                $row_array["Name"] = $row["Name"];
                                $row_array["Phone"] = $row["Phone"];
                                $row_array["Email"] = $row["Email"];
                                $data = array($row_array);
                                $response["Data"] = $data;
                                echo json_encode($response);
                            }
                        }
                        else
                        {
                            $response["Error"] = true;
                            $response["Message"] = "Error en el servidor :C!";
                            $response["Data"] = NULL;
                            echo json_encode($response);
                        }
                    }
                    else 
                    {
                        $response["Error"] = true;
                        $response["Message"] = "No se han podido actualizar los datos, intentelo de nuevo mas tarde!";
                        $response["Data"] = NULL;
                        echo json_encode($response);
                    }
                }
                else{
                    $response["Error"] = true;
                    $response["Message"] = "La contraseña no coincide con la almacenada!";
                    $response["Data"] = NULL;
                    echo json_encode($response);
                }
            }
        }
        else{
            $response["Error"] = true;
            $response["Message"] = "Error en el servidor!";
            $response["Data"] = NULL;
            echo json_encode($response);
        }       
    }

?>