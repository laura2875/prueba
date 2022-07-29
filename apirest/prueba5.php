<?php
	require_once './vendor/autoload.php';
	use Laminas\Db\Adapter\Adapter;
	header("Content-Type:text/html");
	$consulta = "";
	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			if( isset($_GET['email']) ){ 
				// http://localhost:8080/apirest/prueba5.php?email='javnol@gmail.com'
				$consulta = "SELECT * FROM usuarios WHERE email='" . $_GET['email'] . "'";  
			}
			else{
				// http://localhost:8080/apirest/prueba5.php
				$consulta = "SELECT * FROM usuarios";
			}
			break;
		case 'POST':
			break;
		case 'PUT':
			break;
		case 'DELETE':
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
		$numcol = count($arrNomCampos);
		$respuesta = '<table border="1"><tr>';
		for($i=0; $i<$numcol; $i++){
			$respuesta .= '<th>' . $arrNomCampos[$i] . '</th>';
		}
		$respuesta .= '</tr>';
		while($renglon = $tabla->current()){
			$respuesta .= "<tr>";
			for($i=0; $i<$numcol; $i++){
				$respuesta .= "<td>" . $renglon[$arrNomCampos[$i]] . "</td>"; 
			}
			$respuesta .= "</tr>";
			$tabla->next();
		}
		$respuesta .= "</table>";
	}
	echo $respuesta;
?>