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

$consulta = "select * from altera_pista order by datahora asc limit 1";
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$menor_tempo = mysql_result($resultado,0,"datahora");
}
if(strtotime($datahorauser1)<strtotime($menor_tempo))
{
	$datahorauser1 = $menor_tempo;
}

if(strtotime($datahorauser2)>strtotime($datahora_agora))
{
	$datahorauser2 = $datahora_agora;
}
echo "<p>Tempo de uso de cada pista entre: ".date("d/m/Y H:i:s", strtotime($datahorauser1))." e ".date("d/m/Y H:i:s", strtotime($datahorauser2))."</p>";
$tempo15 = 0;
$tempo33 = 0;
$tempo11 = 0;
$tempo29 = 0;

$consulta = "select * from pista where operacional = 1"; //descobre qual pista em uso agora
$resultado = mysql_query($consulta) or die(mysql_error());
$pista_agora = mysql_result($resultado,0,"id");
$praticavel = mysql_result($resultado,0,"praticavel");

//echo $datahorauser1."-".$datahorauser2;



////////PISTA 15///////////////////////////////////////////////
$total_seg = 0;
//$consulta = "select * from altera_pista where pista_id=1 and operacional = 1 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
$consulta = "select * from altera_pista where pista_id=1 and operacional = 1 and datahora > '$datahorauser1' and datahora < '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_pista where pista_id=1 and operacional = 0 and datahora between '$datahora'  and '$datahorauser2' limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$resultado2 = mysql_query($consulta2) or die(mysql_error());
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}

$consulta = "select * from altera_pista where datahora<'$datahorauser2' order by datahora desc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
	$operacionalidade = mysql_result($resultado,0,"operacional");
	if(($operacionalidade == 1) and ($pista_id_ultimo == 1))
	{
		$datahora_ultimo = mysql_result($resultado,0,"datahora");
		if($pista_agora != 1)
		{
			if(strtotime($datahora_ultimo)>=strtotime($datahorauser1))
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
			}
			else
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}
}

//caso o usuario selecionou uma datahora em que a pista ja estava operacional/////
$consulta = "select * from altera_pista where datahora >= '$datahorauser1' and operacional = 0 order by datahora asc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_maior = mysql_result($resultado,0,"pista_id");
	$operacional_maior = mysql_result($resultado,0,"operacional");
	$datahora_maior = mysql_result($resultado,0,"datahora");
	if(($operacional_maior == 0) and ($pista_id_maior == 1))
	{
		if(strtotime($datahora_maior)<=strtotime($datahorauser2))
		{
//			echo "aqui2";
			$total_seg += strtotime($datahora_maior) - strtotime($datahorauser1);
		}
	}
}
//////////////////////////////////////////////////////////////////////////////////


/////////////////se a pista esta em uso agora////////////////////////////////////
if($praticavel == 1)
{
	//se a pista 15 estiver em uso
	if ($pista_agora==1)
	{
		//encontra ultimo registro colocando pista 15 operacional
		$consulta = "select * from altera_pista where operacional = 1 and datahora<='$datahorauser2' order by datahora desc limit 1";
		//echo $consulta;
		$resultado = mysql_query($consulta) or die(mysql_error());
		if(mysql_num_rows($resultado)>0)
		{
			$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
			$datahora_ultimo = mysql_result($resultado,0,"datahora");
			if($pista_id_ultimo == 1)
			{
				//echo "aqui";
				if(strtotime($datahora_ultimo)>strtotime($datahorauser1))
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
				}
				else
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
				}
			}
		}
	}
}

////////////////////////////////////////////////////////////////////////////////
echo "Pista 15: ";
$tempo15 = $total_seg;
imprimetempo($total_seg);
/////////////////////////////////////////////////////////////

echo "<br/>";

////////PISTA 33///////////////////////////////////////////////
$total_seg = 0;
//$consulta = "select * from altera_pista where pista_id=2 and operacional = 1 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
$consulta = "select * from altera_pista where pista_id=2 and operacional = 1 and datahora > '$datahorauser1' and datahora < '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_pista where pista_id=2 and operacional = 0 and datahora between '$datahora'  and '$datahorauser2' limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$resultado2 = mysql_query($consulta2) or die(mysql_error());
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}

$consulta = "select * from altera_pista where datahora<'$datahorauser2' order by datahora desc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
	$operacionalidade = mysql_result($resultado,0,"operacional");
	if(($operacionalidade == 1) and ($pista_id_ultimo == 2))
	{
		$datahora_ultimo = mysql_result($resultado,0,"datahora");
		if($pista_agora != 2)
		{
			if(strtotime($datahora_ultimo)>=strtotime($datahorauser1))
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
			}
			else
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}
}

//caso o usuario selecionou uma datahora em que a pista ja estava operacional/////
$consulta = "select * from altera_pista where datahora >= '$datahorauser1' and operacional = 0 order by datahora asc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_maior = mysql_result($resultado,0,"pista_id");
	$operacional_maior = mysql_result($resultado,0,"operacional");
	$datahora_maior = mysql_result($resultado,0,"datahora");
	if(($operacional_maior == 0) and ($pista_id_maior == 2))
	{
		if(strtotime($datahora_maior)<=strtotime($datahorauser2))
		{
			$total_seg += strtotime($datahora_maior) - strtotime($datahorauser1);
		}
	}
}
//////////////////////////////////////////////////////////////////////////////////

/////////////////se a pista esta em uso agora////////////////////////////////////
if($praticavel == 1)
{
	//se a pista 33 estiver em uso
	if ($pista_agora==2)
	{
		//encontra ultimo registro colocando pista 15 operacional
		$consulta = "select * from altera_pista where operacional = 1 and datahora<='$datahorauser2' order by datahora desc limit 1";
		//echo $consulta;
		$resultado = mysql_query($consulta) or die(mysql_error());
		if(mysql_num_rows($resultado)>0)
		{
			$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
			$datahora_ultimo = mysql_result($resultado,0,"datahora");
			if($pista_id_ultimo == 2)
			{
				//echo "aqui";
				if(strtotime($datahora_ultimo)>strtotime($datahorauser1))
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
				}
				else
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
				}
			}
		}
	}
}

echo "Pista 33: ";
$tempo33 = $total_seg;
imprimetempo($total_seg);
echo "<br/>";

////////PISTA 11///////////////////////////////////////////////
$total_seg = 0;
//$consulta = "select * from altera_pista where pista_id=3 and operacional = 1 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
$consulta = "select * from altera_pista where pista_id=3 and operacional = 1 and datahora > '$datahorauser1' and datahora < '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_pista where pista_id=3 and operacional = 0 and datahora between '$datahora'  and '$datahorauser2' limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$resultado2 = mysql_query($consulta2) or die(mysql_error());
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}

$consulta = "select * from altera_pista where datahora<'$datahorauser2' order by datahora desc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
	$operacionalidade = mysql_result($resultado,0,"operacional");
	if(($operacionalidade == 1) and ($pista_id_ultimo == 3))
	{
		$datahora_ultimo = mysql_result($resultado,0,"datahora");
		if($pista_agora != 3)
		{
			if(strtotime($datahora_ultimo)>=strtotime($datahorauser1))
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
			}
			else
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}
}

//caso o usuario selecionou uma datahora em que a pista ja estava operacional/////
$consulta = "select * from altera_pista where datahora >= '$datahorauser1' and operacional = 0 order by datahora asc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_maior = mysql_result($resultado,0,"pista_id");
	$operacional_maior = mysql_result($resultado,0,"operacional");
	$datahora_maior = mysql_result($resultado,0,"datahora");
	if(($operacional_maior == 0) and ($pista_id_maior == 3))
	{
		if(strtotime($datahora_maior)<=strtotime($datahorauser2))
		{
			$total_seg += strtotime($datahora_maior) - strtotime($datahorauser1);
		}
	}
}
//////////////////////////////////////////////////////////////////////////////////

/////////////////se a pista esta em uso agora////////////////////////////////////
if($praticavel == 1)
{
	//se a pista 33 estiver em uso
	if ($pista_agora==3)
	{
		//encontra ultimo registro colocando pista 15 operacional
		$consulta = "select * from altera_pista where operacional = 1 and datahora<='$datahorauser2' order by datahora desc limit 1";
		//echo $consulta;
		$resultado = mysql_query($consulta) or die(mysql_error());
		if(mysql_num_rows($resultado)>0)
		{
			$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
			$datahora_ultimo = mysql_result($resultado,0,"datahora");
			if($pista_id_ultimo == 3)
			{
				//echo "aqui";
				if(strtotime($datahora_ultimo)>strtotime($datahorauser1))
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
				}
				else
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
				}
			}
		}
	}
}
	
echo "Pista 11: ";
$tempo11 = $total_seg;
imprimetempo($total_seg);
/////////////////////////////////////////////////////////////

echo "<br/>";

////////PISTA 29///////////////////////////////////////////////
$total_seg = 0;
//$consulta = "select * from altera_pista where pista_id=4 and operacional = 1 and datahora between '$datahorauser1' and '$datahorauser2' order by datahora asc";
$consulta = "select * from altera_pista where pista_id=4 and operacional = 1 and datahora > '$datahorauser1' and datahora < '$datahorauser2' order by datahora asc";
//echo $consulta;
//echo "<br/>";
//echo "<br/>";
$resultado = mysql_query($consulta) or die(mysql_error());
while($linha = mysql_fetch_assoc($resultado))
{
	$datahora = $linha['datahora'];
	$consulta2 = "select * from altera_pista where pista_id=4 and operacional = 0 and datahora between '$datahora'  and '$datahorauser2' limit 1";
	$resultado2 = mysql_query($consulta2) or die(mysql_error());
//	echo $consulta2;
//	echo "<br/>";
	if(mysql_num_rows($resultado2)>0)
	{
		$resultado2 = mysql_query($consulta2) or die(mysql_error());
		$datahora_prox = mysql_result($resultado2,0,"datahora");
		$total_seg += strtotime($datahora_prox)-strtotime($datahora);
	}
}

$consulta = "select * from altera_pista where datahora<'$datahorauser2' order by datahora desc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
	$operacionalidade = mysql_result($resultado,0,"operacional");
	if(($operacionalidade == 1) and ($pista_id_ultimo == 4))
	{
		$datahora_ultimo = mysql_result($resultado,0,"datahora");
		if($pista_agora != 4)
		{
			if(strtotime($datahora_ultimo)>=strtotime($datahorauser1))
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
			}
			else
			{
	//			echo "aqui1";
				$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
			}
		}
	}
}

//caso o usuario selecionou uma datahora em que a pista ja estava operacional/////
$consulta = "select * from altera_pista where datahora >= '$datahorauser1' and operacional = 0 order by datahora asc limit 1";
//echo $consulta;
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$pista_id_maior = mysql_result($resultado,0,"pista_id");
	$operacional_maior = mysql_result($resultado,0,"operacional");
	$datahora_maior = mysql_result($resultado,0,"datahora");
	if(($operacional_maior == 0) and ($pista_id_maior == 4))
	{
		if(strtotime($datahora_maior)<=strtotime($datahorauser2))
		{
			$total_seg += strtotime($datahora_maior) - strtotime($datahorauser1);
		}
	}
}
//////////////////////////////////////////////////////////////////////////////////

/////////////////se a pista esta em uso agora////////////////////////////////////
if($praticavel == 1)
{
	//se a pista 33 estiver em uso
	if ($pista_agora==4)
	{
		//encontra ultimo registro colocando pista 15 operacional
		$consulta = "select * from altera_pista where operacional = 1 and datahora<='$datahorauser2' order by datahora desc limit 1";
		//echo $consulta;
		$resultado = mysql_query($consulta) or die(mysql_error());
		if(mysql_num_rows($resultado)>0)
		{
			$pista_id_ultimo = mysql_result($resultado,0,"pista_id");
			$datahora_ultimo = mysql_result($resultado,0,"datahora");
			if($pista_id_ultimo == 4)
			{
				//echo "aqui";
				if(strtotime($datahora_ultimo)>strtotime($datahorauser1))
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahora_ultimo);
				}
				else
				{
					$total_seg += strtotime($datahorauser2)-strtotime($datahorauser1);
				}
			}
		}
	}
}
	
echo "Pista 29: ";
$tempo29 = $total_seg;
imprimetempo($total_seg);

echo "<br/>";
echo "Tempo total = ";
imprimetempo($tempo11+$tempo15+$tempo29+$tempo33);
/////////////////////////////////////////////////////////////
?>
</div>


    <script type="text/javascript">
      function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
		['Pista', 'Tempo de uso'],
		['15', <?php echo $tempo15; ?>],
		['33', <?php echo $tempo33; ?>],
		['11', <?php echo $tempo11; ?>],
		['29', <?php echo $tempo29; ?>]
        ]);
        new google.visualization.PieChart(document.getElementById('visualization')).
        draw(
          data,
          {
 		    title: "Uso das pistas",
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