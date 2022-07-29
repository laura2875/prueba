<?php
if (isset ($_POST['txtpass'])&& $_POST['btnGenerar']){
    echo hash_hmac ('md5', $_POST['txtpass'],'ma2022',false);

}
?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset ="utf-8">
</head>
<body>
<form action ="genpass.php" method="post">
<hr />
Clave:  <input type="text"
name="txtpass"
value=" <?php if (isset($_POST['txtpass']) ) echo $_POST['txtpass']; ?>" />
<br />  <br />
<input type="submit" name="btnGenerar" value="Generar">
</form>
</body>
 </html>