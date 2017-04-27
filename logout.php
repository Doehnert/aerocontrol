<?php
include("includes/conecta.php");
include("includes/seguranca.php");

session_start();
$_SESSION = array();
session_destroy();

session_unset();
$_SESSION['usuario'] = "";
header('location: principal.php');
expulsaVisitante();

?>
