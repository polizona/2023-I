<?PHP
require_once 'config/global.php';	
include("index.php"); 


//realiza conexion
    $conexion = mysqli_connect(HOSTNAME,USER,PASSWORD,BD);
        
        if ($conexion) {
            $idalcaldia= $_POST ['idalcaldia'];
            $alcaldia= $_POST ['alcaldia'];
            
            //Bloquear registros vacios
            if ($_POST["idalcaldia"]!==""){
                //registro a DB
               $consulta="insert into alcaldia values ('$idalcaldia','$alcaldia')";
            } else {
               echo "Llene los campos requeridos <br>";
            }
            $registro=mysqli_query($conexion,$consulta);
                //Confirmacion
               if ($registro) {
		mysqli_close($conexion);
                 echo "Registro almacenado. <br>";
               }
            else {
               echo "error en la ejecución del registro <br>";
            }
        }

			
	?>
