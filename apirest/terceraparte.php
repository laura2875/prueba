<?php
	require_once './vendor/autoload.php';
	use Laminas\Db\Adapter\Adapter;
	$consulta = "";
	$json="";
	$url="";
	$opc=0;
	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			if( isset($_GET['email']) ){ 
				// http://localhost:8080/apirest/prueba5.php?email='javnol@gmail.com'
				$consulta = "SELECT * FROM usuarios WHERE email='" . $_GET['email'] . "'";  
			}
			else{
				// http://localhost:8080/apirest/prueba5.php
				$consulta = "SELECT * FROM usuarios";
			$opc=1;
			}
			break;
			case 'POST':
				$json = file_get_contents('php://input');
				$consulta = "INSERT INTO usuarios (email,contrasena)
				VALUES ('" . $_GET['email'] . "','" . $_GET['contrasena']."')";
				$opc = 2;
				break;

			case 'PUT':
			var_dump(json_decode($json, true));
			 json_decode(file_get_contents('php://input'),true);    
			$consulta = "UPDATE usuarios set email = '" . $_GET['nueva'] . "'" . "where email = '" . $_GET['email'] . "'";
			$opc = 3;
			break;

			case 'DELETE':
			$url = file_get_contents('php://input');
			parse_str($url, $_DELETE);
			$consulta = "DELETE FROM usuarios WHERE email='".$_GET['email'] ."'";
			$opc=4;
			break;
	}
	// echo $consulta;
	$arrNomCampos = Array('email', 'contrasena');
	$respuesta = "";
	if($consulta!==""){
		$ac = array(
			'driver' => "Mysqli", 
			'database' => "producto3", 
			'username' => "root", 
			'password'=> ""
		);
		$adapter = new Adapter($ac);
		$tabla = $adapter->query($consulta, Adapter::QUERY_MODE_EXECUTE);
		

		if($opc==1 ){
			$respuesta = array();
			while($row =$tabla->current()){
			{
                $respuesta[]=$row;
        	    $tabla->next();
			}
		   }
			
		}
		
		else if($opc==2 ){
			$respuesta ='{"Insert"}';
		}
		
		else if($opc==3 ){
			$respuesta ='{"Update"}';
		}
		
		else if($opc==4 ){
			$respuesta ='{"Delete"}';
		}
	}
	$variable = json_encode($respuesta, 256);
	echo $variable;
?>