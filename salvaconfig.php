<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
protegePagina();
date_default_timezone_set("UTC");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$t_hora1 = $_POST["t_hora1"];
$t_hora2 = $_POST["t_hora2"];
$t_hora3 = $_POST["t_hora3"];

$altera = "UPDATE `aerocontrol`.`aeroporto` SET `hora1` = '$t_hora1', `hora2` = '$t_hora2', `hora3` = '$t_hora3' WHERE `aeroporto`.`id` = 1";

//echo $altera;
$resultado = mysql_query($altera) or die(mysql_error());
header('location: config.php');
?>
</body>
</html>