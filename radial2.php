<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$conecta = mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("localicades", $conecta) or die(mysql_error());
mysql_set_charset("UTF8", $conecta);

$t_loc = $_POST["t_loc"];

class localidade
{
	public $nome;
	public $longhora;
	public $longmin;
	public $longseg;
	public $lathora;
	public $latmin;
	public $latseg;
	
	public function __construct($nome, $longhora, $longmin, $longseg, $lathora, $latmin, $latseg)
	{
		$this->nome = $nome;
		$this->longhora = $longhora;
		$this->longmin = $longmin;
		$this->longseg = $longseg;
		$this->lathora = $lathora;
		$this->latmin = $latmin;
		$this->latseg = $latseg;
	}
}

$sbct = new localidade("SBCT", -25, -31, -54, -49, -10, -34);

$consulta = "select * from localidades where indicativo = '$t_loc'";
$resultado = mysql_query($consulta);
$longhora = mysql_result($resultado,0,"longhora");
$longmin = mysql_result($resultado,0,"longmin");
$longseg = mysql_result($resultado,0,"longseg");
$lathora = mysql_result($resultado,0,"lathora");
$latmin = mysql_result($resultado,0,"latmin");
$latseg = mysql_result($resultado,0,"latseg");

$dest = new localidade($t_loc, $longhora, $longmin, $longseg, $lathora, $latmin, $latseg);

$totalseglatsbct = $sbct->latseg+$sbct->latmin*60+$sbct->lathora*60*60;
$totalseglatdest = $dest->latseg+$dest->latmin*60+$dest->lathora*60*60;
$totalseglongsbct = $sbct->longseg+$sbct->longmin*60+$sbct->longhora*60*60;
$totalseglongdest = $dest->longseg+$dest->longmin*60+$dest->longhora*60*60;

$coordx = abs($totalseglongsbct-$totalseglongdest);
$coordy = abs($totalseglatsbct-$totalseglatdest);
$angulorad = atan($coordx/$coordy);
//$angulorad = atan(83376/17227);
$angulograus = ($angulorad/pi())*180;
$quad1 = 0;
$quad2 = 0;
if($totalseglongdest>$totalseglongsbct)
{
	$quad1 = 1;
}
else
{
	$quad1 = 0;
}
if($totalseglatdest>$totalseglatsbct)
{
	$quad2 = 1;
}
else
{
	$quad2 = 0;
}
$quadrante = 0;
if($quad1 = 1 and $quad2 = 1)
{
	$quadrante = 1;
}
elseif($quad1 = 1 and $quad2 = 0)
{
	$quadrante = 2;
}
elseif($quad1 = 0 and $quad2 = 0)
{
	$quadrante = 3;
}
elseif($quad1 = 0 and $quad2 = 1)
{
	$quadrante = 4;
}
$radialideal = 0;
switch($quadrante)
{
	case 1:
		$radialideal = 90-$angulograus;
		break;
	case 2:
		$radialideal = 90+$angulograus;
		break;
	case 3:
		$radialideal = 270-$angulograus;
		break;
	case 4:
		$radialideal = 270+$angulograus;
}
echo "Radial ideal de saída é: ".$radialideal." graus, quadrante: ".$quadrante;

$fixos = array(90.35,162.89,200.33,205.91,214.51,267.05,317.73,1.43,21.44);
$nomefixo = "";

function closest($array, $number)
{
	sort($array);
	foreach($array as $a)
	{
		if($a >= $number) return $a;
	}
	return end($array);
}
$radialfixosaida = closest($fixos, $radialideal);
switch($radialfixosaida)
{
	case 90.35:
		$nomefixo = "Paranagua";
		break;
	case 162.89:
		$nomefixo = "Alvox";
		break;
	case 200.33:
		$nomefixo = "Nafil";
		break;
	case 205.91:
		$nomefixo = "Amero";
		break;
	case 214.51:
		$nomefixo = "Tigda";
		break;
	case 267.05:
		$nomefixo = "Punto";
		break;
	case 317.73:
		$nomefixo = "Elosa";
		break;
	case 1.43:
		$nomefixo = "Madri";
		break;
	case 21.44:
		$nomefixo = "Ilsum";
		break;
}
echo "<br>O fixo de saida mais proximo é: ".$nomefixo." cuja radial de saida é: ".$radialfixosaida;

?>
</body>
</html>