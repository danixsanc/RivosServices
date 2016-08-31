<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Client_Id = $data->Client_Id;
    $Card_Id = $data->Card_Id;


    require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
    
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {

        $sql = "DELETE FROM Card WHERE Client_Id = '$Client_Id' AND Card_Id = '$Card_Id'";

        if ($con->query($sql) === TRUE) 
        {
            header('Content-Type: application/json');
            $response["Data"] = true;
            $response["Error"] = false;
            $response["Message"] = "Tarjeta eliminada con exito!";
            echo json_encode($response);
        }
        else 
        {
            $response["Error"] = true;
            $response["Message"] = "Error al elimiar tarjeta!";
            $response["Data"] = false;
            echo json_encode($response);
        }
    }
?>