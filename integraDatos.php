<?PHP
/* Este programa muestra como integrar datos de una relaci��n maestro detalle de la base de datos 
en un arreglo de objetos detalle como un atributo del objeto maestro
 En este caso el objeto maestro es empresa que tiene un atributo llamado inventario
 que es un arreglo de objetos llamados embarque con dos atributos terminales precio y cantidad*/ 

//llama las credenciales de la bd ocultas en este archivo
    require_once 'global.php'; 

// conecta con la bd o termina el proceso 
 $conexion = mysqli_connect(HOSTNAME,USER,PASSWORD,BD);
    if(!$conexion){
        echo "<script>alert('No fue posible conectarse con la Base de Datos, bye');</script>";
        die();
    }

//sube a memoria declaraciones, recibe datos de interfaz y resultados de un query que carga varios objetos maestro 
    $industria="6";
	$consultaBalance="select idempresa, idmercado, idindustria, infraestructura, bancos, enproceso, mercancias, clientes, hipotecas, proveedores, capitalsocial, utilidades from balance where idempresa in (select idempresa from balance where idindustria='$industria')";
	$resultado=mysqli_query($conexion,$consultaBalance);

	if($conexion)
	{
		while($registro=mysqli_fetch_array($resultado))
        //inicia un ciclo para cada registro del resultset de objetos maestros
        {
        	//inicia la integraci��n de datos en memoria con los par��metros a la base de conocimiento
        	echo " atributo. empresa. objeto. atributo. balance. objeto. atributo. activo. objeto. ";
        	echo "atributo. infraestructura. numero. ".$registro['infraestructura'].". fin.  fin. ";
            //crea el arreglo para detalles del maestro
			echo "atributo. inventario. arreglo. ";
            // va a la base de datos por los detalles del objeto maestro
           	
           	$consultaInsA="select cantidad, precio from embarque where idempresa=".$registro['idempresa']." and idalmacen=1;";
           	$almacenA=mysqli_query($conexion,$consultaInsA);
            // hace un ciclo dentro del objeto maestro para generar los valores contenidos en el arreglo
			while($registro2=mysqli_fetch_array($almacenA)){
				    echo "valor. objeto.  "; // en este caso, contiene objetos
				    echo "atributo. cantidad. numero. ".$registro2['cantidad'].". "; //asigna un atributo
				    echo "atributo. precio. numero. ".$registro2['precio'].". ";     //asigna un atributo
					echo "fin.  ";   //cierra el objeto detalle
			}
			echo "fin. "; //cierra el arreglo de detalles. si no hay detalles deja el arreglo vac��o
        	echo "atributo. metadatos. objeto. "; 			
			echo "atributo. costototal. metodo. asignacion. costototal. 0.  fin. ";
			echo "atributo. precio. metodo. asignacion. precio. costototal*(1+0.2). fin. fin. "; //cierra objeto metadatos
			echo "fin.  ";  //cierra el objeto maestro
    	}   //cierra el ciclo para cada uno de los objetos maestros
		echo "fin.  ";  //cierra el objeto contenedor de maestros
    
			mysqli_close($conexion);
		}
		else{
			echo "no se puede conectar con el servidor de datos bd.polizona.com";
		}
	?>
