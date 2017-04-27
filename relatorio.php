<html>
<head>
<link rel="stylesheet" type="text/css" href="includes/estilos.css" />
<title>Relatorios</title>
<META NAME="Author" CONTENT="Elton">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<link rel="stylesheet" href="calendario/css/pikaday.css">
<link rel="stylesheet" href="calendario/css/site.css">
<script type="text/javascript" src="relogio/timepicker/jquery.min.js"></script>

<script type="text/javascript" src="relogio/timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/jquery.timepicker.css" />

<script type="text/javascript" src="relogio/timepicker/lib/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/lib/bootstrap-datepicker.css" />

<script type="text/javascript" src="relogio/timepicker/lib/site_timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="relogio/timepicker/lib/site_timepicker.css" />
</head>
<body>
<?php
include ("includes/conecta.php");
include("includes/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina();
$id_aeroporto = 1; //afonso pena

$usuario = $_SESSION['usuario'];
$org = $_SESSION['org'];

$consulta = "select datahora from altera_pista order by datahora asc limit 1";
$resultado = mysql_query($consulta) or die(mysql_error());
if(mysql_num_rows($resultado)>0)
{
	$data_inicio_operacao = mysql_result($resultado,0,"datahora");
}

$ano_agora = date("Y");
$mes_agora = date("m") - 1;
$dia_agora = date("d");

$ano_inicio = date("Y", strtotime($data_inicio_operacao));
$mes_inicio = date("m", strtotime($data_inicio_operacao))-1;
$dia_inicio = date("d", strtotime($data_inicio_operacao));

?>
<?php require_once('menu.php'); ?>
<p>
  <?php

?>
</p>
<!-- <div id="tabela_relatorio"> -->
  <!-- <div id="tudo_relatorio"> -->
    <div id="relatorio_abaixo_minimos">
      <form action="tempominimos.php" method="post">
        <!-- onSubmit="return checkdate(this.mydate)" -->
        <p class="fonte">Tempo total abaixo dos minimos para pouso a partir de:</p>
        <!--  <div class="flow-element">
  <input type="date" name="mydate" id="abaixo_minimos"/>
  			<div id="container"></div>
            </div>
  <input type="submit" value="submit" /><br />
  <span class="fonte">Formato valido: dd/mm/yyyy</span><br />
  
  -->
        <div>
          <div class="flow-element">
            <label for="datepicker">Data:</label>
            <input type="text" id="abaixo_minimos" name="abaixo_minimos" />
            <input type="submit" name="button" id="button" value="Enviar">
          </div>
          <div class="flow-element">
            <div id="container1"></div>
          </div>
        </div>
      </form>
    </div>
    <div id="relatorio_historico_mudancas">
      <form action="historico.php" method="post">
        <p class="fonte">Historico de mudancas a partir de:</p>
        <div>
          <div class="flow-element">
            <label for="datepicker">Data:</label>
            <input type="text" id="mydate" name="mydate" />
            <input type="submit" name="button" id="button" value="Enviar">
          </div>
          <div class="flow-element">
            <div id="container2"></div>
          </div>
        </div>
      </form>
    </div>
    <div id="relatorio_historico_erros">
      <form action="historicoauxilios.php" method="post">
        <p class="fonte">Historico de erros de auxilios a partir de:</p>
        <p>
        <div>
          <div class="flow-element">
            <label for="datepicker">Data:</label>
            <input type="text" id="mydate2" name="mydate2" />
            <input type="submit" name="button" id="button" value="Enviar">
          </div>
          <div class="flow-element">
            <div id="container3"></div>
          </div>
        </div>
        </p>
      </form>
    </div>
    <div id="relatorio_historico_erros">
      <form action="tempopista.php" method="post">
        <p class="fonte">Tempo de uso de cada pista desde a data:</p>
        <p>
        <div>
          <div class="flow-element">
            <label for="datepicker">Data:</label>
            <input type="text" id="mydate3" name="mydate3" />
            <input type="submit" name="button" id="button" value="Enviar">
          </div>
          <div class="flow-element">
            <div id="container4"></div>
          </div>
        </div>
        </p>
      </form>
    </div>
<div id="relatorio_historico_erros">
    <form action="historia_teto.php" method="post">
    <p class="fonte">Gráfico de mudanças de teto e visibilidade:</p>
    <p id="grafico">
	     <input type="text" class="date start" name="data_inicio"/>
         <input type="text" class="time start" name="hora_inicio"/> to
         <input type="text" class="time end" name="hora_fim"/>
         <input type="text" class="date end" name="data_fim"/>
         <input type="submit" name="button" id="button" value="Enviar">
    </p>
    <script src="relogio/timepicker/datepair.js"></script>
	<script src="relogio/timepicker/jquery.datepair.js"></script>
    <script>
        $('#grafico .time').timepicker({
            'showDuration': true,
            'timeFormat': 'H:i:s',
			'step': 1
        });

        $('#grafico .date').datepicker({
            'format': 'm/d/yyyy',
            'autoclose': true
        });

        $('#grafico').datepair();
    </script>
    </form>  
    </div>    
    <div id="relatorio_historico_erros">
    <form action="tempopista2.php" method="post">
    <p class="fonte">Tempo de uso de cada pista entre os intervalos:</p>
    <p id="tempopista2">
	     <input type="text" class="date start" name="data_inicio"/>
         <input type="text" class="time start" name="hora_inicio"/> to
         <input type="text" class="time end" name="hora_fim"/>
         <input type="text" class="date end" name="data_fim"/>
         <input type="submit" name="button" id="button" value="Enviar">
    </p>
    <script src="relogio/timepicker/datepair.js"></script>
	<script src="relogio/timepicker/jquery.datepair.js"></script>
    <script>
        $('#tempopista2 .time').timepicker({
            'showDuration': true,
            'timeFormat': 'H:i:s',
			'step': 1
        });

        $('#tempopista2 .date').datepicker({
            'format': 'm/d/yyyy',
            'autoclose': true
        });

        $('#tempopista2').datepair();
    </script>
    </form>  
    </div>  
<div id="relatorio_historico_erros">
    <form action="tempooper.php" method="post">
    <p class="fonte">Tempo em cada CMO entre:</p>
    <p id="tempooper">
	     <input type="text" class="date start" name="data_inicio"/>
         <input type="text" class="time start" name="hora_inicio"/> to
         <input type="text" class="time end" name="hora_fim"/>
         <input type="text" class="date end" name="data_fim"/>
         <input type="submit" name="button" id="button" value="Enviar">
    </p>
    <script src="relogio/timepicker/datepair.js"></script>
	<script src="relogio/timepicker/jquery.datepair.js"></script>
    <script>
        $('#tempooper .time').timepicker({
            'showDuration': true,
            'timeFormat': 'H:i:s',
			'step': 1
        });

        $('#tempooper .date').datepicker({
            'format': 'm/d/yyyy',
            'autoclose': true
        });

        $('#tempooper').datepair();
    </script>
    </form>  
    </div>      
    </div>
  <script type="text/javascript"  src="calendario/pikaday.js"></script> 
  <script type="text/javascript">

    var picker = new Pikaday(
    {
        field: document.getElementById('abaixo_minimos'),
        firstDay: 1,
        minDate: new Date(<?php echo $ano_inicio.", ".$mes_inicio.", ".$dia_inicio; ?>),
        maxDate: new Date(<?php echo $ano_agora.", ".$mes_agora.", ".$dia_agora; ?>),
        yearRange: [2000, 2020],
        bound: true,
        container: document.getElementById('container1'),
    });
	
	var picker2 = new Pikaday(
    {
        field: document.getElementById('mydate'),
        firstDay: 1,
        minDate: new Date(<?php echo $ano_inicio.", ".$mes_inicio.", ".$dia_inicio; ?>),
        maxDate: new Date(<?php echo $ano_agora.", ".$mes_agora.", ".$dia_agora; ?>),
        yearRange: [2000, 2020],
        bound: true,
        container: document.getElementById('container2'),
    });
	
	var picker3 = new Pikaday(
    {
        field: document.getElementById('mydate2'),
        firstDay: 1,
        minDate: new Date(<?php echo $ano_inicio.", ".$mes_inicio.", ".$dia_inicio; ?>),
        maxDate: new Date(<?php echo $ano_agora.", ".$mes_agora.", ".$dia_agora; ?>),
        yearRange: [2000, 2020],
        bound: true,
        container: document.getElementById('container3'),
    });	
	var picker4 = new Pikaday(
    {
        field: document.getElementById('mydate3'),
        firstDay: 1,
        minDate: new Date(<?php echo $ano_inicio.", ".$mes_inicio.", ".$dia_inicio; ?>),
        maxDate: new Date(<?php echo $ano_agora.", ".$mes_agora.", ".$dia_agora; ?>),
        yearRange: [2000, 2020],
        bound: true,
        container: document.getElementById('container4'),
    });
	
    </script>
</div>
<!--</div>-->
</body>
</html>