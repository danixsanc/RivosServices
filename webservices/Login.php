<?php
    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

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

        $sql = "SELECT * FROM Client WHERE Email = '$Email'";
        
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
                    $response["Success"] = 1;
                    $response["Error"] = false;
                    $response["Message"] = "Login Exitoso";
                    $row_array['Client_Id'] = $row['Client_Id'];
                    $row_array["Name"] = $row["Name"];
                    $row_array["Phone"] = $row["Phone"];
                    $row_array["Email"] = $row["Email"];
                    $data = array($row_array);
                    $response["Data"] = $data;
                    echo json_encode($response);
                }
                else 
                {
                    $response["Error"] = true;
                    $response["Message"] = "Contraseña Incorrecta!";
                    $response["Data"] = NULL;
                    echo json_encode($response);
                }
            }
        }
        else 
        {
            $response["Error"] = true;
            $response["Message"] = "El email no existe!";
            $response["Data"] = NULL;
            echo json_encode($response);
        }
    }
        
?>