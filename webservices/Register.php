<?php

    $postdata = file_get_contents("php://input"); 
    $user = json_decode($postdata);

    $Name = $user->Name;
    $Phone = $user->Phone;
    $Email = $user->Email;
    $Password = $user->Password;

    require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
    
    if (mysqli_connect_errno())
    {
        echo "fam_monitor_file(fam, filename)d to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        $sql = "SELECT Email FROM Client WHERE Email = '$Email'";
            
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
                    $response["Error"] = true;
                    $response["Message"] = "Correo ya existe!";
                    $response["Data"] = NULL;
                    echo json_encode($response);
        }
        else
        {
            $sql = "SELECT Phone FROM Client WHERE Phone = '$Phone'";
                
            $result = $con->query($sql);
            if ($result->num_rows > 0) 
            {
                        $response["Error"] = true;
                        $response["Message"] = "El telefono ya existe";
                        echo json_encode($response);
            }
            else
            {
                $salt = sha1(rand());
                $salt = substr($salt, 0, 10);
                $encrypted = base64_encode(sha1($Password . $salt, true) . $salt);
                $hash = array("salt" => $salt, "encrypted" => $encrypted);

                $Encrypted_Password = $hash["encrypted"];
                $Salt = $hash["salt"];

                $sql = "INSERT INTO Client (Name, Phone, Email, Encrypted_Password, Salt, Created_at) 
                    VALUES( '$Name', '$Phone', '$Email', '$Encrypted_Password', '$Salt', NOW() )";

                if ($con->query($sql) === TRUE) 
                {


                    $sql = "SELECT * FROM Client WHERE Email = '$Email'";
                    
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) 
                    {
                    
                        while($row = $result->fetch_assoc()) 
                        {
                            $response["Success"] = 1;
                            $response["Error"] = false;
                            $response["Message"] = "Registro Exitoso";
                            $row_array['Client_Id'] = $row['Client_Id'];
                            $row_array["Name"] = $row["Name"];
                            $row_array["Phone"] = $row["Phone"];
                            $row_array["Email"] = $row["Email"];
                            $data = array($row_array);
                            $response["Data"] = $data;
                            echo json_encode($response);
                        }
                    }
                }
                else 
                {
                    $response["Error"] = true;
                    $response["Error_msg"] = "Error al registrar";
                    echo json_encode($response);
                }
            }
        }
    }

?>