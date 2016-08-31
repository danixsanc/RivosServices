<?php
               


            $postdata = file_get_contents("php://input"); 
		    $data = json_decode($postdata);

		    $Email = $data->Email;

        require_once '../include/DB_Connect.php';
        $db = new DB_Connect();
        $con = $db->connect();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {

                $sql = "SELECT * FROM Client INNER JOIN Client_Service ON Client.Client_Id = Client_Service.Client_Id WHERE Email= '$Email'";
		//$sql = "SELECT * FROM Client WHERE Client_Id= '$Client_Id'";
		
		//$sql = "SELECT * FROM Client INNER JOIN Client_Service ON Client.Client_Id = Client_Service.Client_Id WHERE Client_Id = '$Client_Id'";
		
		//SELECT * FROM `Client` INNER JOIN  `Client_Service` ON `Client`.Client_Id = `Client_Service`.Client_Id


		
                $result = $con->query($sql);
 

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $db_email = $row['Email'];
                        $client_id =$row['Client_Id'];
                        $datamod = $row['Data_Mod'];

                    }
                    
                        
                    if (($Email== $db_email) && ($datamod == 0))
                    {

                        
                            $code = rand(10000, 99999);
                            $to = $db_email;
                            $subject = "Rivos Taxi (data modify)";
                            $body = "
                                Este es un mensaje automatico que se genero al solicitar 
                                la modificacion de datos. Ingrese el siguiente codigo $code en la aplicacion. 

                                Si no solicitaste un cambio de contraseña no respondas.
                            ";
				
                            //mysql_query("UPDATE client SET datamod='$code' WHERE email='$email'");
                            

				$nombre = $_REQUEST['nombre'];
				$mail = $_REQUEST['email'];
				$mensaje = $_REQUEST['comments'];
				
				$header = 'From: ' . $db_email. " \r\n";
				$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
				$header .= "Mime-Version: 1.0 \r\n";
				$header .= "Content-Type: text/plain";
				
				$mensaje = "
                                Este es un mensaje automatico que se genero al solicitar 
                                la modificacion de datos. Ingrese el siguiente codigo $code en la aplicacion. 

                                Si no solicitaste un cambio de contraseña no respondas.                        \r\n";
				
				$mensaje .= "Recibido el " . date('d/m/Y', time());
				
				$para = $db_email;
				$asunto = 'Asunto del mail recibido';
				
				mail($para, $asunto, utf8_decode($mensaje), $header);
				
				echo "Enviando....";
				echo "<script>    alert('El mensaje a sido enviado correctamente, Nos comunicaremos con usted en poco tiempo'); 
					location.href ='javascript:history.back()'
				    </script>";

                            
                            
                            
                            
                            $sql = "UPDATE Client_Service SET Data_Mod='$code' WHERE Client_Id='$client_id'";
                	    $result = $con->query($sql);
                	    
                           mail($to, $subject, $body);
                            echo $code;
                            
                            echo "<script lenguage='javascript'>alert('Se le ha enviado un correo, si no aparece en bandeja revise correo no deseado')</script>";


                    }
                    else
                    {
                        echo "<script lenguage='javascript'>alert('E-mail incorrecto')</script>";
                    }
                }
                else
                {
                    echo "<script lenguage='javascript'>alert('El correo que ingreso no esta registrado')</script>";
                    
                }
            }
?>