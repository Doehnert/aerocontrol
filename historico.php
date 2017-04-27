<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="includes/estilos.css" />
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
<div id="tabela_historico_mudancas">
<p>&nbsp;</p>
<?php

$mydate = $_POST["mydate"];

//$date = str_replace('/', '-', $mydate);
$var = date('Y-m-d', strtotime($mydate));
$datahora = $var." 00:00:00";

$consulta = "select * from altera_aeroporto where datahora >= '$datahora'  ORDER BY `altera_aeroporto`.`datahora` DESC";
//echo $consulta;
$resultado = mysql_query($consulta);

echo "<table align='center' width='460' border='1'>";
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
	  echo date("d/m/Y H:i:s", strtotime($linha["datahora"]));
	  echo "</td>";
	  echo "<td>";
	  echo $linha["teto"];
	  echo "</td>";
	  echo "<td>";
	  echo $linha["visibilidade"];
	  echo "</td>";
	  echo "<td>";
	  $opera = $linha["operacionalidade"];
	  switch($opera)
	  {
		case 0:
		  	echo "VFR";
			break;
		case 1:
			echo "IFR";
			break;
		case 2:
			echo "MA";
			break;
		case 3:
			echo "MD";
			break;
	  }
	  echo "</td>";
	  echo "<td>";
	  $cat = $linha["cat"];
/*	  if($cat==1)
	  	$caminho = "imagens/checado.png";
	  else
	  	$caminho = "imagens/naochecado.png";
	  echo ("<img src=".$caminho." width='25px' height='25px'/>");	*/
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
		  echo mysql_result($resultado2,0,"nome");
	  }
	  else
	  {
		  echo "Sem procedimento definido";
	  }
	  echo "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br />";	

$consulta = "select * from altera_auxilio where datahora >= '$datahora' ORDER BY `altera_auxilio`.`datahora` DESC";
$resultado = mysql_query($consulta);

echo "<table align='center' width='460' border='1'>";
echo "<tr>";
echo "<th width='15' scope='col'>Usuário</th>";
echo "<th width='15' scope='col'>Auxilio</th>";
echo "<th width='15' scope='col'>Data - Hora</th>";
echo "<th width='15' scope='col'>Operacionalidade</th>";
echo "</tr>";
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
	  echo $linha["datahora"];
	  echo "</td>";
	  echo "<td>";
	  $operacional = $linha["operacional"];
	  if($operacional==1)
	  	$caminho = "imagens/checado.png";
	  else
	  	$caminho = "imagens/naochecado.png";
	  echo ("<img src=".$caminho." width='25px' height='25px'/>");
	  echo "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br />";

$consulta = "select * from altera_pista where datahora >= '$datahora' ORDER BY `altera_pista`.`datahora` DESC";
$resultado = mysql_query($consulta);

echo "<table align='center' width='460' border='1'>";
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
	  echo "</td>";
	  
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
echo "</table>";
?>
</div>
</span>
<p>&nbsp;</p>
</body>
</html>