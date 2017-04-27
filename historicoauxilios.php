<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="includes/estilos.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina();
$id_aeroporto = 1; //afonso pena

$usuario = $_SESSION['usuario'];
$org = $_SESSION['org'];
?>
<?php require_once('menu.php'); ?>
<?php
$mydate2 = $_POST["mydate2"];

//$date = str_replace('/', '-', $mydate);
$var = date('Y-m-d', strtotime($mydate2));
$datahora = $var." 00:00:00";
?>
<div id="tabela_historico_auxilios">
<p>&nbsp;</p>
<table width="378" border="1" align="center">
  <tr>
    <td width="166"><strong>Auxilio
    </strong>
    <td width="152"><strong>Numero de erros
  </strong>    </tr>
  <tr>
    <td>Loc15 </td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=1 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>GL15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=2 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>LOC 33</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=3 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>GL 33</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=4 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>ALS 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=5 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>FLASH 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=6 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>THR 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=7 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>TDZ 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=8 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>RCL</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=9 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>BLZ 15/33</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=10 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>BLZ 11/29</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=11 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>BLZ TWY</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=12 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>OM 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=13 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>MM 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=14 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>IM 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=15 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>OM 33</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=16 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>MM 33</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=17 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>IM 33</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=18 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>VOR</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=19 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>DME</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=20 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>RVR 15</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=21 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>RVR MEDIO</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=22 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>RVR 33</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=23 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
  <tr>
    <td>RADAR</td>
    <td><?php
	$consulta = "select * from altera_auxilio where auxilio_id=24 and operacional = 0 and datahora >= '$datahora'";
	$resultado = mysql_query($consulta);
	$numerros = mysql_num_rows($resultado);
	echo $numerros;
	?></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
</body>
</html>