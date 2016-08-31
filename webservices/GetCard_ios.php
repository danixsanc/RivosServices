<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

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
        $sql = "SELECT * FROM Card WHERE Client_Id = '$Client_Id'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) 
        {
            
            $array1 = array();

        	while($row = $result->fetch_assoc()) 
            {
                $salt = $row['Salt'];
                $encrypted_card = $row['Number_Card'];
                $hash = base64_decode($encrypted_card);


                /*$rows[] = array(
                "Card_Id" => $row['Card_Id'],
                "Number_Card" => $hash,
                "Month" => $row['Month'],
                "Year" => $row['Year'],
                "Name_Card " => $row['Name_Card']);*/

                $row_array['Number_Card'] = $hash;
                $row_array['Card_Id'] = $row['Card_Id'];
                $row_array['Month'] = $row['Month'];
                $row_array['Year'] = $row['Year'];
                $row_array['Name_Card'] = $row['Name_Card'];
                $User = array_push($array1, $row_array);
                $response["Success"] = 1;
                $response["num"] = $User;
                $response["Card".$User] = $array1[$User - 1];
            }
            //header('Content-Type: application/json');
            /*$response["Data"] = $rows;
            $response["Error"] = false;
            $response["Message"] = "Datos Correcto";*/
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