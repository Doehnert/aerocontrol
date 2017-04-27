<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
protegePagina();
date_default_timezone_set("UTC");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- jQuery library -->
<script src="includes/jquery.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="includes/estilos.css">
<style type="text/css">
.vermelho {
	color: #F00;
}
number {
	size:5;
}
</style>
<style>
input[type="number"] {
   width:70px;
}
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>aerocontrol</title>
<script type="text/javascript">
function habilitadata ()
{
	if (document.getElementById('r_hora').checked = true )
	{
		document.getElementById('hora').innerHTML = "<input id='t_hora' name='t_hora' value='<?php echo date("H:i:s")?>' type='text' class='time' />"
        $(function() {
		$('#t_hora').timepicker({ 
			'step': 5,
			'timeFormat': 'H:i:s'
			 });
		});
	}
} 
function desabilitadata ()
{
	if (document.getElementById('r_hora2').checked = true )
	{
		document.getElementById('hora').innerHTML = ""
	/*	frm.datainst.value="" */
	}
}
	
function AutoRefresh(t)
{
	setTimeout("location.reload(true);", t);
}

//testa as inconsistencias de setagem do operador para prevenir erros
function testa()
{
	var visibilidade = document.meuform.t_visibilidade.value;
	var teto = document.meuform.t_teto.value;
	var pista = document.meuform.s_pistaemuso.value;
	var op = document.meuform.s_operacionalidade.value;
	var sugestao = "";
	
	//valida a operacao em baixa visibilidade
	if(document.getElementById("r_baixavis_1").checked==true)
	{
		if(visibilidade>550)
		{
			document.meuform.t_visibilidade.style="background-color:#F00"; //algo errado
			sugestao = sugestao + "Sugestão: Tirar baixa visibilidade<br/>"
		}
		else
		{
			document.meuform.t_visibilidade.style="background-color:#FFF"; //tudo ok
			sugestao = sugestao + "";
		}
	}
	else if(document.getElementById("r_baixavis_0").checked==true)
	{
		if(visibilidade<=550)
		{
			document.meuform.t_visibilidade.style="background-color:#F00"; //algo errado
			sugestao = sugestao + "Sugestão: Colocar baixa visibilidade<br/>";
		}
		else
		{
			document.meuform.t_visibilidade.style="background-color:#FFF"; //tudo ok
			sugestao = sugestao + "";
		}
	}
	
	//valida a operacao em cat2
	if(document.getElementById("r_cat_1").checked==true)
	{
		if(pista==0) //pista 15
		{
			if(teto>100 && visibilidade>=550)
			{	
				document.meuform.t_teto.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Tirar CAT2<br/>";
			}
			else
			{
				document.meuform.t_teto.style="background-color:#FFF";
				sugestao = sugestao + "";
			}
		}
		else //se nao for pista15 nao tem cat2
		{
				document.meuform.t_teto.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Tirar CAT2<br/>";
		}
	}
	else if(document.getElementById("r_cat_0").checked==true)
	{
		if(pista==0)
		{
			if(teto<=100 || visibilidade<550)
			{
				if(teto<=100)
				{
					document.meuform.t_teto.style="background-color:#F00";
					sugestao = sugestao + "Sugestão: Colocar CAT2<br/>";
				}
				else if(visibilidade<550)
					document.meuform.t_visibilidade.style="background-color:#F00";
					sugestao = sugestao + "Sugestão: Colocar CAT2<br/>";
			}
			else
			{
				document.meuform.t_teto.style="background-color:#FFF";
				document.meuform.t_visibilidade.style="background-color:#FFF";
				sugestao = sugestao + "";
			}
		}
		else //se nao for pista15
		{
				document.meuform.t_teto.style="background-color:#FFF";
				sugestao = sugestao + "";
		}
	}
	
	//valida operacao VMC
	if(op==0)
	{
		if(teto<1500 || visibilidade<5000)
		{
			document.meuform.s_operacionalidade.style="background-color:#F00";
			sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
		}
		else
		{
			document.meuform.s_operacionalidade.style="background-color:#FFF";
			sugestao = sugestao + "";
		}
	}
	
	//valida operacao IMC
	if(op==1)
	{
		if(teto>1500 && visibilidade>5000)
		{
			document.meuform.s_operacionalidade.style="background-color:#F00";
			sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
		}
		else if(pista==0)
		{
			if(teto<100 || visibilidade<400)
			{
				document.meuform.s_operacionalidade.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
			}
			else
			{
				document.meuform.s_operacionalidade.style="background-color:#FFF";
				sugestao = sugestao + "";
			}
		}
		else if(pista==1) //pista 33
		{
			if(teto<200 || visibilidade<1200)
			{
				document.meuform.s_operacionalidade.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
			}
			else
			{
				document.meuform.s_operacionalidade.style="background-color:#FFF";
				sugestao = sugestao + "";
			}			
		}
		else
		{
			document.meuform.s_operacionalidade.style="background-color:#FFF";
			sugestao = sugestao + "";
		}
	}
	
	//valida operacao em MA
	if(op==2) //MA
	{
		if(pista==0) //pista 15
		{
			if(teto>=100 && visibilidade>=400)
			{
				document.meuform.s_operacionalidade.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
			}
			else if(teto==100 && visibilidade==400)
			{
				document.meuform.s_operacionalidade.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
			}
			else if(visibilidade<200)
			{
				document.meuform.s_operacionalidade.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
			}
			else
			{
				document.meuform.s_operacionalidade.style="background-color:#FFF";
				sugestao = sugestao + "";
			}
		}
		if(pista==1) //pista 33
		{
			if(teto>=200 && visibilidade>=1200)
			{
				document.meuform.s_operacionalidade.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
			}
			else if(visibilidade<200)
			{
				document.meuform.s_operacionalidade.style="background-color:#F00";
				sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
			}			
			else
			{
				document.meuform.s_operacionalidade.style="background-color:#FFF";
				sugestao = sugestao + "";
			}
		}
	}
	
	//valida operacam em MG
	if(op==3) //MG
	{
		if(visibilidade>=200)
		{
			document.meuform.s_operacionalidade.style="background-color:#F00";
			sugestao = sugestao + "Sugestão: Mudar Operacionalidade<br/>";
		}
		else
		{
			document.meuform.s_operacionalidade.style="background-color:#FFF";
			document.meuform.t_visibilidade.style="background-color:#FFF";
			sugestao = "";
		}
	}
	document.getElementById('sugestao').innerHTML = sugestao;
}

function aviso_salvar()
{
	document.getElementById('aviso').innerHTML = "Mudanças ainda não foram salvas";
}
function AutoRefresh( t )
{
setTimeout("location.reload(true);", t);
testa();
}
</script>

<script type="text/javascript" src="relogio/timepicker/jquery.min.js"></script>
<script type="text/javascript" src="relogio/timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/jquery.timepicker.css" />
<script type="text/javascript" src="relogio/timepicker/lib/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/lib/bootstrap-datepicker.css" />
<script type="text/javascript" src="relogio/timepicker/lib/site_timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/lib/site_timepicker.css" />

</head>

<body>
<?php //reinicia a pagina cada 1 minuto
$id_aeroporto = 1; //afonso pena

$usuario = $_SESSION['usuario'];

$org = $_SESSION['org'];

if($org == "Infraero")
{
	expulsaVisitante();
}
$consultaorg = "select organizacao from usuario where usuario = '$usuario'";
$resultadoorg = mysql_query($consultaorg);
$organizacao = mysql_result($resultadoorg,0,"organizacao");
?>
<?php require_once('menu.php'); ?>
<div id="tabela">
<form action="salva.php" method="post" name="meuform">
<input name="t_hora" type="hidden" value="00:00:00">
<?php
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

$consulta = "SELECT * FROM aeroporto WHERE id = ".$id_aeroporto; //seleciona dados do afonso pena (id = 1)
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
$operacionalidade = mysql_result($resultado, 0, "operacionalidade");
$teto = mysql_result($resultado, 0, "teto");
$visibilidade = mysql_result($resultado, 0, "visibilidade");
$nome = mysql_result($resultado, 0, "nome");
$cat = mysql_result($resultado, 0, "cat");
$baixavis = mysql_result($resultado, 0, "baixavis");
$placoar = mysql_result($resultado, 0, "placoar");

$atis = mysql_result($resultado, 0, "atis");

$procspouso = array();

?>

<table width="627" border="1" align="center" cellspacing="0">
  <tr>
    <td height="23" colspan="9" align="center" class="titulos">
    <?php
		echo ("Aeroporto: ".$nome);
	?>
    </td>
    </tr>
  <tr>
    <td colspan="6" align="center" class="titulos">Auxílios</td>
    <td colspan="3" rowspan="2" align="center" class="titulos">Condições
    <br>
    <div class="vermelho" id="sugestao"></div>
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="fonte">OK</td>
    <td class="fonte">ERRO</td>
    <td class="fonte">STATUS</td>
    <td align="center" class="fonte">Última alteração em:</td>
    <td align="center" class="fonte">Observações</td>
    </tr>
  <tr>
    <td width="50"><a href="obs.php?aux=1" class="fonte">LOC 15</a></td>
     <td width="20">
      <label><?php
        echo "<input name='r_loc15' type='radio' id='r_loc15_0' value='1' onChange='aviso_salvar();'";  
        if ($loc15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
      </label>
      </td>
    <td width="40">
  <label>
  <?php
  echo "<input type='radio' name='r_loc15' value='0' id='r_loc15_1' onChange='aviso_salvar();'";
		if ($loc15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?>
</label></td>
    <td width="54">
      <?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?>
    </td>
    <td width="72" class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 1 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsloc15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsloc15 = "";
		echo "-";
	}
	?>
    </td>
    <td width="84"><label for="obsloc15">
    <?php
    echo "<input name='t_obsloc15' type='text' id='t_obsloc15' value='$obsloc15' size='15' onChange='aviso_salvar();'>"; 
	?>
    </label>
    </td>
    <td width="119" class="fonte">Operacionalidade</td>
    <td colspan="2"><label for="s_operacionalidade"></label>
      <select name="s_operacionalidade" id="s_operacionalidade" onChange="testa();">
        <option value="0"
        <?php
		if ($operacionalidade==0)
		{
	        echo("selected='selected'");
		}
		?>
        >VMC</option>
        <option value="1"
        <?php
		if ($operacionalidade==1)
		{
	        echo("selected='selected'");
		}
		?>
        >IMC</option>
        <option value="2"
        <?php
		if ($operacionalidade==2)
		{
	        echo("selected='selected'");
		}
		?>
        >MA</option>
        <option value="3"
        <?php
		if ($operacionalidade==3)
		{
	        echo("selected='selected'");
		}
		?>
        >MG</option>
      </select>
            CAVOK
      <input name="c_cavok" id="c_cavok" type="checkbox" value="">
      <script>
	  $(document).ready(function(e) {
        $("#c_cavok").click(function(){
			$("#t_visibilidade").val(10000);
			$("#t_teto").val(10000);
		if($("#c_cavok").is(":checked"))
		{
			$("#t_visibilidade").prop("disabled", true);
			$("#t_teto").prop("disabled", true);
		}
		else
		{
			$("#t_visibilidade").prop("disabled", false);
			$("#t_teto").prop("disabled", false);
		}
		});
      });
	  </script>
      </td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=2" class="fonte">GL 15</a></td>
    <td>
        <label><?php
        echo "<input name='r_gl15' type='radio' id='r_gl15_0' value='1' onChange='aviso_salvar();'";
		if ($gl15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
        </label>
      </td>
    <td><?php
        echo "<input name='r_gl15' type='radio' id='r_gl15_1' value='0' onChange='aviso_salvar();'";
		if ($gl15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 2 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsgl15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsgl15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsgl15' type='text' id='t_obsgl15' value='$obsgl15' size='15' onChange='aviso_salvar();'/>"; 
	?>
    </td>
    <td class="fonte">Teto (ft)</td>
    <td colspan="2"><label for="t_teto"></label>
      <input name="t_teto" type="number" id="t_teto" max="10000" step="100" min="0" required onChange="testa();"
      <?php
	  echo ("value=".$teto);
	  ?>>
      NSC
      <input name="c_nsc" id="c_nsc" type="checkbox" value="">
      </td>
      <script>
	  $(document).ready(function(e) {
		  if(($("#t_teto").val()==10000) && ($("#t_visibilidade").val()==10000))
		  {
			  $("#c_cavok").prop('checked', true);
			  $("#t_teto").prop('disabled', true);
			  $("#t_visibilidade").prop('disabled', true);
		  }
		  if($("#t_teto").val()==10000)
		  {
			  $("#c_nsc").prop('checked', true);
			  $("#t_teto").prop('disabled', true);
		  }
		  if($("#t_visibilidade").val()==10000)
		  {
			  $("#c_visibilidade").prop('checked', true);
			  $("#t_visibilidade").prop('disabled', true);
		  }

		  
       	$("#c_nsc").click(function(){
			$("#t_teto").val(10000);
		if($("#c_nsc").is(":checked"))
		{
			$("#t_teto").prop("disabled", true);
		}
		else
		{
			$("#t_teto").prop("disabled", false);
		}				
		}); 
      });
	  </script>
    </tr>
  <tr>
    <td><a href="obs.php?aux=3" class="fonte">LOC 33</a></td>
    <td>
          <label><?php
        echo "<input name='r_loc33' type='radio' id='r_loc33_0' value='1' onChange='aviso_salvar();'";
		if ($loc33==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
          </label>
    </td>
    <td><?php
        echo "<input name='r_loc33' type='radio' id='r_loc33_1' value='0' onChange='aviso_salvar();'";
		if ($loc33==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 3 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsloc33 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsloc33 = "";
		echo "-";
	}
	?>
    </td>
    <td><?php
    echo "<input name='t_obsloc33' type='text' id='t_obsloc33' value='$obsloc33' size='15' onChange='aviso_salvar();'/>";
	?>
    </td>
    <td class="fonte">Visibilidade (m)</td>
    <td colspan="2"><label for="t_visibilidade"></label>
      <input name="t_visibilidade" type="number" id="t_visibilidade" max="10000" step="100" size="5" onChange="testa();"
      <?php
	  echo ("value=".$visibilidade);
	  ?>>
	>10KM
    <input name="c_visibilidade" id="c_visibilidade" type="checkbox" value="1">
      <script>
	  $(document).ready(function(e) {
        $("#c_visibilidade").click(function(){
			$("#t_visibilidade").val(10000);
		if($("#c_visibilidade").is(":checked"))
		{
			$("#t_visibilidade").prop("disabled", true);
		}
		else
		{
			$("#t_visibilidade").prop("disabled", false);
		}
	  });		
    });
	</script>
      </td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=4" class="fonte">GL 33</a></td>
    <td>
          <label><?php
        echo "<input name='r_gl33' type='radio' id='r_gl33_0' value='1' onChange='aviso_salvar();'";
		if ($gl33==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
          </label>
      </td>
    <td><?php
        echo "<input name='r_gl33' type='radio' id='r_gl33_1' value='0' onChange='aviso_salvar();'";
		if ($gl33==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 4 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsgl33 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsgl33 = "";
		echo "-";
	}
	?>
    </td>
    <td><?php
    echo "<input name='t_obsgl33' type='text' id='t_obsgl33' value='$obsgl33' size='15' onChange='aviso_salvar();'/>" 
	?>
    </td>
    <td><!--Atis--></td>
    <td colspan="2">
<!--      <select name="s_atis" onChange='aviso_salvar();'>
      <?php
      for($i=65;$i<91;$i++)
	  {
		$ch = chr($i);
        echo "<option value='$ch'";
   		if($atis==$ch)
		{
			echo " selected='selected'";
		}
		echo ">$ch</option>";
	  }
	?>
    >A</option>
        
        </select>-->
    </td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=5" class="fonte">ALS 15</a></td>
    <td>
        <label>
        <?php
        echo "<input name='r_als15' type='radio' id='r_als15_0' value='1' onChange='aviso_salvar();'";
		if ($als15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
        </label>
      </td>
    <td><label for="als15">
      <?php
      echo "<input type='radio' name='r_als15' value='0' id='r_als15_1' onChange='aviso_salvar();'";
		if ($als15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?>
    </label></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 5 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsals15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsals15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsals15' type='text' id='t_obsals15' value='$obsals15' size='15' onChange='aviso_salvar();'/>";
	?>
    </td>
    <td>&nbsp;</td>
    <td width="68" class="fonte">Sim</td>
    <td width="82" class="fonte">Não</td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=6" class="fonte">FLASH 15</a></td>
    <td>
              <label>
        <?php
        echo "<input name='r_flash15' type='radio' id='r_flash15_0' value='1' onChange='aviso_salvar();'";
		if ($flash15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
    </td>
    <td><?php
        echo "<input name='r_flash15' type='radio' id='r_flash15_1' value='0' onChange='aviso_salvar();'";
		if ($flash15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 6 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsflash15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsflash15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsflash15' type='text' id='t_obsflash15' value='$obsflash15' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td class="fonte">Baixa Visibilidade</td>
    <td>
    <?php
    echo "<input name='r_baixavis' type='radio' id='r_baixavis_1' value='1' onClick='testa();' onChange='aviso_salvar();'";
		if ($baixavis==1)
		{
		    echo("checked='checked' ");
		}
		echo "/>";
		?>
		</td>
    <td>
    <?php
    echo "<input name='r_baixavis' type='radio' id='r_baixavis_0' value='0' onclick='testa();' onChange='aviso_salvar();'";
		if ($baixavis==0)
		{
		    echo("checked='checked' ");
		}
		echo "/>";
		?>
    </td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=7" class="fonte">THR 15</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_thr15' type='radio' id='r_thr15_0' value='1' onChange='aviso_salvar();'";
        
		if ($thr15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";			
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_thr15' type='radio' id='r_thr15_1' value='0' onChange='aviso_salvar();'";
        
		if ($thr15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";			
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 7 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsthr15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsthr15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsthr15' type='text' id='t_obsthr15' value='$obsthr15' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td class="fonte">Placoar</td>
    <td>
    <?php
    echo "<input name='r_placoar' type='radio' id='r_placoar' value='1' onChange='aviso_salvar();'";
		if ($placoar==1)
		{
		    echo("checked='checked' ");
		}
		echo "/>";
		?>
    </td>
    <td><?php
    echo "<input name='r_placoar' type='radio' id='r_placoar' value='0' onChange='aviso_salvar();'";
		if ($placoar==0)
		{
		    echo("checked='checked' ");
		}
		echo "/>";
		?></td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=8" class="fonte">TDZ 15</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_tdz15' type='radio' id='r_tdz15_0' value='1' onChange='aviso_salvar();'";
		if ($tdz15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_tdz15' type='radio' id='r_tdz15_1' value='0' onChange='aviso_salvar();'";
		if ($tdz15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 8 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obstdz15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obstdz15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obstdz15' type='text' id='t_obstdz15' value='$obstdz15' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td align="left"><span class="fonte">CAT2</span></td>
    <td align="left">
    <?php
    echo "<input name='r_cat' type='radio' id='r_cat_1' value='2' onclick='testa();' onChange='aviso_salvar();'";
		if ($cat==2)
		{
		    echo("checked='checked'");
		}
		echo "/>";
		?>
		</td>
    <td align="left">
    <?php
    echo "<input name='r_cat' type='radio' id='r_cat_0' value='0' onclick='testa();' onChange='aviso_salvar();'";
		if ($cat==0)
		{
		    echo("checked='checked'");
		}
		echo "/>";
		?>
		</td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=9" class="fonte">RCL</a></td>
    <td>
        <label>
        <?php
        echo "<input name='r_rcl' type='radio' id='r_rcl_0' value='1' onChange='aviso_salvar();'";
		if ($rcl==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";			
		?>
        </label>
    </td>
    <td><?php
        echo "<input name='r_rcl' type='radio' id='r_rcl_1' value='0' onChange='aviso_salvar();'";
		if ($rcl==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";			
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 9 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsrcl = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsrcl = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsrcl' type='text' id='t_obsrcl' value='$obsrcl' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td class="fonte">&nbsp;</td>
    <td class="fonte">&nbsp;</td>
    <td class="fonte">&nbsp;</td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=10" class="fonte">BLZ 15/33</a></td>
    <td>
          <label>
          <?php
        echo "<input name='r_blz1533' type='radio' id='r_blz1533_0' value='1' onChange='aviso_salvar();'";
		if ($blz1533==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
          </label>
    </td>
    <td><?php
        echo "<input name='r_blz1533' type='radio' id='r_blz1533_1' value='0' onChange='aviso_salvar();'";
		if ($blz1533==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 10 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsblz1533 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsblz1533 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsblz1533' type='text' id='t_obsblz1533' value='$obsblz1533' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td colspan="3" align="center" class="titulos">Pistas</td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=11" class="fonte">BLZ 11/29</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_blz1129' type='radio' id='r_blz1129_0' value='1' onChange='aviso_salvar();'";
		if ($blz1129==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
     </td>
    <td><?php
        echo "<input name='r_blz1129' type='radio' id='r_blz1129_1' value='0' onChange='aviso_salvar();'";
		if ($blz1129==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 11 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsblz1129 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsblz1129 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsblz1129' type='text' id='t_obsblz1129' value='$obsblz1129' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td class="fonte">Pista em uso</td>
    <td colspan="2"><select name="s_pistaemuso" id="s_pistaemuso" onChange='aviso_salvar();'>
      <option value="0"
      <?php
		if ($pista15==1)
		{
	        echo("selected='selected'");
		}
		if ($organizacao == "Infraero")
		{
			echo(" disabled = 'true'");
		}			
		?>
      >Pista 15</option>
      <option value="1"
      <?php
		if ($pista33==1)
		{
	        echo("selected='selected'");
		}
		if ($organizacao == "Infraero")
		{
			echo(" disabled = 'true'");
		}			
		?>
      >Pista 33</option>
      <option value="2"
      <?php
		if ($pista11==1)
		{
	        echo("selected='selected'");
		}
		if ($organizacao == "Infraero")
		{
			echo(" disabled = 'true'");
		}			
		?>
      >Pista 11</option>
      <option value="3"
      <?php
		if ($pista29==1)
		{
	        echo("selected='selected'");
		}
		if ($organizacao == "Infraero")
		{
			echo(" disabled = 'true'");
		}			
		?>
      >Pista 29</option>
    </select></td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=12" class="fonte">BLZ TWY</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_blztwy' type='radio' id='r_blztwy_0' value='1' onChange='aviso_salvar();'";
		if ($blztwy==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
    </td>
    <td><?php
        echo "<input name='r_blztwy' type='radio' id='r_blztwy_1' value='0' onChange='aviso_salvar();'";
		if ($blztwy==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 12 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsblztwy = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsblztwy = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsblztwy' type='text' id='t_obsblztwy' value='$obsblztwy' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td class="fonte">&nbsp;</td>
    <td class="fonte">OK</td>
    <td class="fonte">Impraticavel</td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=13" class="fonte">OM 15</a></td>
    <td>
              <label>
        <?php
        echo "<input name='r_om15' type='radio' id='r_om15_0' value='1' onChange='aviso_salvar();'
";        
		if ($om15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
        </label>
      </td>
    <td><?php
        echo "<input name='r_om15' type='radio' id='r_om15_1' value='0' onChange='aviso_salvar();'
";        
		if ($om15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 13 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsom15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsom15 = "";
		echo "-";
	}
	?>
    </td>
    <td><?php
    echo "<input name='t_obsom15' type='text' id='t_obsom15' value='$obsom15' size='15' onChange='aviso_salvar();'/>";
		?>
</td>
    <td class="fonte">Pista 15/33</td>
    <td><?php
    echo "<input name='r_prat15' type='radio' id='r_prat15' value='1' onChange='aviso_salvar();'";
		if ($prat_pista15==1)
		{
		    echo("checked='checked'");
		}
		echo "/>";
		?></td>
    <td><?php
    echo "<input name='r_prat15' type='radio' id='r_prat15' value='0' onChange='aviso_salvar();'";
		if ($prat_pista15==0)
		{
		    echo("checked='checked'");
		}
		echo "/>";
		?></td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=14" class="fonte">MM 15</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_mm15' type='radio' id='r_mm15_0' value='1' onChange='aviso_salvar();'";
		if ($mm15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_mm15' type='radio' id='r_mm15_1' value='0' onChange='aviso_salvar();'";
		if ($mm15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 14 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsmm15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsmm15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsmm15' type='text' id='t_obsmm15' value='$obsmm15' size='15' onChange='aviso_salvar();'/>";
	?>
	</td>
    <td class="fonte">Pista 11/29</td>
    <td class="fonte"><?php
    echo "<input name='r_prat11' type='radio' id='r_prat11' value='1' onChange='aviso_salvar();'";
		if ($prat_pista11==1)
		{
		    echo("checked='checked'");
		}
		echo "/>";
		?></td>
    <td class="fonte"><?php
    echo "<input name='r_prat11' type='radio' id='r_prat11' value='0' onChange='aviso_salvar();'";
		if ($prat_pista11==0)
		{
		    echo("checked='checked'");
		}
		echo "/>";
		?></td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=15" class="fonte">IM 15</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_im15' type='radio' id='r_im15_0' value='1' onChange='aviso_salvar();'
";        
		if ($im15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_im15' type='radio' id='r_im15_1' value='0' onChange='aviso_salvar();'
";        
		if ($im15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 15 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsim15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsim15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsim15' type='text' id='t_obsim15' value='$obsim15' size='15' onChange='aviso_salvar();'/>";
		?></td>
    <td class="fonte">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=16" class="fonte">OM 33</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_om33' type='radio' id='r_om33_0' value='1' onChange='aviso_salvar();'";
		if ($om33==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
     </td>
    <td><?php
        echo "<input name='r_om33' type='radio' id='r_om33_1' value='0' onChange='aviso_salvar();'";
		if ($om33==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 16 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsom33 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsom33 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsom33' type='text' id='t_obsom33' value='$obsom33' size='15' onChange='aviso_salvar();'/>";
		?>
     </td>
    <td colspan="3" align="center" class="fonte"><span class="titulos">Relatórios</span></td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=17" class="fonte">MM 33</a></td>
    <td>
              <label>
        <?php
        echo "<input name='r_mm33' type='radio' id='r_mm33_0' value='1' onChange='aviso_salvar();'";
		if ($mm33==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_mm33' type='radio' id='r_mm33_1' value='0' onChange='aviso_salvar();'";
		if ($mm33==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 17 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsmm33 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsmm33 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsmm33' type='text' id='t_obsmm33' value='$obsmm33' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td><span class="fonte"><a href="turno.php" class="fonte">Turno Atual</a></span></td>
    <td><a href="relatorio.php" class="fonte">Relatorios</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=18" class="fonte">IM 33</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_im33' type='radio' id='r_im33_0' value='1' onChange='aviso_salvar();'";
		if ($im33==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_im33' type='radio' id='r_im33_1' value='0' onChange='aviso_salvar();'";
		if ($im33==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 18 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsim33 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsim33 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsim33' type='text' id='t_obsim33' value='$obsim33' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td align="center" class="titulos">&nbsp;</td>
    <td align="center" class="titulos">&nbsp;</td>
    <td align="center" class="titulos">&nbsp;</td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=19" class="fonte">VOR</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_vor' type='radio' id='r_vor_0' value='1' onChange='aviso_salvar();'";
		if ($vor==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
        </label>
      </td>
    <td><?php
        echo "<input name='r_vor' type='radio' id='r_vor_1' value='0' onChange='aviso_salvar();'";
		if ($vor==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 19 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsvor = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsvor = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsvor' type='text' id='t_obsvor' value='$obsvor' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=20" class="fonte">DME</a></td>
    <td>
              <label>
        <?php
        echo "<input name='r_dme' type='radio' id='r_dme_0' value='1' onChange='aviso_salvar();'";
		if ($dme==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
         </label>
      </td>
    <td><?php
        echo "<input name='r_dme' type='radio' id='r_dme_1' value='0' onChange='aviso_salvar();'";
		if ($dme==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 20 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsdme = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsdme = "";
		echo "-";
	}
	?>
    </td>
    <td><?php
    echo "<input name='t_obsdme' type='text' id='t_obsdme' value='$obsdme' size='15' onChange='aviso_salvar();'/>";
		?>
    </td>
    <td colspan="3" align="center" class="titulos">Configurações</td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=21" class="fonte">RVR 15</a></td>
    <td>
              <label>
        <?php
        echo "<input name='r_rvr15' type='radio' id='r_rvr15_0' value='1' onChange='aviso_salvar();'";
		if ($rvr15==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
        </label>
      </td>
    <td><?php
        echo "<input name='r_rvr15' type='radio' id='r_rvr15_1' value='0' onChange='aviso_salvar();'";
		if ($rvr15==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 21 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsrvr15 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsrvr15 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsrvr15' type='text' id='t_obsrvr15' value='$obsrvr15' size='15' onChange='aviso_salvar();'/>";
	?>
	</td>
    <td>
    
    </td>
    <td><span class="fonte">Sim</span></td>
    <td><span class="fonte">Não</span></td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=22" class="fonte">RVR MEDIO</a></td>
    <td>
              <label>
              <?php
        echo "<input name='r_rvrmedio' type='radio' id='r_rvrmedio_0' value='1' onChange='aviso_salvar();'";
		if ($rvrmedio==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_rvrmedio' type='radio' id='r_rvrmedio_1' value='0' onChange='aviso_salvar();'";
		if ($rvrmedio==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 22 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsrvrmedio = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsrvrmedio = "";
		echo "-";
	}
	?>
    </td>
    <td><?php
    echo "<input name='t_obsrvrmedio' type='text' id='t_obsrvrmedio' value='$obsrvrmedio' size='15' onChange='aviso_salvar();'/>";
	?>
	</td>
    <td><span class="fonte">Horário Manual?</span></td>
    <td><input type="radio" name="r_hora" id="r_hora" value="1" onClick="habilitadata();">
    <!--onClick="habilitadata();"-->
    
    </td>
    <td><input name="r_hora" type="radio" id="r_hora2" value="0" checked="checked" onClick="desabilitadata();">
    <!--onClick="desabilitadata();"-->
    
    </td>
  </tr>
  <tr>
    <td><a href="obs.php?aux=23" class="fonte">RVR 33</a></td>
    <td>
              <label>
        <?php
        echo "<input name='r_rvr33' type='radio' id='r_rvr33_0' value='1' onChange='aviso_salvar();'";
		if ($rvr33==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label>
      </td>
    <td><?php
        echo "<input name='r_rvr33' type='radio' id='r_rvr33_1' value='0' onChange='aviso_salvar();'";
		if ($rvr33==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 23 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsrvr33 = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsrvr33 = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsrvr33' type='text' id='t_obsrvr33' value='$obsrvr33' size='15' onChange='aviso_salvar();'/>";
	?>
	</td>
    <td colspan="3"><label for="t_hora"></label>
      <div id="hora"></div>
      </td>
    </tr>
  <tr>
    <td><a href="obs.php?aux=24" class="fonte">RADAR</a></td>
    <td>
              <label>
        <?php
        echo "<input name='r_radar' type='radio' id='r_radar_0' value='1' onChange='aviso_salvar();'";
		if ($radar==1)
		{
	        echo("checked='checked'");
			$caminho = "imagens/checado.png";
		}
		echo "/>";
		?>
              </label></td>
    <td><?php
        echo "<input name='r_radar' type='radio' id='r_radar_1' value='0' onChange='aviso_salvar();'";
		if ($radar==0)
		{
	        echo("checked='checked'");
			$caminho = "imagens/naochecado.png";
		}
		echo "/>";
		?></td>
    <td><?php echo ("<img src=".$caminho." width='25px' height='25px'/>");
	?></td>
    <td class="fonte">
      <?php
	$consulta = "SELECT * FROM altera_auxilio where `auxilio_id` = 24 ORDER BY `datahora` desc limit 1";
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$obsradar = mysql_result($resultado,0,'obs');
		$data = mysql_result($resultado,0,'datahora');
		$data = date('d/m/Y', strtotime($data));
		//$hora = mysql_result($resultado,0,'time');
		echo $data;
		//echo " as ";
		//echo $hora;
	}
	else
	{
		$obsradar = "";
		echo "-";
	}
	?>
    </td>
    <td>
    <?php
    echo "<input name='t_obsradar' type='text' id='t_obsradar' value='$obsradar' size='15' onChange='aviso_salvar();'/>";
	?>
	</td>
    <td class="fonte"><a href="config.php">Horario turnos</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
    <input name="r_procid" type="hidden" value="0">
  </div>
  <div id="tabela2">
  
  <table width="606" border="1" align="center" cellspacing="0">
  <tr>
  <td colspan="5">
  <h3><span class="vermelho">Atenção!, a tabela a seguir não exime o controlador da escolha do procedimento correto sendo apenas uma sugestão do sistema e para exibição no briefing</span></h3>
  </td>
    <tr>
    <th width="159" class="titulos" scope="col">Procedimentos</th>
    <th width="118" class="titulos" scope="col">Visibilidade(m)</th>
    <th width="94" class="titulos" scope="col">Teto(ft)</th>
    <th width="207" class="titulos" scope="col">Observações</th>
    <th width="207" class="titulos" scope="col">Em Uso</th>
  </tr>
  <tr>
      <?php
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
		/*********DEFINI��O DE FLAGS*****************/
		$flag_operacional = 0;	// diz se a pista que estou testando est� em uso
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
		if($pista_operacional == 0) //se a pista n�o esta em uso, sai do la�o para testar proximo procedimento
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
				if($operacional == 0) //se tiver algum auxilio requerido com estado de erro
				{
					$flag_operacional = 0;
					break;
				}
				if((($auxid[$indice2]==1) or ($auxid[$indice2]==2)) and $operacional==2)
				{
					//nesse caso o GL ou LOC est�o em estado indisponivel portanto nao posso usar o procedimento
					//que necessita desses auxilios
					$flag_operacional = 0;
				}
				//
				$indice2++;
			}
			if($flag_operacional == 1) //todos os auxilios requeridos est�o ok
			{
				$consultaprocedimento = "SELECT id, nome, obs, link, vmin, tmin, rvrmin, alsmin, rvralsmin FROM procedimento WHERE id=".$procid[$indice];
				$resultadoprocedimento = mysql_query($consultaprocedimento);
				
				$idproc = mysql_result($resultadoprocedimento,0,"id");
				$nomeproc = mysql_result($resultadoprocedimento,0,"nome");
				$obs = mysql_result($resultadoprocedimento,0,"obs");
				$link = mysql_result($resultadoprocedimento,0,"link");
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
				echo ("<td><a class='fonte' href='$link' target='new'>".$nomeproc."</a></td>");
				$flag_precisao = 0;
				$flag_cat1 = 0;
				switch($idproc)
				{
					case 1:
						$flag_precisao = 1;
						break;
					case 2:
						$flag_precisao = 1;
						$flag_cat1 = 1;
						break;
					case 3:
						$flag_precisao = 1;
						$flag_cat1 = 1;
						break;
					case 6:
						$flag_precisao = 1;
						$flag_cat1 = 1;
						break;
					case 7:
						$flag_precisao = 1;
						$flag_cat1 = 1;
						break;
				}
				if($flag_precisao==0) //nao precisao
				{
					$aux = $menor/2;
				}
				elseif($flag_cat1==1)
				{
					if($flag_als==1)
					{
						$aux = 400;
					}
					else
					{
						$aux = 600;
					}
				}
				else
				{
					$aux = $menor;
				}
				echo ("<td class='fonte'>".$menor." / ".$aux."(hel)</td>");
				if($flag_cat1==1)
				{
					$aux = $tetomin-100;
				}
				else
				{
					$aux = $tetomin;
				}
				array_push($procspouso, $idproc);
				echo ("<td class='fonte'>".$tetomin." / ".$aux."(hel)</td>");
				echo ("<td class='fonte'>".$obs."</td>");
				echo ("<td class='fonte'><img src=".$caminho." width='50px' height='50px'/>");
                echo "<input name='r_procid' id='r_procid' type='radio' value='$idproc' onChange='aviso_salvar();'"; 
               if($idproc == $procedimentoaeroporto) {
					echo("checked='checked'");
				}
				echo "/>";
				?>
    </span>
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
			
	//quarto: os ids restantes verificar se o teto minimo � menor ou igual ao teto do aeroporto e visibilidade m�nima � menor ou  igual ao do aeroporto
	?></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><div class="vermelho" id="aviso"></div><input type="submit" class="button" name="atualizar" id="atualizar" value="Atualizar"></td>
    </tr>
</table>
</div>

<br>
<div id="tabela3">
<table width="604" border="1" cellspacing="0">
  <tr>
    <th colspan="4" class="titulos" scope="col">Decolagens</th>
    </tr>
  <tr>
    <th width="98" class="titulos" scope="col">Pista</th>
    <th width="152" class="titulos" scope="col">Visibilidade(m)</th>
    <th width="145" class="titulos" scope="col">Teto(ft)</th>
    <th width="181" class="titulos" scope="col">Observações</th>
  </tr>
  <?php
  //1) selecionar pistas em uso desse aeroporto
  //o modelo do banco n�o possui relacionamento de dependencia
  //da pista com o aeroporto, isso pode ser acrescentado
  //caso seja usado em outros aeroportos, por hora, selecionarei
  //apenas pistas ativas j� supondo ser do afonso pena
  $consulta = "select * from pista";
  $resultado = mysql_query($consulta);
  $oppista15 = mysql_result($resultado,0,"operacional");
  $oppista33 = mysql_result($resultado,1,"operacional");
  $oppista11 = mysql_result($resultado,2,"operacional");
  $oppista29 = mysql_result($resultado,3,"operacional");
  
  $consulta2 = "select operacional from auxilio";
  $resultado2 = mysql_query($consulta2);
  $oprvr15 = mysql_result($resultado2, 20, "operacional");
  $oprvrmedio = mysql_result($resultado2, 21, "operacional");
  $oprvr33 = mysql_result($resultado2, 22, "operacional");
  $opblz1533 = mysql_result($resultado2, 9, "operacional");
  $opblz1129 = mysql_result($resultado2, 10, "operacional");
  
  if($oprvr15==2)
  	$oprvr15=0;
  if($oprvrmedio==2)
  	$oprvrmedio=0;
  if($oprvr33==2)
  	$oprvr33=0;
  
  if(($oprvr15==1 and $oprvrmedio==1 and $oprvr33==1)and($visibilidadeaeroporto>=200)and($oppista15==1or$oppista33==1)and($opblz1533==1))
  {
  echo "<tr>";
	if($oppista15==1)
		echo "<td class='fonte'>Pista15</td>";
	elseif($oppista33==1)
		echo "<td class='fonte'>Pista33</td>";
	echo "<td class='fonte'>200</td>";
	echo "<td class='fonte'>nao requerido</td>";
	echo "<td class='fonte'>Luzes de centro de pista e Luzes de pista</td>";
  echo "</tr>";
  }
  elseif(($oprvr15==1 and $oprvr33==1)and($visibilidadeaeroporto>=400)and($oppista15==1or$oppista33==1)and($opblz1533==1))
  {
	echo "<tr>";
	if($oppista15==1)
		echo "<td class='fonte'>Pista15</td>";
	elseif($oppista33==1)
		echo "<td class='fonte'>Pista33</td>";
	echo "<td class='fonte'>400</td>";
	echo "<td class='fonte'>nao requerido</td>";
	echo "<td class='fonte'>Luzes de centro de pista e Luzes de pista</td>";
  echo "</tr>";
  }
  elseif((($oprvr15==1and$oppista15==1)or($oprvr33==1and$oppista33==1))and($opblz1533==1))
  {
	  if($visibilidadeaeroporto>=500)
	  {
		  echo "<tr>";
		  if($oppista15==1)
			  echo "<td class='fonte'>Pista15</td>";
		  elseif($oppista33==1)
			  echo "<td class='fonte'>Pista33</td>";
		  echo "<td class='fonte'>500</td>";
		  echo "<td class='fonte'>nao requerido</td>";
		  echo "<td class='fonte'>Luzes de pista</td>";
		  echo "</tr>";
	  }
  }
  elseif(($oppista15==1and$oprvr15==0and$visibilidadeaeroporto>=600))
  {
	  echo "<tr>";
	  echo "<td class='fonte'>Pista15</td>";
	  echo "<td class='fonte'>600</td>";
	  echo "<td class='fonte'>nao requerido</td>";
	  echo "<td class='fonte'>Luzes de pista</td>";
	  echo "</tr>";
  }
  elseif(($oppista33==1and$oprvr33==0and$visibilidadeaeroporto>=600))
  {
	  echo "<tr>";
	  echo "<td class='fonte'>Pista33</td>";
	  echo "<td class='fonte'>600</td>";
	  echo "<td class='fonte'>nao requerido</td>";
	  echo "<td class='fonte'>Luzes de pista</td>";
	  echo "</tr>";
  }
  if(($oppista11==1or$oppista29==1)and($visibilidadeaeroporto>=600)and($opblz1129==1))
  {
	  echo "<tr>";
	  if($oppista11==1)
		  echo "<td class='fonte'>Pista11</td>";
	  elseif($oppista29==1)
		  echo "<td class='fonte'>Pista29</td>";
	  echo "<td class='fonte'>600</td>";
	  echo "<td class='fonte'>Não requerido</td>";
	  echo "<td class='fonte'>Luzes de pista</td>";
	  echo "</tr>";
  }
?>
</table>
<?php
//print_r($procspouso);
?>
</div>
<p></p>
</form>
</div>
</body>
</html>