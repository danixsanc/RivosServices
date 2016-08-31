<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Client_Id = $data->Client_Id;

    $array1 = array();

    require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
    
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        $sql = "SELECT * FROM Request INNER JOIN Cabbie ON 
        Request.Cabbie_Id = Cabbie.Cabbie_Id WHERE Client_Id = '$Client_Id' AND Request.Cabbie_Id > 1 AND Request.Status = 2
        GROUP BY Cabbie.Cabbie_Id";

        $result = $con->query($sql);

        if ($result->num_rows > 0) 
        {


            while($row = $result->fetch_assoc()) 
                    {
                        $rows[] = array(
                        "Name" => $row['Name'],
                        "Cabbie_Id" => $row['Cabbie_Id']);

                    }
                    header('Content-Type: application/json');
                    $response["Data"] = $rows;
                    $response["Success"] = 1;
                    $response["Error"] = false;
                    $response["Message"] = "Historial Correcto";
                    echo json_encode($response);
        }
        else 
        {
            $response["Error"] = true;
            $response["Success"] = 0;
            $response["Message"] = "Error al obtener datos";
            $response["Data"] = NULL;
            echo json_encode($response);
        }
    }

?>