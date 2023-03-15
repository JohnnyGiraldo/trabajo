<?php require_once('Connections/conexion1.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_GET['cedula'])) {
  $colname_Recordset1 = $_GET['cedula'];
}
mysql_select_db($database_conexion1, $conexion1);
$query_Recordset1 = sprintf("SELECT * FROM persona WHERE cedula = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['contrasena'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "menu.php";
  $MM_redirectLoginFailed = "index1.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion1, $conexion1);
  
  $LoginRS__query=sprintf("SELECT usuario, contrasena FROM login WHERE usuario=%s AND contrasena=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
  
  $LoginRS = mysql_query($LoginRS__query, $conexion1) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    echo'<script type="text/javascript">
    alert("Contraseña Incorrecta");
    window.location.href="index.php";
    </script>';
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>first</title>
</head>
<style>
body {
    background-color: #A569BD;
}
form {
    background-color: #76D7C4;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    margin: 220px 500px;
    border: #b0d9ff 5px solid;
    border-radius: 20px 0 20px 0;
    text-align: center;
}

input.enviar {
    background-color: #7FB3D5;
    margin: 10px;
    font-size: 15px;
    font-family: serif;
	color:#FFF;
}
</style>
<body>

<form  name="form1" method="POST" action="">
<img src="img/ingreso.jpg" width="161" height="126" />
<br /><br /><br />
Usuario:
<input name="usuario" type="text"> 
<br><br>
Contraseña: <input name="contrasena" type="text"> <br><br>
<input class="enviar" name="enviar" type="submit" value="ingresar" onclick="return ingresar()">
</form>

<script type="text/javascript">
function ingresar() {
	var respuesta = confirm("seguro que deseas ingresar con este usuario?");
	if (respuesta == true)
	{
		return true;
		}
	else {
		return false;
		}
	}
</script>

</body>
</html>
