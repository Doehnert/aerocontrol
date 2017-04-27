<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
protegePagina();
date_default_timezone_set("UTC");
$dia = date('d/m/Y');
$hora = date('H:i:s');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="includes/estilos.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>aerocontrol</title>
</head>

<body onLoad="JavaScript:AutoRefresh(600000);">
<?php
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
<li><a href='principal.php'>Início</a></li>
<li><a href='#'>Cadastrar</a>
	<ul>
		<li><a href='principal.php'>Condições Atuais</a></li>
    </ul>
</li>
<li><a href='#'>Visualizar</a>
	<ul>
		<li><a href='visualizar.php'>Condições Atuais</a></li>
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

$auxilio = $_GET["aux"];
$datahora_agora = date("Y-m-d H:i:s");
$consulta = "select * from altera_auxilio where auxilio_id = '$auxilio' and operacional = 0";
$resultado = mysql_query($consulta);
$numerros = mysql_num_rows($resultado);

$consultaauxilio = "select nome from auxilio where id = '$auxilio'";
$result_auxilio = mysql_query($consultaauxilio);
$nomeauxilio = mysql_result($result_auxilio, 0, "nome");

echo "<br>";
echo "<br>";
echo "<div id='titulo_erros'>";
echo "<p>Relatório de Erros do Auxílio " . $nomeauxilio . " gerado em " . $dia . " às " . $hora . " (UTC)<br /><br />";
echo "Total de erros do auxilio: ".$numerros. "<br />";

////////AUXILIO///////////
$total_seg = 0;
$consulta = "select * from altera_auxilio where auxilio_id=$auxilio and operacional = 0 order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_auxilio where auxilio_id=$auxilio and operacional = 1 and datahora>'$datahora' order by datahora asc limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
	//echo $consulta2;
	//echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$resultado2 = mysql_query($consulta2) or die(mysql_error());
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}

$consulta = "select operacional from auxilio where id = $auxilio";
$resultado = mysql_query($consulta) or die(mysql_error());
$estado_auxilio_atual = mysql_result($resultado,0,"operacional");

//se o auxilio estiver em erro
if ($estado_auxilio_atual==0)
{
	//encontra ultimo registro colocando o auxilio em erro
	$consulta = "select * from altera_auxilio where auxilio_id=$auxilio and operacional = 0 order by datahora desc limit 1";
	$resultado = mysql_query($consulta) or die(mysql_error());
	if(mysql_num_rows($resultado)>0)
	{
		$datahora_ultimo = mysql_result($resultado,0,"datahora");
		$total_seg += strtotime($datahora_agora)-strtotime($datahora_ultimo);
	}
}

echo "Tempo total em estado de erro: ";
imprimetempo($total_seg);

$consulta = "select * from altera_auxilio where auxilio_id = '$auxilio' ORDER BY `altera_auxilio`.`datahora` DESC";
$resultado = mysql_query($consulta);
echo "<div id='tabela_erros'>";
echo "<table width='200' border='1' align='center'>";
		echo "<tr>";
		echo "<td>";
		echo "Usuario";
		echo "</td>";
		
		echo "<td>";
		echo "Data - Hora";
		echo "</td>";
		
		echo "<td>";
		echo "Estado";
		echo "</td>";
	
		echo "<td>";
		echo "Observação";
		echo "</td>";
	
	echo "</tr>";
while($linha = mysql_fetch_assoc($resultado))
{

	echo "<tr>";
		echo "<td>";
		$iduser = $linha["usuario_id"];
		$consulta2 = "select nomeguerra from usuario where id = '$iduser'";
		$resultado2 = mysql_query($consulta2);
		$nomeuser = mysql_result($resultado2,0,"nomeguerra");
		echo $nomeuser;
		echo "</td>";
		
		echo "<td>";
		echo date("d/m/Y H:i:s", strtotime($linha["datahora"]));
		echo "</td>";
	
		echo "<td>";
		$opr = $linha["operacional"];
		switch($opr)
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
	
		echo "<td>";
		echo $linha["obs"];
		echo "</td>";
	
	echo "</tr>";
}
echo "</table>";
echo "</div>";
?>
</p>
</div>
</body>
</html>