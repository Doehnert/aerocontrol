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
date_default_timezone_set("UTC");
$id_aeroporto = 1; //afonso pena

$usuario = $_SESSION['usuario'];
$org = $_SESSION['org'];
?>
<?php require_once('menu.php'); ?>
<div id="tabela_tempominimos">
<p>&nbsp;</p>
<div id="resultado_abaixominimos">
<?php

/*function dif_horario($horario1, $horario2)
{
	$horario1 = strtotime("1/1/1980 $horario1");
	$horario2 = strtotime("1/1/1980 $horario2");
	if ($horario2 < $horario1)
	{
		$horario2 = $horario2 + 86400;
	}
	return ($horario2 - $horario1) / 3600;
}
function dif_horario_min($horario1, $horario2)
{
	$horario1 = strtotime("1/1/1980 $horario1");
	$horario2 = strtotime("1/1/1980 $horario2");
	if ($horario2 < $horario1)
	{
		$horario2 = $horario2 + 86400;
	}
	return (($horario2 - $horario1) % 3600) / 60;
}



$abaixo_minimos = $_POST["abaixo_minimos"];
$date = strtotime($abaixo_minimos);
//$date = str_replace('/', '-', $mydate);
$var = date('Y-m-d', $date);
//echo $var;

$indice = 0;
$consulta = "SELECT * FROM `altera_aeroporto` WHERE `aeroporto_id` = 1 AND `date` >= '$var' ORDER BY `date` ASC";
echo $consulta;
$resultado = mysql_query($consulta) or die("Erro consultando altera_aeroporto");
$numlinhas = mysql_num_rows($resultado);
$tempo = 0;
$dias = 0;
$horas = 0;
$diferenca_hora = 0;
$diferenca_min = 0;

if($numlinhas>0)
{
	for($indice=0;$indice<$numlinhas;$indice++)
	{
		$oper = mysql_result($resultado, $indice, "operacionalidade");
		if($oper>1) //quando achar resultado abaixo dos minimos pra pouso
		{
			$dataatual = mysql_result($resultado, $indice, "date");
			$timedataatual = strtotime($dataatual);
			$horaatual = mysql_result($resultado, $indice, "time");
			for($indice2=$indice;$indice2<$numlinhas;$indice2++)
			{
				//achar o proximo resultado com operacionalidade<2
				$oper2 = mysql_result($resultado, $indice2, "operacionalidade");
				if($oper2<2)
				{
					$dataanterior = mysql_result($resultado,($indice2),"date");
					$timedataanterior = strtotime($dataanterior);
					$horaanterior = mysql_result($resultado, $indice2, "time");
					$diferenca = $timedataanterior - $timedataatual;
					$diferenca_hora += dif_horario($horaatual, $horaanterior);
					$diferenca_min += dif_horario_min($horaatual, $horaanterior);
					$dias += (int)floor($diferenca/(60*60*24));
					break;
				}
			}
		}
	}
}



while($diferenca_min>60)
{
	$diferenca_hora++;
	$diferenca_min-=60;
}
while($diferenca_hora>24)
{
	$dias++;
	$diferenca_hora-=24;
}
$horaint = floor($diferenca_hora);
$horafrac = $diferenca_hora - $horaint;
$diferenca_min+=$horafrac*60;
while($diferenca_min>60)
{
	$diferenca_hora++;
	$diferenca_min-=60;
}

echo $dias." Dias, ";
echo $horaint." horas e ";
echo round($diferenca_min,0)." minutos";*/


function imprimetempo($diferencaseg)
{
	$diferenca_seg = $diferencaseg;
	$diferenca_min = 0;
	$diferenca_hora = 0;
	$dias = 0;
	while($diferenca_seg>60)
	{
		$diferenca_min++;
		$diferenca_seg-=60;
	}
	while($diferenca_min>60)
	{
		$diferenca_hora++;
		$diferenca_min-=60;
	}
	while($diferenca_hora>24)
	{
		$dias++;
		$diferenca_hora-=24;
	}
	$horaint = floor($diferenca_hora);
	$horafrac = $diferenca_hora - $horaint;
	$diferenca_min+=$horafrac*60;
	while($diferenca_min>60)
	{
		$diferenca_hora++;
		$diferenca_min-=60;
	}
	echo $dias." Dias, ";
	echo $horaint." horas, ";
	echo round($diferenca_min,0)." minutos e ";
	echo round($diferenca_seg,0)." segundos";
}

$abaixo_minimos = $_POST["abaixo_minimos"];
$date = strtotime($abaixo_minimos);
//$date = str_replace('/', '-', $mydate);
$var = date('Y-m-d', $date);
$datahorauser = $var." 00:00:00";
$datahora_agora = date("Y-m-d H:i:s");

$consulta = "select operacionalidade from aeroporto where id=1";
$resultado = mysql_query($consulta) or die(mysql_error());
$operacionalidade_agora = mysql_result($resultado,0,"operacionalidade");


//verifica primeira parte do tempo
$consulta = "select * from altera_aeroporto where datahora < '$datahorauser' order by datahora desc limit 1";
$resultado = mysql_query($consulta);
if(mysql_num_rows($resultado)>0)
{
	$operacionalidade_ant = mysql_result($resultado,0,"operacionalidade");
	if($operacionalidade_ant > 1)
	{
		$consulta2 = "select * from altera_aeroporto where datahora > '$datahorauser' order by datahora asc limit 1";
		//echo $consulta2;
		$resultado2 = mysql_query($consulta2);
		if(mysql_num_rows($resultado2)>0)
		{
			$datahora_prox = mysql_result($resultado2,0,"datahora");
			$operacionalidade_prox = mysql_result($resultado2,0,"operacionalidade");
			if(strtotime($datahora_prox)<strtotime($datahorauser2))
			{
				$total_seg += strtotime($datahora_prox)-strtotime($datahorauser1);
			}
		}
	}
}


////////TEMPO MA e MG///////////
$total_seg = 0;
$consulta = "select * from altera_aeroporto where aeroporto_id=1 and operacionalidade>1 and datahora>'$datahorauser' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
//	$consulta2 = "select * from altera_aeroporto where aeroporto_id=1 and operacionalidade<2 and datahora>'$datahora' order by datahora asc limit 1";
	$consulta2 = "select * from altera_aeroporto where aeroporto_id=1 and datahora>'$datahora' order by datahora asc limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
	//echo $consulta2;
	//echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		//$operacionalidade_prox = mysql_result($resultado2,0,"operacionalidade");
		//if($operacionalidade_prox<2)
		//{
			$datahora_prox = mysql_result($resultado2,0,"datahora");
			$total_seg += strtotime($datahora_prox)-strtotime($datahora);
		//}
	}
}

//se o aeroporto esta MG ou MA agora
if ($operacionalidade_agora>1)
{
	//encontra ultimo registro colocando o aeroporto em MG ou MA
	$consulta = "select * from altera_aeroporto where aeroporto_id = 1 and operacionalidade>1 order by datahora desc limit 1";
	$resultado = mysql_query($consulta) or die(mysql_error());
	if(mysql_num_rows($resultado)>0)
	{
		$datahora_ultimo = mysql_result($resultado,0,"datahora");
		$total_seg += strtotime($datahora_agora)-strtotime($datahora_ultimo);
	}
}

echo "Tempo abaixo dos minimos para pouso: <br/>";
imprimetempo($total_seg);
?>
</div>
</div>
</body>
</html>