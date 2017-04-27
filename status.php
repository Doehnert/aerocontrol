<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>aerocontrol</title>
<style type="text/css">
#tabela {
	float:left;
}
#procedimento {
	float:right;
}
</style>
</head>

<body>
<form action="salva.php" method="post">
<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina();
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

$id_aeroporto = 1; //afonso pena

$c_loc15 = 0;
$c_gl15 = 0;
$c_loc33 = 0;
$c_gl33 = 0;
$c_als15 = 0;
$c_flash15 = 0;
$c_thr15 = 0;
$c_tdz15 = 0;
$c_rcl = 0;
$c_blz1533 = 0;
$c_blz1129 = 0;
$c_blztwy = 0;
$c_om15 = 0;
$c_mm15 = 0;
$c_im15 = 0;
$c_om33 = 0;
$c_mm33 = 0;
$c_im33 = 0;
$c_vor = 0;
$c_dme = 0;
$c_rvr15 = 0;
$c_rvrmedio = 0;
$c_rvr33 = 0;
$c_radar = 0;

$consulta = "SELECT operacional FROM pista";
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta a tabela pista");
$pista15 = mysql_result($resultado, 0, "operacional");
$pista33 = mysql_result($resultado, 1, "operacional");
$pista11 = mysql_result($resultado, 2, "operacional");
$pista29 = mysql_result($resultado, 3, "operacional");

$consulta = "SELECT * FROM aeroporto WHERE id = ".$id_aeroporto; //seleciona dados do afonso pena (id = 1)
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
$operacionalidade = mysql_result($resultado, 0, "operacionalidade");
$teto = mysql_result($resultado, 0, "teto");
$visibilidade = mysql_result($resultado, 0, "visibilidade");
$nome = mysql_result($resultado, 0, "nome");
$cat2 = mysql_result($resultado, 0, "cat2");
$baixavis = mysql_result($resultado, 0, "baixavis");
$placoar = mysql_result($resultado, 0, "placoar");
?>
<div id="tabela">
<table width="658" border="1" align="center">
  <tr>
    <td colspan="9" align="center">
    <?php
		echo "<strong>";
		echo ("Aeroporto: ".$nome);
		echo "</strong>";
	?>
    </td>
    </tr>
  <tr>
    <td colspan="3" align="center"><strong>Auxílios</strong></td>
    <td colspan="3" rowspan="2" align="center"><strong>Condições</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Situação Operacional</td>
    <td>Última Alteração de Operação</td>
    </tr>
  <tr>
    <td width="94">LOC 15</td>
       <!--   <label>
        <input name="r_loc15" type="radio" id="r_loc15_0" value="1" -->
        	
    <td width="84">
    <?php
		if ($loc15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($loc15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    <td width="155">
    <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 1 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?>
    </td>
 
    <td width="130">Operacionalidade</td>
    <td width="211" colspan="2">
        <?php
		if ($operacionalidade==0)
		{
	        echo("VFR");
		}
		else if ($operacionalidade==1)
		{
	        echo("IFR'");
		}
		    else if ($operacionalidade==2)
		{
	        echo("MA");
		}

		else if ($operacionalidade==3)
		{
	        echo("MD");
		}
		?>
      </td>
    </tr>
  <tr>
    <td>GL 15</td>
    <td>
        <?php
		if ($gl15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($gl15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 2 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>

    <td>Teto</td>
    <td colspan="2">
      <?php
	  echo $teto;
	  ?>
      </td>
    </tr>
  <tr>
    <td>LOC 33</td>
    <td>
         <?php
		if ($loc33==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($loc33==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 3 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>

    <td>Visibilidade</td>
    <td colspan="2">
	<?php
	  echo ($visibilidade);
	  ?>
	  </td>
    </tr>
  <tr>
    <td>GL 33</td>
    <td>
        <?php
		if ($gl33==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($gl33==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 4 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>

    <td colspan="3">&nbsp;</td>


  </tr>
  <tr>
    <td>ALS 15</td>
    <td>
       <?php
		if ($als15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($als15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 5 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>CAT2</td>
    <td> <?php
		if ($cat2==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($cat2==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    </tr>
  <tr>
    <td>FLASH 15</td>
    <td>
         <?php
		if ($flash15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($flash15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
      </td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 6 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>Baixa Visibilidade</td>
    <td> <?php
		if ($baixavis==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($baixavis==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    </tr>
  <tr>
    <td>THR 15</td>
    <td>
            <?php
		if ($thr15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($thr15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 7 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>Placoar</td>
    <td>
    <?php
		if ($placoar==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($placoar==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
	
    </td>
    </tr>
  <tr>
    <td>TDZ 15</td>
    <td>
          <?php
		if ($tdz15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($tdz15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 8 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
  <tr>
    <td>RCL</td>
    <td>
<?php
		if ($rcl==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($rcl==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 9 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td>BLZ 15/33</td>
    <td>
         <?php
		if ($blz1533==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($blz1533==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 10 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td>BLZ 11/29</td>
    <td>
        <?php
		if ($blz1129==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($blz1129==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 11 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
     <td><strong>Pistas em uso</strong></td>
    <td>
      <?php
		if ($pista15==1)
		{
	        echo("Pista 15/11");
		}
	else   if ($pista33==1)
		{
	        echo("Pista 33/29");
		}
		?>
</td>
    </tr>
  <tr>
    <td>BLZ TWY</td>
    <td>
        <?php
		if ($blztwy==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($blztwy==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 12 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td>OM 15</td>
    <td>
         <?php
		if ($om15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($om15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 13 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>

    <td><!-- Tempo abaixo dos minimos --></td>
    <td>
     <?php
	/*	$indice = 0;
		$consulta = "SELECT * from altera_aeroporto WHERE aeroporto_id=$id_aeroporto ORDER BY `altera_aeroporto`.`date` asc";
		$resultado = mysql_query($consulta) or die("Erro consultando altera_aeroporto");
		$numlinhas = mysql_num_rows($resultado);
		$tempo = 0;
		$dias = 0;
		$horas = 0;
		$diferenca2 = 0;
		// Função para calcular horário
		function dif_horario($horario1, $horario2)
		{
		    $horario1 = strtotime("1/1/1980 $horario1");
		    $horario2 = strtotime("1/1/1980 $horario2");
			 if ($horario2 < $horario1)
			 {
			 	$horario2 = $horario2 + 86400;
			 }
			return ($horario2 - $horario1) / 3600;     
		}
		
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
							$diferenca2 += dif_horario($horaanterior, $horaatual);
							$dias += (int)floor($diferenca/(60*60*24));
							break;
						}
					}
					
				}
			}
//			$horaanterior = mysql_result($resultado, ($indice-1), "time");
//			$horaatual = mysql_result($resultado, $indice, "time");
			$horaanterior = 0;
			$horaatual = 0;
			//$tempo += (($dataanterior-$dataatual*24)+($horaanterior-$horaatual));
		}
		/*echo $timedataanterior;
		echo "   -   ";
		echo $timedataatual;*/
		//echo $numlinhas; */
	/*	echo $dias." Dias e ";
		echo $diferenca2." horas"; */
	?> 
    </td>
    </tr>
  <tr>
    <td>MM 15</td>
    <td>
      <?php
		if ($mm15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($mm15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 14 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    </tr>
  <tr>
    <td>IM 15</td>
    <td>
       
        <?php
		if ($im15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($im15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 
     echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 15 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>OM 33</td>
    <td>
       <?php
		if ($om33==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($om33==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 16 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MM 33</td>
    <td>
      <?php
		if ($mm33==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($mm33==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 17 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>IM 33</td>
    <td>
       <?php
		if ($im33==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($im33==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 18 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>VOR</td>
    <td>
          <?php
		if ($vor==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($vor==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 19 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>DME</td>
    <td>
          <?php
		if ($dme==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($dme==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 20 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	 </tr>
  <tr>
    <td>RVR 15</td>
    <td>
             <?php
		if ($rvr15==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($rvr15==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 21 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>RVR MEDIO</td>
    <td>
           <?php
		if ($rvrmedio==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($rvrmedio==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 22 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	</tr>
  <tr>
    <td>RVR 33</td>
    <td>
           <?php
		if ($rvr33==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($rvr33==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 23 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>RADAR</td>
    <td>
         <?php
		if ($radar==1)
		{
	      /*  echo("checked='checked'"); */
			$caminho = "imagens/checado.png";
		}
		else if($radar==0)
		{
	      /*  echo("checked='checked'");  */
			$caminho = "imagens/naochecado.png";
		}
		 echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td><?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 24 ORDER BY `date` desc ,`time` DESC limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$data = mysql_result($resultado,0,'date');
		$data = date('d/m/Y', strtotime($data));
		$hora = mysql_result($resultado,0,'time');
		echo $data;
		echo " as ";
		echo $hora;
	}
	else
	{
		echo "Sem registro de alteracao";
	}
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  </table>
  </div>
  <input name="r_proc" type="hidden" value="0" />
  <div id="procedimento">
<table width="606" border="1" align="center">
  <tr>
    <th width="159" scope="col">Procedimentos</th>
    <th width="118" scope="col">Visibilidade</th>
    <th width="94" scope="col">Teto</th>
    <th width="207" scope="col">Observações</th>
    <th width="207" scope="col">Em Uso</th>
  </tr>
  <tr>
      <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php
	$consultaaeroporto = "SELECT teto, visibilidade, procedimento_id FROM aeroporto WHERE id=".$id_aeroporto;
	$resultadoaeroporto = mysql_query($consultaaeroporto);
	$tetoaeroporto = mysql_result($resultadoaeroporto,0,"teto");
	$visibilidadeaeroporto = mysql_result($resultadoaeroporto,0,"visibilidade");
	$procedimentoaeroporto = mysql_result($resultadoaeroporto,0,"procedimento_id");

	//primeiro passo: pegar ids de procedimento desse aeroporto
	$consulta = "SELECT * from depende_aeroporto WHERE aeroporto_id = ".$id_aeroporto;
	$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
	$indice = 0;
	
	$flag_rvr = 0;			// diz se o rvr funciona
	$flag_als = 0;			// diz se o als funciona

	
	while ($linha = mysql_fetch_assoc($resultado))
	{
		/*********DEFINIÇÂO DE FLAGS*****************/
		$flag_operacional = 0;	// diz se a pista que estou testando está em uso
								// e depois diz se todos os auxilios estao ok
		/********************************************/
		
		$procid[$indice] = $linha["procedimento_id"];
		//segundo: ids de procedimento dessa pista e desse aeroporto
		//achar a pista associada com esse procedimento
		$consulta2 = "SELECT pista_id FROM depende_pista WHERE procedimento_id = ".$procid[$indice];
		$resultado2 = mysql_query($consulta2);
		$pista = mysql_result($resultado2, 0, "pista_id");
		//ver se essa pista esta sendo usada
		$consulta3 = "SELECT operacional FROM pista WHERE id = ".$pista;
		$resultado3 = mysql_query($consulta3);
		$pista_operacional = mysql_result($resultado3,0,"operacional");
		if($pista_operacional == 0) //se a pista não esta em uso, sai do laço para testar proximo procedimento
		{
			continue;
		}
		else
		{
			//terceiro: verificar se todos os auxilios dos ids que restaram estao com operacionalidade = 1
			$consulta4 = "SELECT auxilio_id FROM depende_auxilio WHERE procedimento_id = ".$procid[$indice];
			$resultado4 = mysql_query($consulta4);
			$indice2 = 0;
			$flag_operacional = 1;
			while ($linha4 = mysql_fetch_assoc($resultado4))
			{
				//verifica se o auxilio esta ativo
				$auxid[$indice2] = $linha4["auxilio_id"]; //essa variavel tem o id dos auxilios que o procedimento usa
				$consulta5 = "SELECT operacional FROM auxilio WHERE id = ".$auxid[$indice2];
				$resultado5 = mysql_query($consulta5);
				$operacional = mysql_result($resultado5,0,"operacional");
				switch($auxid[$indice2])
				{
					case 21: //rvr 15
						if($operacional==1)
						{
							$flag_rvr = 1;
						}
						else
						{
							$operacional = 1; //para checar o rvr medio (se o proc usar)
						}
						break;
					case 22:
						if($operacional==1)
						{
							$flag_rvr = 1;
						}
						else
						{
							$operacional = 1; //para checar o rvr 33 (se o proc usar)
						}
						break;
					case 23:
						if($operacional==1)
						{
							$flag_rvr = 1;
						}
						break;	
				}
/*				if((($auxid[$indice2]==21) or ($auxid[$indice2]==22) or ($auxid[$indice2]==23)) and $operacional==1)
				{
					$flag_rvr = 1; //o procedimento usa rvr e o rvr esta ativo
					echo $auxid[$indice2];
				}
				elseif($auxid[$indice2]==21) //aqui testa se todos os rvr estao com erro
				{
					//$indice2++;
					//continue;
					$operacional = 1;
				}
				elseif($auxid[$indice2]==22)
				{
					//$indice2++;
					//echo $consulta5;
					//continue;
					$operacional = 1;
				}
				*/
				if(($auxid[$indice2]==5) and $operacional==1)
				{
					$flag_als = 1;
				}
				if($operacional == 0)
				{
					$flag_operacional = 0;
					break;
				}
				//
				$indice2++;
			}
			if($flag_operacional == 1) //todos os auxilios requeridos estão ok
			{
				$consultaprocedimento = "SELECT id, nome, obs, vmin, tmin, rvrmin, alsmin, rvralsmin FROM procedimento WHERE id=".$procid[$indice];
				$resultadoprocedimento = mysql_query($consultaprocedimento);
				
				$idproc = mysql_result($resultadoprocedimento,0,"id");
				$nomeproc = mysql_result($resultadoprocedimento,0,"nome");
				$obs = mysql_result($resultadoprocedimento,0,"obs");
				$vismin = mysql_result($resultadoprocedimento,0,"vmin");
				$tetomin = mysql_result($resultadoprocedimento,0,"tmin");
				$rvrmin = mysql_result($resultadoprocedimento,0,"rvrmin");
				$alsmin = mysql_result($resultadoprocedimento,0,"alsmin");
				$rvralsmin = mysql_result($resultadoprocedimento,0,"rvralsmin");
				$menor = 0; //menor valor de visibilidade do procedimento

				if($tetomin>$tetoaeroporto)
				{
					break;
				}
				if(($flag_rvr==1) and ($flag_als==1))
				{
					$menor = $rvralsmin;
					if($rvralsmin>$visibilidadeaeroporto)
					{
						break;
					}
				}
				if(($flag_rvr==1) and ($flag_als==0))
				{
					$menor = $rvrmin;
					if($rvrmin>$visibilidadeaeroporto)
					{
						break;
					}
				}
				if(($flag_rvr==0) and ($flag_als==1))
				{
					$menor = $alsmin;
					if($alsmin>$visibilidadeaeroporto)
					{
						break;
					}
				}
				if(($flag_rvr==0) and ($flag_als==0))
				{
					$menor = $vismin;
					if($vismin>$visibilidadeaeroporto)
					{
						break;
					}
				}
				
				//verifica se o procedimento esta em uso pelo aeroporto
				if($idproc==$procedimentoaeroporto)
				{
					$caminho = "imagens/checado.png";
				}
				else
				{
					$caminho = "imagens/naochecado.png";
				}
/*				$consultanome = "SELECT nome FROM procedimento WHERE id = ".$procid[$indice];
				$resultadonome = mysql_query($consultanome);
				$nomeproc = mysql_result($resultadonome,0,"nome");*/
				//echo $flag_als;
				//echo $flag_rvr;
				echo ("<tr>");
				echo ("<td>".$nomeproc."</td>");
				echo ("<td>".$menor."</td>");
				echo ("<td>".$tetomin."</td>");
				echo ("<td>".$obs."</td>");
				echo ("<td>" . $idproc . "<img src=".$caminho." width='50px' height='50px'/>");
				
                echo "<input name='r_proc' id='r_proc' type='radio' value='$idproc'"; 
               if($idproc == $procedimentoaeroporto) {
					echo("checked='checked'");
				}
				echo "/>";
				?>
<?php
				
				echo("</td>");
				echo ("</tr>");
			}
			else
			{
				//echo ("algum auxilio requerido esta com erro");
			}
			$indice++;
		}
	}
			
	//quarto: os ids restantes verificar se o teto minimo é menor ou igual ao teto do aeroporto e visibilidade mínima é menor ou  igual ao do aeroporto
	?></td>
  </tr>
  </table>
</div>
<p>&nbsp;</p>
</form>
</body>
</html>