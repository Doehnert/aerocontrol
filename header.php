<?php
$usuario = $_SESSION['usuario'];
$org = $_SESSION['org'];

?>
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Aerocontrol</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="login.php">Principal</a></li>
      <li><a href="escolha.php">Menu</a></li>
      <li class="dropdown"></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="senha.php"><span class="glyphicon glyphicon-user"></span>Logado como : }
	  </a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Sair</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid">