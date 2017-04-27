<?php
// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('UTC');
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<link rel='stylesheet' type='text/css' href='includes/estilos.css'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Configurações</title>
<script type="text/javascript" src="relogio/timepicker/jquery.min.js"></script>
<script type="text/javascript" src="relogio/timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/jquery.timepicker.css" />
<script type="text/javascript" src="relogio/timepicker/lib/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/lib/bootstrap-datepicker.css" />
<script type="text/javascript" src="relogio/timepicker/lib/site_timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/lib/site_timepicker.css" />
</head>

<body>
<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina();
$id_aeroporto = 1; //afonso pena

$usuario = $_SESSION['usuario'];
$org = $_SESSION['org'];
if($org=="Infraero")
{
	expulsaVisitante();
}
$consultaorg = "select organizacao from usuario where usuario = '$usuario'";
$resultadoorg = mysql_query($consultaorg);
$organizacao = mysql_result($resultadoorg,0,"organizacao");
?>
<?php require_once('menu.php'); ?>
<form id='form1' name='form1' method='post' action='salvaconfig.php'>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <?php
$id_aeroporto = 1; //afonso pena
$consulta = "select hora1, hora2, hora3 from aeroporto where id = $id_aeroporto";
$resultado = mysql_query($consulta) or die(mysql_error());
$hora1 = mysql_result($resultado,0,'hora1');
$hora2 = mysql_result($resultado,0,'hora2');
$hora3 = mysql_result($resultado,0,'hora3');

echo ("
<p align='center' class='titulos'>Configurações horario (Horário Legal de Brasília)</p>
<table width='355' border='1' align='center'>
  <tr>
    <td width='199' class='fonte'>Horario de inicio turno 1</td>
    <td width='140'><label for='t_hora1'></label>
	
	<p><input id='t_hora1' name='t_hora1' value='$hora1' type='text' class='time' /></p>
            </div>
            <script>
                $(function() {
					
					$('#t_hora1').timepicker({ 
							'step': 15,
							'timeFormat': 'H:i:s'
							 });
				});
            </script>
      </td>
  </tr>
  <tr>
    <td class='fonte'>Horario de inicio turno 2</td>
    <td><label for='t_hora2'></label>
	  <p><input id='t_hora2' name='t_hora2' value='$hora2' type='text' class='time' /></p>
            </div>
            <script>
                $(function() {
					
					$('#t_hora2').timepicker({ 
							'step': 15,
							'timeFormat': 'H:i:s'
							 });
				});
             </script>
	  </td>
  </tr>
  <tr>
    <td class='fonte'>Horario de inicio turno 3</td>
    <td><label for='t_hora3'></label>
  	  <p><input id='t_hora3' name='t_hora3' value='$hora3' type='text' class='time' /></p>
          </div>
            <script>
                $(function() {
					
					$('#t_hora3').timepicker({ 
							'step': 15,
							'timeFormat': 'H:i:s'
							 });
				});
            </script>
	  </td>
  </tr>
</table>
<p align='center'>
  <input type='submit' name='button' id='button' value='Salvar' />
</p>
");
?>
</form>
</div>
</body>
</html>