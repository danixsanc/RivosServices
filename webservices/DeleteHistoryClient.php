<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Request_Id = $data->Request_Id;
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
        
        $sql = "UPDATE Request SET Status = '500' WHERE Request_Id = '$Request_Id' AND Client_Id = '$Client_Id'";
        if ($con->query($sql) === TRUE) 
        {
            $response["Error"] = false;
            $response["Message"] = "Eliminado Correctamente!";
            $response["Data"] = NULL;
            echo json_encode($response);
        }
        else 
        {
            $response["Error"] = true;
            $response["Message"] = "Error al eliminar registro!";
            $response["Data"] = NULL;
            echo json_encode($response);
        }
               
    }
           



?>