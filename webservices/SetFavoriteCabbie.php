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
        $sql1 = "SELECT * FROM Cabbie_Favorite WHERE Cabbie_Id = '$Cabbie_Id' AND Client_Id = '$Client_Id'";
                
        $result = $con->query($sql1);
        if ($result->num_rows > 0) 
        {
            $response["Error"] = true;
            $response["Message"] = "El taxista seleccionado ya se encuentra como favorito!";
            $response["Data"] = NULL;
            $response["Success"] = 0;
            echo json_encode($response);
        }
        else
        {
            $sql = "INSERT INTO Cabbie_Favorite (Client_Id, Cabbie_Id) VALUES('$Client_Id', '$Cabbie_Id')";

            if ($con->query($sql) === TRUE) 
            {
                $sql = "SELECT * FROM Cabbie_Favorite INNER JOIN Cabbie ON Cabbie_Favorite.Cabbie_Id = Cabbie.Cabbie_Id 
                INNER JOIN Admin ON Cabbie.Admin_Id = Admin.Admin_Id WHERE Client_Id = '$Client_Id' AND Cabbie.Cabbie_Id = '$Cabbie_Id'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $rows[] = array(
                        "Cabbie_Id" => $row['Cabbie_Id'],
                        "Name" => $row['Name'],
                        "Company" => $row['Company']);

                    }
                    header('Content-Type: application/json');
                    $response["Data"] = $rows;
                    $response["Success"] = 1;
                    $response["Error"] = false;
                    $response["Message"] = "Taxista Agregado Correctamente";
                    echo json_encode($response);
                }

            }
            else 
            {
                $response["Error"] = true;
                $response["Message"] = "Ocurrio un error, por favor intentelo de nuevo!";
                $response["Data"] = NULL;
                $response["Success"] = 0;
                echo json_encode($response);
            }
        }
            
    }
           


?>