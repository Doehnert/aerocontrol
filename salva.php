<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina();

date_default_timezone_set("UTC");
$usuario_id = $_SESSION['usuarioID'];
$aeroporto_id = 1;  //aeroporto afonso pena
$date = date('Y/m/d');
$time = date('H:i:s');
$datahora = date("Y-m-d H:i:s");

$consulta = "SELECT operacional FROM auxilio";
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
$loc15 = mysql_result($resultado, 0, "operacional");
$gl15 = mysql_result($resultado, 1, "operacional");
$loc33 = mysql_result($resultado, 2, "operacional");
$gl33 = mysql_result($resultado, 3, "operacional");
$als15 = mysql_result($resultado, 4, "operacional");
$flash15 = mysql_result($resultado, 5, "operacional");
$thr15 = mysql_result($resultado, 6, "operacional");
$tdz15 = mysql_result($resultado, 7, "operacional");
$rcl = mysql_result($resultado, 8, "operacional");
$blz1533 = mysql_result($resultado, 9, "operacional");
$blz1129 = mysql_result($resultado, 10, "operacional");
$blztwy = mysql_result($resultado, 11, "operacional");
$om15 = mysql_result($resultado, 12, "operacional");
$mm15 = mysql_result($resultado, 13, "operacional");
$im15 = mysql_result($resultado, 14, "operacional");
$om33 = mysql_result($resultado, 15, "operacional");
$mm33 = mysql_result($resultado, 16, "operacional");
$im33 = mysql_result($resultado, 17, "operacional");
$vor = mysql_result($resultado, 18, "operacional");
$dme = mysql_result($resultado, 19, "operacional");
$rvr15 = mysql_result($resultado, 20, "operacional");
$rvrmedio = mysql_result($resultado, 21, "operacional");
$rvr33 = mysql_result($resultado, 22, "operacional");
$radar = mysql_result($resultado, 23, "operacional");

//recebe dados do formulario

$consulta = "SELECT * FROM pista";
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta a tabela pista");
$pista15 = mysql_result($resultado, 0, "operacional");
$pista33 = mysql_result($resultado, 1, "operacional");
$pista11 = mysql_result($resultado, 2, "operacional");
$pista29 = mysql_result($resultado, 3, "operacional");

$prat_pista15 = mysql_result($resultado, 0, "praticavel");
$prat_pista33 = mysql_result($resultado, 1, "praticavel");
$prat_pista11 = mysql_result($resultado, 2, "praticavel");
$prat_pista29 = mysql_result($resultado, 3, "praticavel");

$r_loc15 = $_POST["r_loc15"];
$r_gl15 = $_POST["r_gl15"];
$r_loc33 = $_POST["r_loc33"];
$r_gl33 = $_POST["r_gl33"];
$r_als15 = $_POST["r_als15"];
$r_flash15 = $_POST["r_flash15"];
$r_thr15 = $_POST["r_thr15"];
$r_tdz15 = $_POST["r_tdz15"];
$r_rcl = $_POST["r_rcl"];
$r_blz1533 = $_POST["r_blz1533"];
$r_blz1129 = $_POST["r_blz1129"];
$r_blztwy = $_POST["r_blztwy"];
$r_om15 = $_POST["r_om15"];
$r_mm15 = $_POST["r_mm15"];
$r_im15 = $_POST["r_im15"];
$r_om33 = $_POST["r_om33"];
$r_mm33 = $_POST["r_mm33"];
$r_im33 = $_POST["r_im33"];
$r_vor = $_POST["r_vor"];
$r_dme = $_POST["r_dme"];
$r_rvr15 = $_POST["r_rvr15"];
$r_rvrmedio = $_POST["r_rvrmedio"];
$r_rvr33 = $_POST["r_rvr33"];
$r_radar = $_POST["r_radar"];

$r_procid = $_POST["r_procid"];

$t_obsloc15 = $_POST["t_obsloc15"];
$t_obsgl15 = $_POST["t_obsgl15"];
$t_obsloc33 = $_POST["t_obsloc33"];
$t_obsgl33 = $_POST["t_obsgl33"];
$t_obsals15 = $_POST["t_obsals15"];
$t_obsflash15 = $_POST["t_obsflash15"];
$t_obsthr15 = $_POST["t_obsthr15"];
$t_obstdz15 = $_POST["t_obstdz15"];
$t_obsrcl = $_POST["t_obsrcl"];
$t_obsblz1533 = $_POST["t_obsblz1533"];
$t_obsblz1129 = $_POST["t_obsblz1129"];
$t_obsblztwy = $_POST["t_obsblztwy"];
$t_obsom15 = $_POST["t_obsom15"];
$t_obsmm15 = $_POST["t_obsmm15"];
$t_obsim15 = $_POST["t_obsim15"];
$t_obsom33 = $_POST["t_obsom33"];
$t_obsmm33 = $_POST["t_obsmm33"];
$t_obsim33 = $_POST["t_obsim33"];
$t_obsvor = $_POST["t_obsvor"];
$t_obsdme = $_POST["t_obsdme"];
$t_obsrvr15 = $_POST["t_obsrvr15"];
$t_obsrvrmedio = $_POST["t_obsrvrmedio"];
$t_obsrvr33 = $_POST["t_obsrvr33"];
$t_obsradar = $_POST["t_obsradar"];

/*$r_pista15 = $_POST["r_pista15"];
$r_pista33 = $_POST["r_pista33"];
$r_pista11 = $_POST["r_pista11"];
$r_pista29 = $_POST["r_pista29"];*/

$s_operacionalidade = $_POST["s_operacionalidade"];
if(isset($_POST["t_teto"]))
{
	$t_teto = $_POST["t_teto"];
}
else
{
	$t_teto = 10000;
}

if(isset($_POST["t_visibilidade"]))
{
	$t_visibilidade = $_POST["t_visibilidade"];
}
else
{
	$t_visibilidade = 10000;
}
$r_cat = $_POST["r_cat"];
$r_baixavis = $_POST["r_baixavis"];
$r_placoar = $_POST["r_placoar"];

$s_pistaemuso = $_POST["s_pistaemuso"];

$r_prat15 = $_POST["r_prat15"];
//$r_prat33 = $_POST["r_prat33"];
$r_prat11 = $_POST["r_prat11"];
//$r_prat29 = $_POST["r_prat29"];

$r_hora = $_POST["r_hora"]; //horario manual sim ou nao
$t_hora = $_POST["t_hora"];

$s_atis = $_POST["s_atis"];

$consulta = "SELECT * FROM aeroporto WHERE id = '$aeroporto_id'"; //seleciona dados do afonso pena (id = 1)
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
$atis = mysql_result($resultado, 0, "atis");
$operacionalidade = mysql_result($resultado, 0, "operacionalidade");
$teto = mysql_result($resultado, 0, "teto");
$visibilidade = mysql_result($resultado, 0, "visibilidade");
$cat = mysql_result($resultado, 0, "cat");
$baixavis = mysql_result($resultado, 0, "baixavis");
$placoar = mysql_result($resultado, 0, "placoar");
$procedimentoaeroporto = mysql_result($resultado, 0, "procedimento_id");

//echo $r_pista33;
//echo $pista33;

if($r_hora == 1)
{
	$time = $t_hora;
}

$flag_mudanca_aeroporto = 0; //indica se houve mudança na tabela aeroporto
$flag_mudanca_pista = 0;
$flag_mudanca_auxilio = 0;

if($s_operacionalidade>1) //abaixo dos minimos
	$r_procid = 0; //sem procedimento para pouso
	
//se não tiver procedimento definido, não salva no banco, pois supoem-se que o operador vai faze-lo logo em seguida
if($r_procid == 0)
{
	if($s_operacionalidade<2)
	{
		echo "nao salvar";
	//	header('location: principal.php');
	}
}

if($atis!=$s_atis)
{
	$atualiza = "UPDATE aeroporto SET atis = '".$s_atis."' WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao aeroporto. atis = ".$s_atis);
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}

if($r_procid!=$procedimentoaeroporto)
{
	$atualiza = "UPDATE aeroporto SET procedimento_id = ".$r_procid." WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao aeroporto. r_procid = ".$r_procid);
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}

if($placoar!=$r_placoar)
{
	$atualiza = "UPDATE aeroporto SET placoar = ".$r_placoar." WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}
if($cat!=$r_cat)
{
	$atualiza = "UPDATE aeroporto SET cat = ".$r_cat." WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}
if($baixavis!=$r_baixavis)
{
	$atualiza = "UPDATE aeroporto SET baixavis = ".$r_baixavis." WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}
if($operacionalidade!=$s_operacionalidade)
{
	//altera se operacionalidade mudou
	$atualiza = "UPDATE aeroporto SET operacionalidade = ".$s_operacionalidade." WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}
if($teto!=$t_teto)
{
	//altera se operacionalidade mudou
	$atualiza = "UPDATE aeroporto SET teto = ".$t_teto." WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}
if($visibilidade!=$t_visibilidade)
{
	//altera se operacionalidade mudou
	$atualiza = "UPDATE aeroporto SET visibilidade = ".$t_visibilidade." WHERE id = 1";
	//echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	//echo ("tabela aeroporto atualizada");
	$flag_mudanca_aeroporto = 1;
}

if ($flag_mudanca_aeroporto == 1)
{
	if(($s_operacionalidade>1) or ($s_operacionalidade<2 and $r_procid!=0))
	{
		$insere = "INSERT INTO `aerocontrol`.`altera_aeroporto` (`usuario_id`, `aeroporto_id`, `datahora`, `teto`, `visibilidade`, `operacionalidade`, `cat`, `baixavis`, `placoar`, `procedimento_id`, `atis`) VALUES ('$usuario_id', '$aeroporto_id', '$datahora', '$t_teto', '$t_visibilidade', '$s_operacionalidade', '$r_cat', '$r_baixavis', '$r_placoar', '$r_procid', '$s_atis')";
		//echo $insere;
		$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_aeroporto");	
	}
}

if($s_pistaemuso==0)
{
	$r_pista15 = 1;
	$r_pista11 = 0;
	$r_pista33 = 0;
	$r_pista29 = 0;
}
if($s_pistaemuso==1)
{
	$r_pista15 = 0;
	$r_pista11 = 0;
	$r_pista33 = 1;
	$r_pista29 = 0;
}
if($s_pistaemuso==2)
{
	$r_pista15 = 0;
	$r_pista11 = 1;
	$r_pista33 = 0;
	$r_pista29 = 0;
}
if($s_pistaemuso==3)
{
	$r_pista15 = 0;
	$r_pista11 = 0;
	$r_pista33 = 0;
	$r_pista29 = 1;
}

$r_prat33 = $r_prat15;
$r_prat29 = $r_prat11;
	
if($r_pista15!=$pista15)
{
	//altera se o pista esta operacional ou nao
	$atualiza = "UPDATE pista SET operacional = ".$r_pista15." WHERE id = 1";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao pista15.");
	echo ("tabela pista atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '1', '$datahora', '$r_pista15', '$r_prat15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");
}
if($r_pista33!=$pista33)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE pista SET operacional = ".$r_pista33." WHERE id = 2";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao pista33.");
	echo ("tabela pista atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '2', '$datahora', '$r_pista33', '$r_prat33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");	
}
if($r_pista11!=$pista11)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE pista SET operacional = ".$r_pista11." WHERE id = 3";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao pista11.");
	echo ("tabela pista atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '3', '$datahora', '$r_pista11', '$r_prat11')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");	
}
if($r_pista29!=$pista29)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE pista SET operacional = ".$r_pista29." WHERE id = 4";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao pista29.");
	echo ("tabela pista atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '4', '$datahora', '$r_pista29', '$r_prat29')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");	
}

if($prat_pista15!=$r_prat15)
{
	$atualiza = "update pista set praticavel = ".$r_prat15." where id = 1";
	mysql_query($atualiza, $conecta) or die ("Erro atualizando pista15");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '1', '$datahora', '$r_pista15', '$r_prat15')";
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");	
}
if($prat_pista33!=$r_prat33)
{
	$atualiza = "update pista set praticavel = ".$r_prat33." where id = 2";
	mysql_query($atualiza, $conecta) or die ("Erro atualizando pista33");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '2', '$datahora', '$r_pista33', '$r_prat33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");	
}
if($prat_pista11!=$r_prat11)
{
	$atualiza = "update pista set praticavel = ".$r_prat11." where id = 3";
	mysql_query($atualiza, $conecta) or die ("Erro atualizando pista11");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '3', '$datahora', '$r_pista11', '$r_prat11')";
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");	
}
if($prat_pista29!=$r_prat29)
{
	$atualiza = "update pista set praticavel = ".$r_prat29." where id = 4";
	mysql_query($atualiza, $conecta) or die ("Erro atualizando pista29");
	$insere = "INSERT INTO `aerocontrol`.`altera_pista` (`usuario_id`, `pista_id`, `datahora`, `operacional`, `praticavel`) VALUES ('$usuario_id', '4', '$datahora', '$r_pista29', '$r_prat29')";
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_pista");	
}

if($r_loc15!=$loc15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_loc15." WHERE id = 1";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	//salva quem alterou o auxilio, a data, hora, e para qual condição.
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '1', '$datahora', '$r_loc15', '$t_obsloc15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
	
//	$insere = "INSERT into altera_auxilio VALUES ($iduser, 
}

if($r_gl15!=$gl15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_gl15." WHERE id = 2";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '2', '$datahora', '$r_gl15', '$t_obsgl15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_loc33!=$loc33)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_loc33." WHERE id = 3";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '3', '$datahora', '$r_loc33', '$t_obsloc33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_gl33!=$gl33)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_gl33." WHERE id = 4";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '4', '$datahora', '$r_gl33', '$t_obsgl33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_als15!=$als15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_als15." WHERE id = 5";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '5', '$datahora', '$r_als15', '$t_obsals15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_flash15!=$flash15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_flash15." WHERE id = 6";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '6', '$datahora', '$r_flash15', '$t_obsflash15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_thr15!=$thr15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_thr15." WHERE id = 7";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '7', '$datahora', '$r_thr15', '$t_obsthr15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_tdz15!=$tdz15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_tdz15." WHERE id = 8";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '8', '$datahora', '$r_tdz15', '$t_obstdz15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_rcl!=$rcl)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_rcl." WHERE id = 9";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '9', '$datahora', '$r_rcl', '$t_obsrcl')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_blz1533!=$blz1533)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_blz1533." WHERE id = 10";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '10', '$datahora', '$r_blz1533', '$t_obsblz1533')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_blz1129!=$blz1129)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_blz1129." WHERE id = 11";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '11', '$datahora', '$r_blz1129', '$t_obsblz1129')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_blztwy!=$blztwy)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_blztwy." WHERE id = 12";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '12', '$datahora', '$r_blztwy', '$t_obsblztwy')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_om15!=$om15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_om15." WHERE id = 13";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '13', '$datahora', '$r_om15', '$t_obsom15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_mm15!=$mm15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_mm15." WHERE id = 14";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '14', '$datahora', '$r_mm15', '$t_obsmm15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_im15!=$im15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_im15." WHERE id = 15";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '15', '$datahora', '$r_im15', '$t_obsim15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_om33!=$om33)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_om33." WHERE id = 16";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '16', '$datahora', '$r_om33', '$t_obsom33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_mm33!=$mm33)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_mm33." WHERE id = 17";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '17', '$datahora', '$r_mm33', '$t_obsmm33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_im33!=$im33)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_im33." WHERE id = 18";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '18', '$datahora', '$r_im33', '$t_obsim33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_vor!=$vor)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_vor." WHERE id = 19";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '19', '$datahora', '$r_vor', '$t_obsvor')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_dme!=$dme)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_dme." WHERE id = 20";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '20', '$datahora', '$r_dme', '$t_obsdme')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_rvr15!=$rvr15)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_rvr15." WHERE id = 21";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '21', '$datahora', '$r_rvr15', '$t_obsrvr15')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_rvrmedio!=$rvrmedio)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_rvrmedio." WHERE id = 22";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '22', '$datahora', '$r_rvrmedio', '$t_obsrvrmedio')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_rvr33!=$rvr33)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_rvr33." WHERE id = 23";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '23', '$datahora', '$r_rvr33', '$t_obsrvr33')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
if($r_radar!=$radar)
{
	//altera se o auxilio esta operacional ou nao
	$atualiza = "UPDATE auxilio SET operacional = ".$r_radar." WHERE id = 24";
	echo $atualiza;
	mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
	echo ("tabela auxilios atualizada");
	$insere = "INSERT INTO `aerocontrol`.`altera_auxilio` (`usuario_id`, `auxilio_id`, `datahora`, `operacional`, `obs`) VALUES ('$usuario_id', '24', '$datahora', '$r_radar', '$t_obsradar')";
	echo $insere;
	$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_auxilio");	
}
/*$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';*/
header('location: principal.php');
exit;
?>

</body>
</html>