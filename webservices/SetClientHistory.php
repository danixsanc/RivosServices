<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Latitude_In = $data->Latitude_In;
    $Longitude_In = $data->Longitude_In;
    $Latitude_Fn = $data->Latitude_Fn;
    $Longitude_Fn = $data->Longitude_Fn;
	$Client_Id = $data->Client_Id;
    $Cabbie_Id = $data->Cabbie_Id;
    $Price_Id = $data->Price_Id;
    $Destino = $data->Destino;
    $Inicio = $data->Inicio;
    $Tipo = $data->Tipo;
            
    require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
    
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        $sql = "INSERT INTO Request (Date, Latitude_In, Longitude_In, Latitude_Fn, Longitude_Fn, Inicio, Destino, Client_Id, Cabbie_Id, TipoPago, Price_Id, Status) 
        VALUES( NOW(), '$Latitude_In', '$Longitude_In', '$Latitude_Fn', '$Longitude_Fn', '$Inicio', '$Destino', '$Client_Id', '$Cabbie_Id', '$Tipo', '$Price_Id', '0')";

        if ($con->query($sql) === TRUE) 
        {
            $sql = "UPDATE Cabbie SET Status = 1 WHERE Cabbie_Id = '$Cabbie_Id'";
            $con->query($sql);

            $Ref = date('ymd')."$Cabbie_Id".'-'."$Client_Id".date('His');
            $rows[] = array(
            "Date" => date('Y-m-d H:i:s'),
            "Ref" => $Ref);

            $sql = "UPDATE Request SET Ref = '$Ref' WHERE Cabbie_Id = '$Cabbie_Id' AND Client_Id = '$Client_Id' AND Status = '0'";
            $con->query($sql);
                    
            header('Content-Type: application/json');
            $response["Data"] = $rows;
            $response["Success"] = 1;
            $response["Error"] = false;
            $response["Message"] = "Registrado con exito";
            echo json_encode($response);
        }
        else 
        {
            $response["Error"] = true;
            $response["Message"] = "Error al obtener datos";
            $response["Data"] = NULL;
            echo json_encode($response);
        }
    }

?>