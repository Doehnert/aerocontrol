<?php

include ("includes/conecta.php");

date_default_timezone_set("UTC");
$id_aeroporto = 1; //afonso pena

$usuario = 'automatico';
$_SESSION['usuarioID'] = $usuario;

error_reporting(E_ALL);

echo "<h2>TCP/IP Connection</h2>\n";

/* Get the port for the WWW service. */
$service_port = 2020;

/* Get the IP address for the target host. */
$address = '10.170.34.176';

/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
} else {
    echo "OK.\n";
}

echo "Attempting to connect to '$address' on port '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
    echo "OK.\n";
}

$in = "HEAD / HTTP/1.1\r\n";
$in .= "Host: www.example.com\r\n";
$in .= "Connection: Close\r\n\r\n";
$out = "";

//echo "Sending HTTP HEAD request...";
//socket_write($socket, $in, strlen($in));
//echo "OK.\n";

$texto = "";
echo "Reading response:\n\n";
$data = socket_read($socket, 10000, PHP_NORMAL_READ);

$procuravis10aesq = strstr($data, "VIS10A");
//echo $procuravis10aesq;
$procuravis10adir = strstr($procuravis10aesq, "VIS10M", true);
//echo $procuravis10adir;
$procuravaloresq = strstr($procuravis10adir, "N");
//echo $procuravaloresq;

function soNumero($str) {
	return
	preg_replace("/[^0-9]/", "", $str);
}

$valorfinal = soNumero($procuravaloresq);

$consulta = "SELECT * FROM aeroporto WHERE id = '$id_aeroporto'"; //seleciona dados do afonso pena (id = 1)
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
$operacionalidade = mysql_result($resultado, 0, "operacionalidade");
$teto = mysql_result($resultado, 0, "teto");
$visibilidade = mysql_result($resultado, 0, "visibilidade");
$cat = mysql_result($resultado, 0, "cat");
$baixavis = mysql_result($resultado, 0, "baixavis");
$placoar = mysql_result($resultado, 0, "placoar");
$procedimentoaeroporto = mysql_result($resultado, 0, "procedimento_id");

$atualiza = "UPDATE aeroporto SET visibilidade = ".$valorfinal." WHERE id = 1";
mysql_query($atualiza, $conecta) or die ("Não foi possível executar a modificacao.");
echo "<br/>";
echo "<br/>";
echo $atualiza;

echo "<br/>";
echo "<br/>";
echo "<br/>";
$date = date("Y-m-d");
$time = date("H:i:s");

$insere = "INSERT INTO `aerocontrol`.`altera_aeroporto` (`usuario_id`, `aeroporto_id`, `date`, `time`, `teto`, `visibilidade`, `operacionalidade`, `cat`, `baixavis`, `placoar`, `procedimento_id`) VALUES ('5', '$id_aeroporto', '$date', '$time', '$teto', '$valorfinal', '$operacionalidade', '$cat', '$baixavis', '$placoar', '$procedimentoaeroporto')";
echo $insere;
$resultado = mysql_query($insere) or die("Falha inserindo tabela altera_aeroporto");


//echo $out;

//$filtravis10aesq = strstr($out, "VIS10A");



/*
echo "<br/><br/>";
$pos = strpos("VIS10A", $out);
echo "<br/>";
if($pos == false)
{
	echo "Nao achou";
}
else
{
	echo "Posicao: ".$pos;
}
*/
echo "<br/>";
echo "<br/>";
echo "Closing socket...";
socket_close($socket);
echo "OK.\n\n";
?>
