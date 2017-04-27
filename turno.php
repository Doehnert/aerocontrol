<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="includes/estilos.css" />
<style type="text/css">
.vermelho {
	color: #F00;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Historico</title>
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
<span class="fonte">
<div id="turno">
<?php


$id_aeroporto = 1; //afonso pena
// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('Brazil/East');
//echo $date;

$turno = 0;
$datahora_agora = date("Y-m-d H:i:s");
// 1) 07:00 - 14:00
// 2) 14:00 - 21:00
// 3) 21:00 - 24:00 , 00:00 - 07:00

$consulta = "select hora1, hora2, hora3 from aeroporto where id = $id_aeroporto";
$resultado = mysql_query($consulta) or die(mysql_error());


$hora1 = mysql_result($resultado,0,"hora1");
$hora2 = mysql_result($resultado,0,"hora2");
$hora3 = mysql_result($resultado,0,"hora3");

$date = date("Y-m-d");
$hora = date("H:i:s");

$datahora1 = $date." ".$hora1;
$datahora2 = $date." ".$hora2;
$datahora3 = $date." ".$hora3;

$aux = strtotime($datahora1)+(3600*24);
$datahora4 = date("Y-m-d H:i:s", $aux);

/*echo "<br/>$datahora1";
echo "<br/>$datahora2";
echo "<br/>$datahora3";*/
$flag_maior24 = 0;
if($hora3<$hora1)
{
	$aux = strtotime($datahora3)+(3600*24);
	$datahora3 = date("Y-m-d H:i:s", $aux);
	$flag_maior24 = 1;
}

if((strtotime($datahora_agora)<strtotime($datahora3)) and (strtotime($datahora_agora)>strtotime($datahora2)))
{
	$turno = 2; //tarde
}
else if((strtotime($datahora_agora)<strtotime($datahora2)) and (strtotime($datahora_agora)>strtotime($datahora1)))
{
	$turno = 1; //manha
}
else
{
	$turno = 3; //pernoite
}

if($hora<$hora1)
{
	$aux = strtotime($datahora3)-(3600*24);
	$datahora3 = date("Y-m-d H:i:s", $aux);
}

/*$horario1 = strtotime("1/1/1980 24:00:00");
$horario2 = strtotime("1/1/1980 01:00:00");
$res = $horario1+$horario2;
$hora3=date("H:i:s", $res);*/
//echo $hora3;

//echo "1- ".$hora1." 2- ".$hora2." 3- ".$hora3;


/*$dt3_pernoite = $datahora3;
$dt1_pernoite = $datahora1;
$flag_maior24 = 0;
if($hora>$hora1 and $hora<$hora2)
{
	$turno = 1;
}
else if($hora3<$hora1) //turno 3 começa depois de 23:59:00
{
	$flag_maior24 = 1;
	if($hora<$hora1)
	{
		$turno = 3;
	}
	else
	{
		$turno = 2;
	}
}
else
{
	if($hora<$hora3 and $hora>$hora2) //turno 3 começa antes de 23:59:00
	{
		$turno = 2;
	}
	else if($hora<$hora2)
	{
		$turno = 1;
	}
	else
	{
		$turno = 3;
		if($hora<$hora1)
		{
			$aux = strtotime($datahora3)-(3600*24);
			$dt3_pernoite = date("Y-m-d H:i:s", $aux);
		}
		else
		{
			$aux = strtotime($datahora1)+(3600*24);
			$dt1_pernoite = date("Y-m-d H:i:s", $aux);
		}
	}
}

if($flag_maior24 == 1) //nesse caso o turno da noite comeca depois de 24:00 UTC entao adiciona 1 dia na datahora3
{
	$aux = strtotime($datahora3)+(3600*24);
	$datahora3 = date("Y-m-d H:i:s", $aux);
}*/

$nometurno = "";
echo "<br />";
switch($turno)
{
	case 1:
		$nometurno = "Manhã";
		break;
	case 2:
		$nometurno = "Tarde";
		break;
	case 3:
		$nometurno = "Pernoite";
		break;
}

echo "<b>Turno:</b> ".$nometurno . "<br />";
echo "<b>Data - Hora(UTC):</b> ". $datahora_agora . "<br />";
echo "<br />";

switch($turno)
{
	case 1:
		$consulta = "SELECT * FROM `altera_aeroporto` WHERE `datahora` > '$datahora1' ORDER BY `datahora` DESC";
		break;
	case 2:
		$consulta = "SELECT * FROM `altera_aeroporto` WHERE `datahora` > '$datahora2' ORDER BY `datahora` DESC";
		break;
	case 3:
		$consulta = "SELECT * FROM `altera_aeroporto` WHERE `datahora` > '$datahora3' ORDER BY `datahora` DESC";
		break;
}

//echo $consulta;
		

echo "<table align='center' width='460' border='1'>";
echo "<tr>";
echo "<td colspan='10'>Condições Aeroporto</td>";
echo "</tr>";
echo "<tr>";
echo "<th width='15' scope='col'>Usuario</th>";
echo "<th width='15' scope='col'>Data - Hora</th>";
echo "<th width='15' scope='col'>Teto</th>";
echo "<th width='15' scope='col'>Visibilidade</th>";
echo "<th width='15' scope='col'>Operacionalidade</th>";
echo "<th width='15' scope='col'>Cat</th>";
echo "<th width='15' scope='col'>Baixa Visibilidade</th>";
echo "<th width='15' scope='col'>Placoar</th>";
echo "<th width='282' scope='col'>Procedimento em uso</th>";
//echo "<th width='282' scope='col'>Atis</th>";
echo "</tr>";

$resultado = mysql_query($consulta);
$cont = mysql_num_rows($resultado);
//$count = 0;
while ($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
//	$tempo = $linha['time'];
	$tetoanterior = $linha['teto'];
	$atis = $linha['atis'];
	$visianterior = $linha["visibilidade"];
	$opanterior = $linha["operacionalidade"];
	$procanterior = $linha["procedimento_id"];
	if($cont>1)
	{
		$consultaanterior = "SELECT * FROM `altera_aeroporto` WHERE `datahora` < '$datahora' order by `datahora` desc limit 1";
		$resultadoanterior = mysql_query($consultaanterior) or die(mysql_error());
		$tetoanterior = mysql_result($resultadoanterior,0,"teto");
		$visianterior = mysql_result($resultadoanterior,0,"visibilidade");
		$opanterior = mysql_result($resultadoanterior,0,"operacionalidade");
		$catanterior = mysql_result($resultadoanterior,0,"cat");
		$procanterior = mysql_result($resultadoanterior,0,"procedimento_id");
	}
	$cont--;
	  echo "<tr>";
  	  echo "<td>";
	  $idusuario = $linha['usuario_id'];
	  $consulta2 = "select nomeguerra from usuario where id = $idusuario";
	  $resultado2 = mysql_query($consulta2);
	  echo mysql_result($resultado2,0,"nomeguerra");
	  echo "</td>";
	  echo "<td>";
	  echo date("d/m/Y H:i:s", strtotime($datahora));
	  echo "</td>";
	  echo "<td>";
/*	  if($count>0 and $linha["teto"]!=$tetotemp)
		  echo "<strong>".$linha["teto"]."</strong>";
	  else*/
	  $teto = $linha['teto'];
	  
	  if($teto!=$tetoanterior)
	  {
		  echo "<span class = 'vermelho'>";
		  echo $teto;
		  echo "</span>";
	  }
	  else
	  {
		  echo $teto;
	  }
	  $tetotemp = $linha["teto"];
	  echo "</td>";
	  echo "<td>";
	  $vis = $linha["visibilidade"];
	  if($vis!=$visianterior)
	  {
		  echo "<span class = 'vermelho'>";
		  echo $vis;
		  echo "</span>";
	  }
	  else
	  {
		  echo $vis;
	  }
	  echo "</td>";
	  echo "<td>";
	  $opera = $linha["operacionalidade"];
	  switch($opera)
	  {
		case 0:
			if($opera!=$opanterior)
			{
				echo "<span class = 'vermelho'>";
			  	echo "VFR";
				echo "</span>";
			}
			else
			{
			  	echo "VFR";
			}
			break;
		case 1:
			if($opera!=$opanterior)
			{
				echo "<span class = 'vermelho'>";
			  	echo "IFR";
				echo "</span>";
			}
			else
			{
			  	echo "IFR";
			}
			break;
		case 2:
			if($opera!=$opanterior)
			{
				echo "<span class = 'vermelho'>";
			  	echo "MA";
				echo "</span>";
			}
			else
			{
			  	echo "MA";
			}
			break;
		case 3:
			if($opera!=$opanterior)
			{
				echo "<span class = 'vermelho'>";
			  	echo "MG";
				echo "</span>";
			}
			else
			{
			  	echo "MG";
			}
			break;
	  }
	  echo "</td>";
	  echo "<td>";
	  $cat = $linha["cat"];
	  switch($cat)
	  {
	  	case 0:
		  	echo "-";
			break;
		case 1:
			echo "CAT1";
			break;
		case 2:
			echo "CAT2";
	  }
	  echo "</td>";
	  echo "<td>";
	  $baixavis = $linha["baixavis"];
	  if($baixavis==1)
	  	$caminho = "imagens/checado.png";
	  else
	  	$caminho = "imagens/naochecado.png";
	  echo ("<img src=".$caminho." width='25px' height='25px'/>");
	  echo "</td>";
	  echo "<td>";
	  $placoar = $linha["placoar"];
	  if($placoar==1)
	  	$caminho = "imagens/checado.png";
	  else
	  	$caminho = "imagens/naochecado.png";
	  echo ("<img src=".$caminho." width='25px' height='25px'/>");
	  echo "</td>";
	  echo "<td>";
	  $idprocedimento = $linha["procedimento_id"];
	  if($idprocedimento!=0)
	  {
		  $consulta2 = "select nome from procedimento where id = $idprocedimento";
		  $resultado2 = mysql_query($consulta2);
		  if($idprocedimento!=$procanterior)
		  {
			  echo "<span class='vermelho'>";
			  echo mysql_result($resultado2,0,"nome");
			  echo "</span>";
		  }
		  else
		  {
			  echo mysql_result($resultado2,0,"nome");
		  }
	  }
	  else
	  {
		  echo "Sem procedimento definido";
	  }
	  echo "</td>";
	  //echo "<td>$atis</td>";
  echo "</tr>";
}
//}
echo "</table>";
echo "<br><br>";

switch($turno)
{
	case 1:
		$consulta = "SELECT * FROM `altera_auxilio` WHERE `datahora` > '$datahora1' ORDER BY `datahora` DESC";
		break;
	case 2:
		$consulta = "SELECT * FROM `altera_auxilio` WHERE `datahora` > '$datahora2' ORDER BY `datahora` DESC";
		break;
	case 3:
		$consulta = "SELECT * FROM `altera_auxilio` WHERE `datahora` > '$datahora3' ORDER BY `datahora` DESC";
		break;
}
//echo $consulta;
$resultado = mysql_query($consulta);
echo "<table align='center' width='460' border='1'>";
echo "<tr>";
echo "<td colspan='5'>Mudanças de auxílios</td>";
echo "</tr>";
echo "<tr>";
echo "<th width='15' scope='col'>Usuário</th>";
echo "<th width='15' scope='col'>Auxilio</th>";
echo "<th width='15' scope='col'>Data - Hora</th>";
echo "<th width='15' scope='col'>Operacionalidade</th>";
echo "</tr>";
/*if ( mysql_fetch_assoc($resultado) == "") {
	echo "<tr>";
	echo "<td colspan='5'><strong>Sem alterações</strong></td>";
	echo "</tr>";
}
else {*/
while ($linha = mysql_fetch_assoc($resultado))
{
  echo "<tr>";
  	  echo "<td>";
	  $idusuario = $linha['usuario_id'];
	  $consulta2 = "select nomeguerra from usuario where id = $idusuario";
	  $resultado2 = mysql_query($consulta2);
	  echo mysql_result($resultado2,0,"nomeguerra");
	  echo "</td>";;
	  echo "<td>";
	  $idauxilio = $linha['auxilio_id'];
	  $consulta2 = "select nome from auxilio where id = $idauxilio";
	  $resultado2 = mysql_query($consulta2);
	  echo mysql_result($resultado2,0,"nome");
	  echo "</td>";
	  echo "<td>";
	  echo date("d/m/Y H:i:s", strtotime($linha["datahora"]));
	  echo "</td>";
	  echo "<td>";
	  $operacional = $linha["operacional"];
	  switch($operacional)
	  {
		  case 0:
		  	$caminho = "imagens/naochecado.png";
			break;
		  case 1:
		  	$caminho = "imagens/checado.png";
			break;
		  case 2:
		  	$caminho = "imagens/indisponivel.png";
			break;
	  }
	  echo ("<img src=".$caminho." width='25px' height='25px'/>");
	  echo "</td>";
  echo "</tr>";
}
//}
echo "</table>";

switch($turno)
{
	case 1:
		$consulta = "SELECT * FROM `altera_pista` WHERE `datahora` > '$datahora1' ORDER BY `datahora` DESC";
		break;
	case 2:
		$consulta = "SELECT * FROM `altera_pista` WHERE `datahora` > '$datahora2' ORDER BY `datahora` DESC";
		break;
	case 3:
		$consulta = "SELECT * FROM `altera_pista` WHERE `datahora` > '$datahora3' ORDER BY `datahora` DESC";
		break;
}
//echo $consulta;
echo "<br><br>";
$resultado = mysql_query($consulta);
echo "<table align='center' width='460' border='1'>";
echo "<tr>";
echo "<td colspan='6'>Mudanças de pistas</td>";
echo "</tr>";
echo "<tr>";
echo "<th width='15' scope='col'>Usuário</th>";
echo "<th width='15' scope='col'>Pista</th>";
echo "<th width='15' scope='col'>Data - Hora</th>";
echo "<th width='15' scope='col'>Operacionalidade</th>";
echo "<th width='15' scope='col'>Praticabilidade</th>";
echo "</tr>";

while ($linha = mysql_fetch_assoc($resultado))
{
  echo "<tr>";
  	  echo "<td>";
	  $idusuario = $linha['usuario_id'];
	  $consulta2 = "select nomeguerra from usuario where id = $idusuario";
	  $resultado2 = mysql_query($consulta2);
	  echo mysql_result($resultado2,0,"nomeguerra");
	  echo "</td>";
	  echo "<td>";
  	  $idpista = $linha['pista_id'];
	  $consulta2 = "select nome from pista where id = $idpista";
	  $resultado2 = mysql_query($consulta2);
	  echo mysql_result($resultado2,0,"nome");
	  echo "</td>";
	  echo "<td>";
	  echo date("d/m/Y H:i:s", strtotime($linha["datahora"]));
	  echo "</td>";
	  echo "<td>";
	  $operacional = $linha["operacional"];
	  if($operacional==1)
	  	$caminho = "imagens/checado.png";
	  else
	  	$caminho = "imagens/naochecado.png";
	  echo ("<img src=".$caminho." width='25px' height='25px'/>");
	  
	  echo "<td>";
  	  $praticavel = $linha["praticavel"];
	  if($praticavel==1)
	  	$caminho = "imagens/checado.png";
	  else
	  	$caminho = "imagens/naochecado.png";
	  echo ("<img src=".$caminho." width='25px' height='25px'/>");
	  echo "</td>";
	  
  echo "</tr>";
}
//}
echo "</table>";
echo "<br />";
?>
</div>
</span>
</div>
</span>
</html>