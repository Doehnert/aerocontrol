<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
/*
$usuario = "";
$senha = "";
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

include "includes/conecta.php";

$sql_select = "SELECT * FROM usuario WHERE usuario='$usuario' AND senha='$senha'";
$comando_sql = mysql_query($sql_select);
while ($registro = mysql_fetch_array($comando_sql)) {
	$usuario_consulta = $registro["usuario"];
	$email = $registro["email"];
	$organizacao = $registro["organizacao"];
	$identidade = $registro["identidade"];
	$id = $registro["id"];
	$senha_consulta = $registro["senha"];

}

if ($usuario == $usuario_consulta and $senha == $senha_consulta) {
	
	session_start();
	$_SESSION["usuario"] = $usuario;
	$_SESSION["senha"] = $senha;
	$_SESSION["organizacao"] = $organizacao;
	$_SESSION["id"] = $id;
	$ip = $_SERVER["REMOTE_ADDR"];
	echo "Bem Vindo";
		
	header("Location:principal.php");
}
else {


header("Location:login.php");


}
*/
include("includes/conecta.php");
include("includes/seguranca.php");
protegePagina();

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$senha = md5((isset($_POST['senha'])) ? $_POST['senha'] : '');
$_SESSION['usuario'] = $usuario;


/*$consulta = "select organizacao from usuario where usuario = $usuario";
$resultado = mysql_query($consulta);
$org = mysql_result($resultado,0,"organizacao");
$_SESSION['org'] = $org;
*/
// Utiliza uma função criada no seguranca.php pra validar os dados digitados
if (validaUsuario($usuario, $senha) == true)
{
  // O usuário e a senha digitados foram validados, manda pra página interna
  if($_SESSION['org']=="FAB")
  {
	  header("Location: principal.php");
  }
  else if($_SESSION['org']=="Infraero")
  {
	  header("Location: visualizar.php");
  }
} else {
// O usuário e/ou a senha são inválidos, manda de volta pro form de login
// Para alterar o endereço da página de login, verifique o arquivo seguranca.php
expulsaVisitante();

}

}




?>
</body>
</html>