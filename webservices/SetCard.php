<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Client_Id = $data->Client_Id;
    $Card = $data->Card;
    $Month = $data->Month;
    $Year = $data->Year;
    $Name_Card = $data->Name_Card;

    require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
        
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {

        $encrypted = base64_encode($Card);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);

        $Encrypted_Card = $hash["encrypted"];
        $Salt = $hash["salt"];

        $sql = "INSERT INTO Card (Number_Card, Client_Id, Month, Year, Name_Card) 
        VALUES('$Encrypted_Card','$Client_Id', '$Month', '$Year', '$Name_Card')";

        if ($con->query($sql) === TRUE) 
        {
            $sql = "SELECT * FROM Card WHERE Number_Card = '$Encrypted_Card'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $rows[] = array("Card_Id" => $row['Card_Id']);
                        header('Content-Type: application/json');
                        $response["Data"] = $rows;
                        $response["Success"] = 1;
                        $response["Error"] = false;
                        $response["Message"] = "Taxista Agregado Correctamente";
                        echo json_encode($response);
                    }
                    
                }
        }
        else 
        {
            $response["Error"] = true;
            $response["Message"] = "Error al registrar tarjeta";
            $response["Data"] = false;
            echo json_encode($response);
        }
    }
?>