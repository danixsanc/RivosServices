<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Client_Id = $data->Client_Id;
    $Subject = $data->Subject;
    $Message = $data->Message;

    require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
    
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        $sql = "INSERT INTO Message_Client (Subject, Message, Client_Id) VALUES('$Subject', '$Message', '$Client_Id')";

            if ($con->query($sql) === TRUE) 
            {
                $response["Success"] = 1;
                $response["Error"] = false;
                $response["Message"] = "Mensaje Enviado Correctamente!";
                $response["Data"] = true;
                echo json_encode($response);
            }
            else 
            {
                $response["Error"] = true;
                $response["Message"] = "Ocurrio un error, por favor intentelo de nuevo!";
                $response["Data"] = NULL;
                echo json_encode($response);
            }
    }

?>