<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="includes/estilos.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="includes/googlecharts/jsapi.js"></script>
<script type="text/javascript" src="includes/googlecharts/uds_api_contents.js"></script> 
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
<p>Tempo do aeroporto em cada operacionalidade: </p>
<?php
function imprimetempo($diferencaseg)
{
	$diferenca_seg = $diferencaseg;
	$diferenca_min = 0;
	$diferenca_hora = 0;
	$dias = 0;
	while($diferenca_seg>=60)
	{
		$diferenca_min++;
		$diferenca_seg-=60;
	}
	while($diferenca_min>=60)
	{
		$diferenca_hora++;
		$diferenca_min-=60;
	}
	while($diferenca_hora>=24)
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

$data_inicio = $_POST["data_inicio"];
$data_fim = $_POST["data_fim"];
$hora_inicio = $_POST["hora_inicio"];
$hora_fim = $_POST["hora_fim"];

$datahorauser1 = date("Y-m-d", strtotime($data_inicio))." ".$hora_inicio;
$datahorauser2 = date("Y-m-d", strtotime($data_fim))." ".$hora_fim;

$datahora_agora = date("Y-m-d H:i:s");
if(strtotime($datahorauser2)>strtotime($datahora_agora))
{
	$datahorauser2 = $datahora_agora;
}
$consulta = "select * from altera_aeroporto order by datahora asc limit 1";
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$menor_tempo = mysql_result($resultado,0,"datahora");
}
if(strtotime($datahorauser1)<strtotime($menor_tempo))
{
	$datahorauser1 = $menor_tempo;
}
//echo $datahorauser2;

echo "<p>Tempo de uso de cada pista entre: ".date("d/m/Y H:i:s", strtotime($datahorauser1))." e ".date("d/m/Y H:i:s", strtotime($datahorauser2))."</p>";
$tempovmc = 0;
$tempoimc = 0;
$tempoma = 0;
$tempomg = 0;


//descobre operacionalidade agora
$consulta = "select operacionalidade from aeroporto where id = 1";
$resultado = mysql_query($consulta) or die(mysql_error());
$operacionalidade_agora = mysql_result($resultado,0,"operacionalidade");


////////VMC///////////
$total_seg = 0;
//trecho do meio//////////////
$consulta = "select * from altera_aeroporto where aeroporto_id=1 and operacionalidade = 0 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_aeroporto where aeroporto_id=1 and datahora>'$datahora' and datahora<'$datahorauser2' order by datahora asc limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}
/////////////////////////////

//verifica o ultimo trecho de tempo pra todas as op
	$consulta = "select * from altera_aeroporto where datahora < '$datahorauser2' order by datahora desc limit 1";
	//echo $consulta;
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$datahora_anterior = mysql_result($resultado,0,"datahora");
		$op_anterior = mysql_result($resultado,0,"operacionalidade");
		if($op_anterior == 0)
		{
			if(strtotime($datahora_anterior)>strtotime($datahorauser1))
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_anterior);
			}
			else
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}

//verifica primeira parte do tempo
$consulta = "select * from altera_aeroporto where datahora < '$datahorauser1' order by datahora desc limit 1";
$resultado = mysql_query($consulta);
if(mysql_num_rows($resultado)>0)
{
	$operacionalidade_ant = mysql_result($resultado,0,"operacionalidade");
	if($operacionalidade_ant == 0)
	{
		$consulta2 = "select * from altera_aeroporto where datahora > '$datahorauser1' order by datahora asc limit 1";
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

		
//////////////////////////////////////////////////////

echo "VMC: ";
$tempovmc = $total_seg;
imprimetempo($total_seg);

echo "<br/>";

////////IMC///////////
$total_seg = 0;
//verifica o ultimo trecho de tempo pra todas as op
	$consulta = "select * from altera_aeroporto where datahora < '$datahorauser2' order by datahora desc limit 1";
	//echo $consulta;
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$datahora_anterior = mysql_result($resultado,0,"datahora");
		$op_anterior = mysql_result($resultado,0,"operacionalidade");
		if($op_anterior == 1)
		{
			if(strtotime($datahora_anterior)>strtotime($datahorauser1))
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_anterior);
			}
			else
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}


//trecho do meio//////////////
$consulta = "select * from altera_aeroporto where aeroporto_id=1 and operacionalidade = 1 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_aeroporto where aeroporto_id=1 and datahora>'$datahora' and datahora<'$datahorauser2' order by datahora asc limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}
/////////////////////////////


//verifica primeira parte do tempo
$consulta = "select * from altera_aeroporto where datahora < '$datahorauser1' order by datahora desc limit 1";
$resultado = mysql_query($consulta);
if(mysql_num_rows($resultado)>0)
{
	$operacionalidade_ant = mysql_result($resultado,0,"operacionalidade");
	if($operacionalidade_ant == 1)
	{
		$consulta2 = "select * from altera_aeroporto where datahora > '$datahorauser1' order by datahora asc limit 1";
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
////////////////////////////////////

		
		
//////////////////////////////////////////////////////

echo "IMC: ";
$tempoimc = $total_seg;
imprimetempo($total_seg);

echo "<br/>";

////////MA///////////
$total_seg = 0;

//verifica o ultimo trecho de tempo pra todas as op
	$consulta = "select * from altera_aeroporto where datahora < '$datahorauser2' order by datahora desc limit 1";
	//echo $consulta;
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$datahora_anterior = mysql_result($resultado,0,"datahora");
		$op_anterior = mysql_result($resultado,0,"operacionalidade");
		if($op_anterior == 2)
		{
			if(strtotime($datahora_anterior)>strtotime($datahorauser1))
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_anterior);
			}
			else
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}


//trecho do meio//////////////
$consulta = "select * from altera_aeroporto where aeroporto_id=1 and operacionalidade = 2 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_aeroporto where aeroporto_id=1 and datahora>'$datahora' and datahora<'$datahorauser2' order by datahora asc limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}
/////////////////////////////


//verifica primeira parte do tempo
$consulta = "select * from altera_aeroporto where datahora < '$datahorauser1' order by datahora desc limit 1";
$resultado = mysql_query($consulta);
if(mysql_num_rows($resultado)>0)
{
	$operacionalidade_ant = mysql_result($resultado,0,"operacionalidade");
	if($operacionalidade_ant == 2)
	{
		$consulta2 = "select * from altera_aeroporto where datahora > '$datahorauser1' order by datahora asc limit 1";
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
////////////////////////////////////	
		
//////////////////////////////////////////////////////

echo "MA: ";
$tempoma = $total_seg;
imprimetempo($total_seg);

echo "<br/>";


////////MG///////////
$total_seg = 0;

//ultimo trecho//
$total_seg = 0;
//verifica o ultimo trecho de tempo pra todas as op
	$consulta = "select * from altera_aeroporto where datahora < '$datahorauser2' order by datahora desc limit 1";
	//echo $consulta;
	$resultado = mysql_query($consulta);
	if(mysql_num_rows($resultado)>0)
	{
		$datahora_anterior = mysql_result($resultado,0,"datahora");
		$op_anterior = mysql_result($resultado,0,"operacionalidade");
		if($op_anterior == 3)
		{
			if(strtotime($datahora_anterior)>strtotime($datahorauser1))
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_anterior);
			}
			else
			{
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}


//trecho do meio//////////////
$consulta = "select * from altera_aeroporto where aeroporto_id=1 and operacionalidade = 3 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_aeroporto where aeroporto_id=1 and datahora>'$datahora' and datahora<'$datahorauser2' order by datahora asc limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}
/////////////////////////////


//verifica primeira parte do tempo
$consulta = "select * from altera_aeroporto where datahora < '$datahorauser1' order by datahora desc limit 1";
$resultado = mysql_query($consulta);
if(mysql_num_rows($resultado)>0)
{
	$operacionalidade_ant = mysql_result($resultado,0,"operacionalidade");
	if($operacionalidade_ant == 3)
	{
		$consulta2 = "select * from altera_aeroporto where datahora > '$datahorauser1' order by datahora asc limit 1";
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
////////////////////////////////////		
//////////////////////////////////////////////////////

echo "MG: ";
$tempomg = $total_seg;
imprimetempo($total_seg);

echo "<br/>";
echo "Tempo total = ";
imprimetempo($tempovmc+$tempoimc+$tempoma+$tempomg);
?>
</div>


<script type="text/javascript">
      function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
		['CMO', 'Tempo total'],
		['VMC', <?php echo $tempovmc; ?>],
		['IMC', <?php echo $tempoimc; ?>],
		['MA', <?php echo $tempoma; ?>],
		['MG', <?php echo $tempomg; ?>]
        ]);
        new google.visualization.PieChart(document.getElementById('visualization')).
        draw(
          data,
          {
            title: "CMO",
            curveType: "function",
            title: "Uso das pistas",
            width: 1200, height: 400,
			chartArea:{left:"45%",top:0,width:"30%",height:"300"},
            vAxis: { maxValue: 10 }
          }
        );
      }
      google.setOnLoadCallback(drawVisualization);
    </script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Itens');
        data.addColumn('number', 'Media Notas');
        data.addRows([

        ]);

        // Set chart options
        var options = {'title':'Uso das pistas',
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    
   <!--Div that will hold the pie chart-->
    <div id="chart_div" ></div>
    <div id="visualization" ></div>
</div>
</body>
</html>