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
        $var1 = 0.00001;
        $User = 0;
        $may = null;
        $distMay = null;

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $Lat_bd = $row['Latitude'];
                $Lon_bd = $row['Longitude'];

                $dis = distance($Latitude, $Longitude, $Lat_bd, $Lon_bd);
                if ($may == null) {
                    $may = $row;
                    $distMay = $dis;
                }
                else{
                    if ($distMay < $dis) {
                        $may = $row;
                        $distMay = $dis;
                    }
                }      
            }

            $rows[] = array(
            "Latitude" => $may['Latitude'],
            "Longitude" => $may['Longitude'],
            "Name" => $may['Name'],
            "Cabbie_Id" => $may['Cabbie_Id'],
            "gcm_Id" => $may['gcm_Id']);
            $User = 1;

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
            $response["Message"] = "No se encontraron taxistas libres";
            $response["Data"] = NULL;
            echo json_encode($response);
        }
    }


    function distance($lat1, $lon1, $lat2, $lon2) {

          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);

        return ($miles * 1.609344);

    }

            

?>