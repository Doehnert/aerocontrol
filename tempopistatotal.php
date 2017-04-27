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
$consultaorg = "select organizacao from usuario where usuario = '$usuario'";
$resultadoorg = mysql_query($consultaorg);
$organizacao = mysql_result($resultadoorg,0,"organizacao");
?>
<div id="tudo">
<div id="topo">
<img src="imagens/topo_fundo.jpg" width="1366" height="200" />
</div>
<div id="menu">
<div class="drop">
<ul class="drop_menu">
<li><a href='#'>Início</a></li>
<li><a href='#'>Cadastrar</a>
	<ul>
		<li><a href='principal.php'>Condições Atuais</a></li>
    </ul>
</li>
<li><a href='#'>Visualizar</a>
	<ul>
		<li><a href='#'>Condições Atuais</a></li>
        <li><a href="galeria/slideshow/banner.php" target="_blank">Banner Rotativo</a></li>
    </ul>
</li>
<li><a href='#'>Relatórios</a>
	<ul>
	<li><a href='turno.php'>Turno Atual</a></li>
	<li><a href='relatorio.php'>Tempo Abaixo dos Mínimos</a></li>
	<li><a href='relatorio.php'>Histórico de Mudanças</a></li>
	<li><a href='relatorio.php'>Erros de Auxílios</a></li>
	</ul>
</li>
<li><a href='#'>Configurações</a>
	<ul>
    <li><a href="config.php">Alterar Turnos</a></li>
    </ul>
</li>
</ul>
</div>
<div id="logout">Bem vindo,<?php echo $usuario ?> | <a href="logout.php">Sair</a></div>
</div>
<div id="tabela_tempominimos">
<p>&nbsp;</p>
<div id="resultado_abaixominimos">
<p>Tempo de uso de cada pista: </p>
<?php
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

//$tempopista = $_POST["mydate3"];

/*$date = strtotime($tempopista);
$var = date('Y-m-d', $date);
$datahorauser = $var." 00:00:00";*/
$datahora_agora = date("Y-m-d H:i:s");

$consulta = "select * from pista";
$resultado = mysql_query($consulta) or die(mysql_error());
$tempo15 = mysql_result($resultado,0,"tempo_uso");
$tempo33 = mysql_result($resultado,1,"tempo_uso");
$tempo11 = mysql_result($resultado,2,"tempo_uso");
$tempo29 = mysql_result($resultado,3,"tempo_uso");

$ultimo15 = mysql_result($resultado,0,"ultimo_uso");
$ultimo33 = mysql_result($resultado,1,"ultimo_uso");
$ultimo11 = mysql_result($resultado,2,"ultimo_uso");
$ultimo29 = mysql_result($resultado,3,"ultimo_uso");

$consulta = "select * from pista where operacional = 1";
$resultado = mysql_query($consulta) or die(mysql_error());
$id_pista = mysql_result($resultado,0,"id");
switch($id_pista)
{
	case 1:
		$consulta = "select * from altera_pista where pista_id = 1 and operacional = 1 order by date desc, time desc limit 1";
		$resultado = mysql_query($consulta) or die(mysql_error());
		$data = mysql_result($resultado,0,"date");
		$hora = mysql_result($resultado,0,"time");
		$datahora = $data." ".$hora;
		
		$diff = strtotime($datahora_agora)-strtotime($datahora);
		$tempo15+=$diff;
		break;
	case 2:
		$consulta = "select * from altera_pista where pista_id = 2 and operacional = 1 order by date desc, time desc limit 1";
		$resultado = mysql_query($consulta) or die(mysql_error());
		$data = mysql_result($resultado,0,"date");
		$hora = mysql_result($resultado,0,"time");
		$datahora = $data." ".$hora;
		
		$diff = strtotime($datahora_agora)-strtotime($datahora);
		$tempo33+=$diff;
		break;
	case 3:
		$consulta = "select * from altera_pista where pista_id = 3 and operacional = 1 order by date desc, time desc limit 1";
		$resultado = mysql_query($consulta) or die(mysql_error());
		$data = mysql_result($resultado,0,"date");
		$hora = mysql_result($resultado,0,"time");
		$datahora = $data." ".$hora;
		
		$diff = strtotime($datahora_agora)-strtotime($datahora);
		$tempo11+=$diff;
		break;
	case 4:
		$consulta = "select * from altera_pista where pista_id = 4 and operacional = 1 order by date desc, time desc limit 1";
		$resultado = mysql_query($consulta) or die(mysql_error());
		$data = mysql_result($resultado,0,"date");
		$hora = mysql_result($resultado,0,"time");
		$datahora = $data." ".$hora;
		
		$diff = strtotime($datahora_agora)-strtotime($datahora);
		$tempo29+=$diff;
		break;
}
		
//$diferenca_min = $tempo15/60;
imprimetempo($tempo15);
echo "<br/>";
imprimetempo($tempo33);
echo "<br/>";
imprimetempo($tempo11);
echo "<br/>";
imprimetempo($tempo29);
?>
</div>
</div>
</body>
</html>