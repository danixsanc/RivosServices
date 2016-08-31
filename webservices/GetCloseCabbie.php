<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Latitude = $data->Latitude;
    $Longitude = $data->Longitude;

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

        $sql = "SELECT * FROM Location_Cabbie INNER JOIN Cabbie ON Location_Cabbie.Cabbie_Id = Cabbie.Cabbie_Id WHERE Cabbie.Status = 0";

        $result = $con->query($sql);
        $var1 = 0.05;
        $User = 0;

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                do{
                    $Lat_bd = $row['Latitude'];
                    $Lon_bd = $row['Longitude'];

                    
                    if ((abs($Latitude - $Lat_bd) < $var1) && (abs($Longitude - $Lon_bd) < $var1)) {

                        $rows[] = array(
                        "Latitude" => $row['Latitude'],
                        "Longitude" => $row['Longitude'],
                        "Name" => $row['Name'],
                        "Cabbie_Id" => $row['Cabbie_Id'],
                        "gcm_Id" => $row['gcm_Id']);
                        $User = 1;


                        header('Content-Type: application/json');
                        $response["Data"] = $rows;
                        $response["Success"] = 1;
                        $response["Error"] = false;
                        $response["Message"] = "Historial Correcto";
                        echo json_encode($response);
                        return;
                    }

                    $var1 = $var1 + 0.00001;

                }while ($User == 0);
                        
                        
            }
            //echo json_encode($response);
        }
        else 
        {
            $response["Error"] = true;
            $response["Message"] = "No se encontraron taxistas libres";
            $response["Data"] = NULL;
            echo json_encode($response);
        }
    }

            

?>