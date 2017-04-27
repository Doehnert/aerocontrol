<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	
background-color:#f8fbff;
	
}
#login {
	width:400px;
	height:200px;
	border:solid 1px #000;
	top:50%;
	left:50%;
	margin-top:-100px;
	margin-left:-200px;
	position:absolute;
	background-color:#FFF;

}
#login #formlogin {
		text-align:right;
		margin-right:120px;
		margin-top:40px;
		font-family:'Calibri';
		
}
#login #formlogin #enviar {
	
margin-right:70px;
}
#login img {
	
	border-bottom:solid 1px #000;
}
</style>
</head>

<body>
<div id="login">
<img src="imagens/topo.jpg" width="auto" height="auto" longdesc="http://www.dtceact.intraer/portal/" />
<form id="formlogin" action="envialogin.php" method="post">
Usuário: 
  <input type="text" maxlength="30" size="20" name="usuario" /> <br  />
Senha: <input type="password" maxlength="30" size="20" name="senha" /> <br />
<input id="enviar" type="submit" value="Enviar" />
</form>
</div>
</body>
</html>