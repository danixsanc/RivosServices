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

                $sql = "SELECT * FROM Cabbie_Favorite INNER JOIN Cabbie ON Cabbie_Favorite.Cabbie_Id = Cabbie.Cabbie_Id 
                INNER JOIN Admin ON Cabbie.Admin_Id = Admin.Admin_Id WHERE Client_Id = '$Client_Id'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $rows[] = array(
                        "CabbieFavoriteId" => $row['Cabbie_Id'],
                        "Name" => $row['Name'],
                        "Company" => $row['Company']);
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
                    $response["Error"] = true;
                    $response["Message"] = "Error al obtener datos";
                    $response["Data"] = NULL;
                    $response["Success"] = 0;
                    echo json_encode($response);
                }
            }


?>