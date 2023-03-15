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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_tablapersona = 100;
$pageNum_tablapersona = 0;
if (isset($_GET['pageNum_tablapersona'])) {
  $pageNum_tablapersona = $_GET['pageNum_tablapersona'];
}
$startRow_tablapersona = $pageNum_tablapersona * $maxRows_tablapersona;

mysql_select_db($database_conexion1, $conexion1);
$query_tablapersona = "SELECT * FROM persona";
$query_limit_tablapersona = sprintf("%s LIMIT %d, %d", $query_tablapersona, $startRow_tablapersona, $maxRows_tablapersona);
$tablapersona = mysql_query($query_limit_tablapersona, $conexion1) or die(mysql_error());
$row_tablapersona = mysql_fetch_assoc($tablapersona);

if (isset($_GET['totalRows_tablapersona'])) {
  $totalRows_tablapersona = $_GET['totalRows_tablapersona'];
} else {
  $all_tablapersona = mysql_query($query_tablapersona);
  $totalRows_tablapersona = mysql_num_rows($all_tablapersona);
}
$totalPages_tablapersona = ceil($totalRows_tablapersona/$maxRows_tablapersona)-1;

$maxRows_conexion = 1;
$pageNum_conexion = 0;
if (isset($_GET['pageNum_conexion'])) {
  $pageNum_conexion = $_GET['pageNum_conexion'];
}
$startRow_conexion = $pageNum_conexion * $maxRows_conexion;

$colname_conexion = "-1";
if (isset($_GET['cedula'])) {
  $colname_conexion = $_GET['cedula'];
}
mysql_select_db($database_conexion1, $conexion1);
$query_conexion = sprintf("SELECT cedula FROM persona WHERE cedula = %s", GetSQLValueString($colname_conexion, "int"));
$query_limit_conexion = sprintf("%s LIMIT %d, %d", $query_conexion, $startRow_conexion, $maxRows_conexion);
$conexion = mysql_query($query_limit_conexion, $conexion1) or die(mysql_error());
$row_conexion = mysql_fetch_assoc($conexion);

if (isset($_GET['totalRows_conexion'])) {
  $totalRows_conexion = $_GET['totalRows_conexion'];
} else {
  $all_conexion = mysql_query($query_conexion);
  $totalRows_conexion = mysql_num_rows($all_conexion);
}
$totalPages_conexion = ceil($totalRows_conexion/$maxRows_conexion)-1;

$queryString_conexion = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_conexion") == false && 
        stristr($param, "totalRows_conexion") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_conexion = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_conexion = sprintf("&totalRows_conexion=%d%s", $totalRows_conexion, $queryString_conexion);

$queryString_tablapersona = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_tablapersona") == false && 
        stristr($param, "totalRows_tablapersona") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_tablapersona = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_tablapersona = sprintf("&totalRows_tablapersona=%d%s", $totalRows_tablapersona, $queryString_tablapersona);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<style>
body {
    background-color: #58D68D;
}

table {
	background-color: #58D68D;
	font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
	margin: 0px auto;
	border: #b0d9ff 5px solid;
	border-radius: 10px;
	text-align: center;
}

td.modificar, td.eliminar {
    font-size: 15px;
    font-family: serif;
}

td.modificar:hover, td.eliminar:hover {
    font-size: 15px;
    font-family: serif;
    background-color: #7D3C98;
}

a.modificar, a.eliminar {
    color: #b0d9ff;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

a.modificar:hover, a.eliminar:hover {
    color: #7241ff;
}
</style>
<body>
<table border="1">
  <tr>
    <td>cedula</td>
    <td>fecha</td>
    <td>asunto</td>
    <td>prim_nombre</td>
    <td>seg_nombre</td>
    <td>prim_apellido</td>
    <td>seg_apellido</td>
    <td>fijo</td>
    <td>celular</td>
    <td>direccion</td>
    <td>barrio</td>
    <td>descripcion</td>
    <td>Pais</td>
    <td>Estado</td>
    <td>Ciudad</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_tablapersona['cedula']; ?></td>
      <td><?php echo $row_tablapersona['fecha']; ?></td>
      <td><?php echo $row_tablapersona['asunto']; ?></td>
      <td><?php echo $row_tablapersona['primer_nombre']; ?></td>
      <td><?php echo $row_tablapersona['segundo_nombre']; ?></td>
      <td><?php echo $row_tablapersona['primer_apellido']; ?></td>
      <td><?php echo $row_tablapersona['segundo_apellido']; ?></td>
      <td><?php echo $row_tablapersona['fijo']; ?></td>
      <td><?php echo $row_tablapersona['celular']; ?></td>
      <td><?php echo $row_tablapersona['direccion']; ?></td>
      <td><?php echo $row_tablapersona['barrio']; ?></td>
      <td><?php echo $row_tablapersona['descripcion']; ?></td>
      <td><?php echo $row_tablapersona['pais']; ?></td>
      <td><?php echo $row_tablapersona['estado']; ?></td>
      <td><?php echo $row_tablapersona['ciudad']; ?></td>
      <td onClick="return editar()"><a href="copyeditar.php?cedula=<?php echo $row_tablapersona['cedula']; ?>">editar</a></td>
      <td onClick="return borrar()"><a href="eliminar.php?cedula=<?php echo $row_tablapersona['cedula']; ?>">eliminar</td>
    </tr>
    <?php } while ($row_tablapersona = mysql_fetch_assoc($tablapersona)); ?>
</table>
<p>
  <script type="text/javascript">
function borrar() {
	var respuesta = confirm("seguro que deseas eliminar este usuario?");
	if (respuesta == true)
	{
		return true;
		}
	else {
		return false;
		}
	}
  </script></p>
<table width="120%" border="1">
  <tr>
    <th width="15%" scope="col">&nbsp;<a href="<?php printf("%s?pageNum_tablapersona=%d%s", $currentPage, max(0, $pageNum_tablapersona - 1), $queryString_tablapersona); ?>">Anterior</a></th>
    <th width="67%" scope="col">&nbsp;
Registros <?php echo ($startRow_tablapersona + 1) ?> a <?php echo min($startRow_tablapersona + $maxRows_tablapersona, $totalRows_tablapersona) ?> de <?php echo $totalRows_tablapersona ?> </th>
    <th width="18%" scope="col">&nbsp;<a href="<?php printf("%s?pageNum_tablapersona=%d%s", $currentPage, min($totalPages_tablapersona, $pageNum_tablapersona + 1), $queryString_tablapersona); ?>">Siguiente</a></th>
  </tr>
</table>

<p>&nbsp; </p>
<script type="text/javascript">
function editar() {
	var respuesta = confirm("seguro que deseas editar este usuario?");
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
<?php
mysql_free_result($tablapersona);

mysql_free_result($conexion);
?>
