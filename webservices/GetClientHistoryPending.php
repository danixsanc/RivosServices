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
        $sql = "SELECT * FROM Request 
        INNER JOIN Cabbie ON Request.Cabbie_Id = Cabbie.Cabbie_Id 
        INNER JOIN Price ON Request.Price_Id = Price.Price_Id
        WHERE Client_Id = '$Client_Id' AND Request.Status != 2 ";

        $result = $con->query($sql);

        if ($result->num_rows > 0) 
        {

            while($row = $result->fetch_assoc()) 
            {
                $rows[] = array(
                        "Request_Id" => $row['Request_Id'],
                        "Date" => $row['Date'],
                        "Inicio" => $row['Inicio'],
                        "Destino" => $row['Destino'],
                        "Ref" => $row['Ref'],
                        "Cabbie_Name" => $row['Name'],
                        "Price" => $row['Price'],
                        "Cabbie" => $row['Cabbie_Id']);
            }
            header('Content-Type: application/json');
            $response["Data"] = $rows;
            $response["Success"] = 1;
            $response["Error"] = false;
            $response["Message"] = "Taxistas Favoritos Correcto";
            echo json_encode($response);
        }
        else 
        {
            $response["Error"] = 1;
            $response["Error_Msg"] = "Error al obtener datos";
            echo json_encode($response);
        }
    }
           
?>