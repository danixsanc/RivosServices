<?php

    $postdata = file_get_contents("php://input"); 
    $data = json_decode($postdata);

    $Latitude_In = $data->Latitude_In;
    $Longitude_In = $data->Longitude_In;
    $Latitude_Fn = $data->Latitude_Fn;
    $Longitude_Fn = $data->Longitude_Fn;
    $Distance = $data->Distance;

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

        $sql = "SELECT * FROM Airports";
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $Lat_bd = $row['Latitude'];
                $Lon_bd = $row['Longitude'];

                //se encuentra en un aeropuerto
                if ((abs($Latitude_In - $Lat_bd) < 0.0035) && (abs($Longitude_In - $Lon_bd) < 0.0035)) 
                {
                            $sql = "SELECT * FROM Price INNER JOIN Colony ON Price.Colony_Id = Colony.Colony_Id";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) 
                            {
                                while($row = $result->fetch_assoc()) 
                                {
                                    $Lat_bd = $row['Latitude'];
                                    $Lon_bd = $row['Longitude'];

                                    if ((abs($Latitude_Fn - $Lat_bd) < 0.0035) && (abs($Longitude_Fn - $Lon_bd) < 0.0035)) 
                                    {
                                        $response["Success"] = 1;
                                        $response["Error"] = false;
                                        $response["Message"] = "Se encontro el precio 1";
                                        $response["Data"] = $row['Price'].",".$row['Price_Id'];
                                        echo json_encode($response);
                                        return;
                                    }
                                        
                                }
                                $response["Error"] = true;
                                $response["Message"] = "No se encontro una colonia valida!";
                                $response["Data"] = NULL;
                                $response["Success"] = 0;
                                echo json_encode($response);
                                return;
                            }
                            else 
                            {
                                $response["Error"] = true;
                                $response["Message"] = "Error al obtener datos 1!";
                                $response["Data"] = NULL;
                                $response["Success"] = 0;
                                echo json_encode($response);
                                return;
                            }

                }
                //no se encuentra en un aeropuerto
                else
                {
                    $sql = "SELECT * FROM Airports";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                            $Lat_bd = $row['Latitude'];
                            $Lon_bd = $row['Longitude'];

                            if ((abs($Latitude_Fn - $Lat_bd) < 0.0035) && (abs($Longitude_Fn - $Lon_bd) < 0.0035)) 
                            {
                                //se dirige al aeropuerto
                                $sql = "SELECT * FROM Price INNER JOIN Colony ON Price.Colony_Id = Colony.Colony_Id";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) 
                                {
                                    while($row = $result->fetch_assoc()) 
                                    {
                                        $Lat_bd = $row['Latitude'];
                                        $Lon_bd = $row['Longitude'];

                                        if ((abs($Latitude_Fn - $Lat_bd) < 0.0035) && (abs($Longitude_Fn - $Lon_bd) < 0.0035)) 
                                        {
                                            $response["Success"] = 1;
                                            $response["Error"] = false;
                                            $response["Message"] = "Se encontro el precio 2";
                                            $response["Data"] = $row['Price_D'].",".$row['Price_Id'];
                                            echo json_encode($response);
                                            return;
                                        }
                                            
                                    }
                                    $response["Error"] = true;
                                    $response["Message"] = "Error al obtener datos 2!";
                                    $response["Data"] = NULL;
                                    $response["Success"] = 0;
                                    echo json_encode($response);
                                    return;
                                }
                                else 
                                {
                                    $response["Error"] = true;
                                    $response["Message"] = "Error al obtener datos 3!";
                                    $response["Data"] = NULL;
                                    $response["Success"] = 0;
                                    echo json_encode($response);
                                    return;
                                }
                            }
                            else
                            {
                                //se dirige a una colonia
                                if ($Distance < 3) 
                                {
                                    $response["Success"] = 1;
                                    $response["Error"] = false;
                                    $response["Message"] = "Se encontro el precio 3";
                                    $response["Data"] = "50";
                                    echo json_encode($response);
                                    return;
                                }
                                else if ($Distance <= 5) 
                                {
                                    $response["Success"] = 1;
                                    $response["Error"] = false;
                                    $response["Message"] = "Se encontro el precio 4";
                                    $response["Data"] = "70";
                                    echo json_encode($response);
                                    return;
                                }
                                else if ($Distance > 5) 
                                {
                                    $response["Success"] = 1;
                                    $response["Error"] = false;
                                    $response["Message"] = "Se encontro el precio 5";
                                    $response["Data"] = "100";
                                    echo json_encode($response);
                                    return;
                                }
                                else 
                                {
                                    $response["Error"] = true;
                                    $response["Message"] = "Error al obtener datos 4!";
                                    $response["Data"] = NULL;
                                    $response["Success"] = 0;
                                    echo json_encode($response);
                                    return;
                                }
                            }
                            
                        }
                    }
                    else 
                    {
                        $response["Error"] = true;
                        $response["Message"] = "Error al obtener datos 5!";
                        $response["Data"] = NULL;
                        $response["Success"] = 0;
                        echo json_encode($response);
                        return;
                    }
                }
                
            }
        }
    }


?>