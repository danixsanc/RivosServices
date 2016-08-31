<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Client_Id = $data->Client_Id;
    $Cabbie_Id = $data->Cabbie_Id;

    require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
    
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {

        $sql = "DELETE FROM Cabbie_Favorite WHERE Client_Id = '$Client_Id' AND Cabbie_Id = '$Cabbie_Id'";
        

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