<div id="tudo">
<div id="topo">
<img src="imagens/topo_fundo.jpg" width="1366" height="200" />
</div>
<div id="menu">
<div class="drop">
<ul class="drop_menu">
<?php
if($org=="FAB")
{
	echo "<li><a href='principal.php'>Início</a></li>";
}
else
{
	echo "<li><a href='visualizar.php'>Início</a></li>";
}
?>
<li>
<?php
if($org=="FAB")
{
	echo ("<a href='#'>Cadastrar</a>");
}
else if ($org=="Infraero")
{
	echo "";
}
?>
	<ul>
		<li><a href='principal.php'>Condições Atuais</a></li>
    </ul>
</li>
<li><a href='#'>Visualizar</a>
	<ul>
		<li><a href='visualizar.php'>Condições Atuais</a></li>
        <li><a href="galeria/slideshow/banner.php" target="_blank">Banner Rotativo</a></li>
    </ul>
</li>
<li><a href='#'>Relatórios</a>
	<ul>
	<li><a href='turno.php'>Turno Atual</a></li>
	<li><a href='relatorio.php'>Tempo Abaixo dos Mínimos</a></li>
	<li><a href='relatorio.php'>Histórico de Mudanças</a></li>
	<li><a href='relatorio.php'>Erros de Auxílios</a></li>
    <li><a href='relatorio.php'>Tempo de uso de pistas</a></li>
    <li><a href='relatorio.php'>Tempo em CMO</a></li>
	</ul>
</li>
<?php
if($org=="FAB")
{
echo "<li><a href='#'>Configurações</a>";
echo "<ul>";
echo "<li><a href='config.php'>Alterar Turnos</a></li>";
echo "</ul>";
echo "</li>";
}
?>
</ul>
</div>
<div id="logout">Bem vindo,<?php echo $usuario ?> | <a href="logout.php">Sair</a></div>
</div>