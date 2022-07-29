<?php

session_start();

$_SESSION['autentificado']='NO';

if(isset($_POST['btnis']) && $_POST['btnis']){
	$db=mysqli_connect("localhost","root","");
	mysqli_select_db($db,"producto3");
	$p = hash_hmac('md5',$_POST['txtpass'],'ma2022',false);

	$consulta= "SELECT email, contrasena FROM usuarios WHERE email ='" . $_POST['txtemail'] . "' AND contrasena ='" . $p .  "'";
echo $consulta . "<hr/>";

	$result = mysqli_query($db,$consulta);
	if($result== false) die ("Fallo algo al consultar");
	{
		if($fields= mysqli_fetch_row($result))// el usuario esta en la tabla de usuarios
		{
			$_SESSION['']='SI';
			$_SESSION['email']= $fields[0];
			$_SESSION['contrasena']=$fields[1];

		//	echo "<script> window.location.href='pp.php';</script>";

		}
		else{
			echo "No encontre ese registro";
			 
		}
	}

}

else
echo "<script> window.location.href='http://localhost/TERCERPRODUCTO/public/application/uno';</script>";


?>

 
</html>
