<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="includes/estilos.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="includes/googlecharts/jsapi.js"></script>
<script type="text/javascript" src="includes/googlecharts/uds_api_contents.js"></script> 
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
//$mydate = $_POST["mydate"];
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
echo "<h2>Gráfico de teto e visibilidade entre: $datahorauser1 e $datahorauser2</h2>";
//$date = str_replace('/', '-', $mydate);
//$var = date('Y-m-d', strtotime($mydate));
//$datahora = $var." 00:00:00";

$consulta = "select * from altera_aeroporto where datahora >= '$datahorauser1' and datahora <= '$datahorauser2' ORDER BY `altera_aeroporto`.`datahora` asc";
//echo $consulta;
$resultado = mysql_query($consulta);
?>
<script type="text/javascript">
      function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
		['Data', 'Teto(ft)', 'Visibilidade(m)'],
<?php
		if(mysql_num_rows($resultado)>0)
		{
			while($linha = mysql_fetch_assoc($resultado))
			{
				$data = $linha['datahora'];
				$data = date("d/m H:i", strtotime($data));
				$teto = $linha['teto'];
				$visibilidade = $linha['visibilidade'];
				echo "['$data', $teto, $visibilidade],";
			}
		}
?>		
        ]);
        new google.visualization.LineChart(document.getElementById('visualization')).
        draw(
          data,
          {
            title: "Teto",
            curveType: "function",
            title: "Teto / Visibilidade",
			vAxis: { viewWindowMode: "pretty" },
            width: 3200, height: 400,
			chartArea:{left:"5%",top:"10%",width:"30%",height:"300"},
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
</span>
<p>&nbsp;</p>
</body>
</html>