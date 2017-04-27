<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>aerocontrol</title>
<style type="text/css">
/* CSSTerm.com Simple Horizontal DropDown CSS menu */
#tudo {
	position:absolute;
	left:50%;
	margin-left:-683px;
	width:1366px;
	height:auto;
	top:0px;
	border:solid 1px #000000;
}
#menu {
	width:1366px;
	height:30px;
	border-top:solid 1px #000000;
	border-bottom: solid 1px #000000;
	background-color:#2A98DF;
}
#logout {
	width:100px;
	height:30px;
	float:right;
}
/*
#logout a {
	padding-top:9px;
}
*/
.drop_menu {
	background:#2A98DF;
	padding:0;	
	margin:0;
	list-style-type:none;
	height:30px;
	width:899px;
	float:left;
}
.drop_menu li { float:left; }
.drop_menu li a {
	padding:9px 20px;
	display:block;
	color:#FFFFFF;
	text-decoration:none;
	font-weight:900;
	font:12px arial, verdana, sans-serif;
}

/* Submenu */
.drop_menu ul {
	position:absolute;
	left:-9999px;
	top:-9999px;
	list-style-type:none;
}
.drop_menu li:hover { position:relative; background:#ACD7F2; }
.drop_menu li:hover ul {
	left:0px;
	top:30px;
	background:#ACD7F2;
	padding:0px;
}

.drop_menu li:hover ul li a {
	padding:5px;
	display:block;
	width:168px;
	text-indent:15px;
	background-color:#ACD7F2;
}
.drop_menu li:hover ul li a:hover { background:#ACD7F2; }
</style>
</head>

<body>
<div id="tudo">
<img src="imagens/topo_fundo.jpg" width="1366px" height="166px" />
<div id="menu">
<div class="drop">
<ul class="drop_menu">
<li><a href='#'>Início</a></li>
<li><a href='#'>Equipamento</a>
	<ul>
	<li><a href='#'>Cadastrar</a></li>
	<li><a href='galeria/slideshow/banner.php' target='_blank'>Visualizar</a></li>
	</ul>
</li>
<li><a href='#'>Relatórios</a>
	<ul>
	<li><a href='#'>Turno Atual</a></li>
	<li><a href='#'>Tempo Abaixo dos Mínimos</a></li>
	<li><a href='#'>Histórico de Mudanças</a></li>
	<li><a href='#'>Erros de Auxílios</a></li>
	</ul>
</li>
</ul>
</div>
<div id="logout"><a href="#">Sair</a></div>
</div>
<form action="salva.php" method="post">
<?php
include ("includes/conecta.php");
$consulta = "SELECT operacional FROM auxilio";
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
$loc15 = mysql_result($resultado, 0, "operacional");
$gl15 = mysql_result($resultado, 1, "operacional");
$loc33 = mysql_result($resultado, 2, "operacional");
$gl33 = mysql_result($resultado, 3, "operacional");
$als15 = mysql_result($resultado, 4, "operacional");
$flash15 = mysql_result($resultado, 5, "operacional");
$thr15 = mysql_result($resultado, 6, "operacional");
$tdz15 = mysql_result($resultado, 7, "operacional");
$rcl = mysql_result($resultado, 8, "operacional");
$blz1533 = mysql_result($resultado, 9, "operacional");
$blz1129 = mysql_result($resultado, 10, "operacional");
$blztwy = mysql_result($resultado, 11, "operacional");
$om15 = mysql_result($resultado, 12, "operacional");
$mm15 = mysql_result($resultado, 13, "operacional");
$im15 = mysql_result($resultado, 14, "operacional");
$om33 = mysql_result($resultado, 15, "operacional");
$mm33 = mysql_result($resultado, 16, "operacional");
$im33 = mysql_result($resultado, 17, "operacional");
$vor = mysql_result($resultado, 18, "operacional");
$dme = mysql_result($resultado, 19, "operacional");
$rvr15 = mysql_result($resultado, 20, "operacional");
$rvrmedio = mysql_result($resultado, 21, "operacional");
$rvr33 = mysql_result($resultado, 22, "operacional");
$radar = mysql_result($resultado, 23, "operacional");

$id_aeroporto = 1; //afonso pena

$c_loc15 = 0;
$c_gl15 = 0;
$c_loc33 = 0;
$c_gl33 = 0;
$c_als15 = 0;
$c_flash15 = 0;
$c_thr15 = 0;
$c_tdz15 = 0;
$c_rcl = 0;
$c_blz1533 = 0;
$c_blz1129 = 0;
$c_blztwy = 0;
$c_om15 = 0;
$c_mm15 = 0;
$c_im15 = 0;
$c_om33 = 0;
$c_mm33 = 0;
$c_im33 = 0;
$c_vor = 0;
$c_dme = 0;
$c_rvr15 = 0;
$c_rvrmedio = 0;
$c_rvr33 = 0;
$c_radar = 0;

$consulta = "SELECT operacional FROM pista";
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta a tabela pista");
$pista15 = mysql_result($resultado, 0, "operacional");
$pista33 = mysql_result($resultado, 1, "operacional");
$pista11 = mysql_result($resultado, 2, "operacional");
$pista29 = mysql_result($resultado, 3, "operacional");

$consulta = "SELECT * FROM aeroporto WHERE id = ".$id_aeroporto; //seleciona dados do afonso pena (id = 1)
$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
$operacionalidade = mysql_result($resultado, 0, "operacionalidade");
$teto = mysql_result($resultado, 0, "teto");
$visibilidade = mysql_result($resultado, 0, "visibilidade");
$nome = mysql_result($resultado, 0, "nome");
$cat2 = mysql_result($resultado, 0, "cat2");
$baixavis = mysql_result($resultado, 0, "baixavis");
$placoar = mysql_result($resultado, 0, "placoar");
?>
<table width="604" border="1" align="center">
  <tr>
    <td colspan="9" align="center">
    <?php
		echo ("Aeroporto: ".$nome);
	?>
    </td>
    </tr>
  <tr>
    <td colspan="3" align="center">Auxílios</td>
    <td colspan="3" align="center">Pistas em uso</td>
    <td colspan="3" align="center">Condições</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>OK</td>
    <td>ERRO</td>
    <td>&nbsp;</td>
    <td>Sim</td>
    <td>Não</td>
    <td>&nbsp;</td>
    <td width="46">&nbsp;</td>
    <td width="93">&nbsp;</td>
  </tr>
  <tr>
    <td width="60">LOC 15</td>
    <td width="24"><p>
      <label>
        <input name="r_loc15" type="radio" id="r_loc15_0" value="1"
        <?php
		if ($loc15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
      </label>
      <br />
    </p></td>
    <td width="41"><label for="r_loc15"></label>
<label for="cloc15">
  <input type="radio" name="r_loc15" value="0" id="r_loc15_1"
        <?php
		if ($loc15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
</label></td>
    <td width="46">Pista 15</td>
    <td width="102">
        <input name="r_pista15" type="radio" id="r_pista15_0" value="1"
        <?php
		if ($pista15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
    </td>
    <td width="27">
      <input type="radio" name="r_pista15" value="0" id="r_pista15_1"
        <?php
		if ($pista15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </td>
    <td width="107">Operacionalidade</td>
    <td colspan="2"><label for="s_operacionalidade"></label>
      <select name="s_operacionalidade" id="s_operacionalidade">
        <option value="0"
        <?php
		if ($operacionalidade==0)
		{
	        echo("selected='selected'");
		}
		?>
        >VFR</option>
        <option value="1"
        <?php
		if ($operacionalidade==1)
		{
	        echo("selected='selected'");
		}
		?>
        >IFR</option>
        <option value="2"
        <?php
		if ($operacionalidade==2)
		{
	        echo("selected='selected'");
		}
		?>
        >Abaixo minimos</option>
      </select></td>
    </tr>
  <tr>
    <td>GL 15</td>
    <td>
        <label>
        <input name="r_gl15" type="radio" id="r_gl15_0" value="1"
        <?php
		if ($gl15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
        </label>
      <br /></td>
    <td><label for="gl15">
      <input type="radio" name="r_gl15" value="0" id="r_gl15_1"
        <?php
		if ($gl15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>Pista 33</td>
    <td>
        <input name="r_pista33" type="radio" id="r_pista33_0" value="1"
        <?php
		if ($pista33==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
    </td>
    <td>
        <input name="r_pista33" type="radio" id="r_pista33_0" value="0"
        <?php
		if ($pista33==0)
		{
	        echo("checked='checked'");
		}
		?>
		/>
    </td>
    <td>Teto</td>
    <td colspan="2"><label for="t_teto"></label>
      <input name="t_teto" type="text" id="t_teto"
      <?php
	  echo ("value=".$teto);
	  ?>
      /></td>
    </tr>
  <tr>
    <td>LOC 33</td>
    <td>
          <label>
        <input name="r_loc33" type="radio" id="r_loc33_0" value="1"
        <?php
		if ($loc33==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
          </label>
      <br /></td>
    <td><label for="loc33">
      <input type="radio" name="r_loc33" value="0" id="r_loc33_1"
        <?php
		if ($loc33==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>Pista 11</td>
    <td>
        <input name="r_pista11" type="radio" id="r_pista11_0" value="1"
        <?php
		if ($pista11==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
    </td>
    <td>
        <input name="r_pista11" type="radio" id="r_pista11_0" value="0"
        <?php
		if ($pista11==0)
		{
	        echo("checked='checked'");
		}
		?>
		/>
    </td>
    <td>Visibilidade</td>
    <td colspan="2"><label for="t_visibilidade"></label>
      <input name="t_visibilidade" type="text" id="t_visibilidade"
      <?php
	  echo ("value=".$visibilidade);
	  ?>
	  /></td>
    </tr>
  <tr>
    <td>GL 33</td>
    <td>
          <label>
        <input name="r_gl33" type="radio" id="r_gl33_0" value="1"
        <?php
		if ($gl33==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
          </label>
      <br /></td>
    <td><label for="gl33">
      <input type="radio" name="r_gl33" value="0" id="r_gl33_1"
        <?php
		if ($gl33==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>Pista 29</td>
    <td>
        <input name="r_pista29" type="radio" id="r_pista29_0" value="1"
        <?php
		if ($pista29==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
    </td>
    <td>
        <input name="r_pista29" type="radio" id="r_pista29_0" value="0"
        <?php
		if ($pista29==0)
		{
	        echo("checked='checked'");
		}
		?>
		/>
    </td>
    <td>&nbsp;</td>
    <td><label for="c_cat2">Sim</label></td>
    <td>Não</td>
  </tr>
  <tr>
    <td>ALS 15</td>
    <td>
              <label>
        <input name="r_als15" type="radio" id="r_als15_0" value="1"
        <?php
		if ($als15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="als15">
      <input type="radio" name="r_als15" value="0" id="r_als15_1"
        <?php
		if ($als15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>
    <select name="s_pistaemuso" id="s_pistaemuso">
      <option value="0"
      <?php
		if ($pista15==1)
		{
	        echo("selected='selected'");
		}
		?>
      >Pista 15/11</option>
      <option value="1"
      <?php
		if ($pista33==1)
		{
	        echo("selected='selected'");
		}
		?>
      >Pista 33/29</option>
    </select>
    </td>
    <td>&nbsp;</td>
    <td>CAT2</td>
    <td><input name="r_cat2" type="radio" id="r_cat2" value="1"
    	<?php
		if ($cat2==1)
		{
		    echo("checked='checked'");
		}
		?>
		/></td>
    <td>
    <input name="r_cat2" type="radio" id="r_cat2" value="0"
    	<?php
		if ($cat2==0)
		{
		    echo("checked='checked'");
		}
		?>
		/>
    </td>
    </tr>
  <tr>
    <td>FLASH 15</td>
    <td>
              <label>
        <input name="r_flash15" type="radio" id="r_flash15_0" value="1"
        <?php
		if ($flash15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="flash15">
      <input type="radio" name="r_flash15" value="0" id="r_flash15_1"
        <?php
		if ($flash15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Baixa Visibilidade</td>
    <td><input name="r_baixavis" type="radio" id="r_baixavis" value="1"
    	<?php
		if ($baixavis==1)
		{
		    echo("checked='checked' ");
		}
		?>
		/></td>
    <td>
    <input name="r_baixavis" type="radio" id="r_baixavis" value="0"
    	<?php
		if ($baixavis==0)
		{
		    echo("checked='checked' ");
		}
		?>
		/>
    </td>
    </tr>
  <tr>
    <td>THR 15</td>
    <td>
              <label>
        <input name="r_thr15" type="radio" id="r_thr15_0" value="1"
        <?php
		if ($thr15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="thr15">
      <input type="radio" name="r_thr15" value="0" id="r_thr15_1"
        <?php
		if ($thr15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Placoar</td>
    <td>
    <input name="r_placoar" type="radio" id="r_placoar" value="1"
    	<?php
		if ($placoar==1)
		{
		    echo("checked='checked' ");
		}
		?>
		/>
    </td>
    <td>
    <input name="r_placoar" type="radio" id="r_placoar" value="0"
    	<?php
		if ($placoar==0)
		{
		    echo("checked='checked' ");
		}
		?>
		/>
    </td>
    </tr>
  <tr>
    <td>TDZ 15</td>
    <td>
              <label>
        <input name="r_tdz15" type="radio" id="r_tdz15_0" value="1"
        <?php
		if ($tdz15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="tdz15">
      <input type="radio" name="r_tdz15" value="0" id="r_tdz15_1"
        <?php
		if ($tdz15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>RCL</td>
    <td>
        <label>
        <input name="r_rcl" type="radio" id="r_rcl_0" value="1"
        <?php
		if ($rcl==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
        </label>
      <br /></td>
    <td><label for="rcl">
      <input type="radio" name="r_rcl" value="0" id="r_rcl_1"
        <?php
		if ($rcl==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>BLZ 15/33</td>
    <td>
          <label>
        <input name="r_blz1533" type="radio" id="r_blz1533_0" value="1"
        <?php
		if ($blz1533==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
          </label>
      <br /></td>
    <td><label for="blz1533">
      <input type="radio" name="r_blz1533" value="0" id="r_blz1533_1"
        <?php
		if ($blz1533==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>BLZ 11/29</td>
    <td>
              <label>
        <input name="r_blz1129" type="radio" id="r_blz1129_0" value="1"
        <?php
		if ($blz1129==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="blz1129">
      <input type="radio" name="r_blz1129" value="0" id="r_blz1129_1"
        <?php
		if ($blz1129==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>BLZ TWY</td>
    <td>
              <label>
        <input name="r_blztwy" type="radio" id="r_blztwy_0" value="1"
        <?php
		if ($blztwy==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="blztwy">
      <input type="radio" name="r_blztwy" value="0" id="r_blztwy_1"
        <?php
		if ($blztwy==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>OM 15</td>
    <td>
              <label>
        <input name="r_om15" type="radio" id="r_om15_0" value="1"
        <?php
		if ($om15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="om15">
      <input type="radio" name="r_om15" value="0" id="r_om15_1"
        <?php
		if ($om15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MM 15</td>
    <td>
              <label>
        <input name="r_mm15" type="radio" id="r_mm15_0" value="1"
        <?php
		if ($mm15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="mm15">
      <input type="radio" name="r_mm15" value="0" id="r_mm15_1"
        <?php
		if ($mm15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>IM 15</td>
    <td>
              <label>
        <input name="r_im15" type="radio" id="r_im15_0" value="1"
        <?php
		if ($im15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="im15">
      <input type="radio" name="r_im15" value="0" id="r_im15_1"
        <?php
		if ($im15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>OM 33</td>
    <td>
              <label>
        <input name="r_om33" type="radio" id="r_om33_0" value="1"
        <?php
		if ($om33==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="om33">
      <input type="radio" name="r_om33" value="0" id="r_om33_1"
        <?php
		if ($om33==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MM 33</td>
    <td>
              <label>
        <input name="r_mm33" type="radio" id="r_mm33_0" value="1"
        <?php
		if ($mm33==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="mm33">
      <input type="radio" name="r_mm33" value="0" id="r_mm33_1"
        <?php
		if ($mm33==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>IM 33</td>
    <td>
              <label>
        <input name="r_im33" type="radio" id="r_im33_0" value="1"
        <?php
		if ($im33==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="im33">
      <input type="radio" name="r_im33" value="0" id="r_im33_1"
        <?php
		if ($im33==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>VOR</td>
    <td>
              <label>
        <input name="r_vor" type="radio" id="r_vor_0" value="1"
        <?php
		if ($vor==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="vor">
      <input type="radio" name="r_vor" value="0" id="r_vor_1"
        <?php
		if ($vor==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DME</td>
    <td>
              <label>
        <input name="r_dme" type="radio" id="r_dme_0" value="1"
        <?php
		if ($dme==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="dme">
      <input type="radio" name="r_dme" value="0" id="r_dme_1"
        <?php
		if ($dme==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>RVR 15</td>
    <td>
              <label>
        <input name="r_rvr15" type="radio" id="r_rvr15_0" value="1"
        <?php
		if ($rvr15==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="rvr15">
      <input type="radio" name="r_rvr15" value="0" id="r_rvr15_1"
        <?php
		if ($rvr15==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>RVR MEDIO</td>
    <td>
              <label>
        <input name="r_rvrmedio" type="radio" id="r_rvrmedio_0" value="1"
        <?php
		if ($rvrmedio==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="rvrmedio">
      <input type="radio" name="r_rvrmedio" value="0" id="r_rvrmedio_1"
        <?php
		if ($rvrmedio==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>RVR 33</td>
    <td>
              <label>
        <input name="r_rvr33" type="radio" id="r_rvr33_0" value="1"
        <?php
		if ($rvr33==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label>
      <br /></td>
    <td><label for="rvr33">
      <input type="radio" name="r_rvr33" value="0" id="r_rvr33_1"
        <?php
		if ($rvr33==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>RADAR</td>
    <td>
              <label>
        <input name="r_radar" type="radio" id="r_radar_0" value="1"
        <?php
		if ($radar==1)
		{
	        echo("checked='checked'");
		}
		?>
		/>
              </label></td>
    <td><label for="radar">
      <input type="radio" name="r_radar" value="0" id="r_radar_1"
        <?php
		if ($radar==0)
		{
	        echo("checked='checked'");
		}
		?>
        />
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
<table width="606" border="1" align="center">
  <tr>
    <th width="159" scope="col">Procedimentos</th>
    <th width="118" scope="col">Visibilidade</th>
    <th width="94" scope="col">Teto</th>
    <th width="207" scope="col">Observações</th>
  </tr>
  <tr>
    <td><?php
	$consultaaeroporto = "SELECT teto, visibilidade FROM aeroporto WHERE id=".$id_aeroporto;
	$resultadoaeroporto = mysql_query($consultaaeroporto);
	$tetoaeroporto = mysql_result($resultadoaeroporto,0,"teto");
	$visibilidadeaeroporto = mysql_result($resultadoaeroporto,0,"visibilidade");

	//primeiro passo: pegar ids de procedimento desse aeroporto
	$consulta = "SELECT * from depende_aeroporto WHERE aeroporto_id = ".$id_aeroporto;
	$resultado = mysql_query($consulta, $conecta) or die("Erro na consulta ao banco de dados");
	$indice = 0;
	
	$flag_rvr = 0;			// diz se o rvr funciona
	$flag_als = 0;			// diz se o als funciona

	
	while ($linha = mysql_fetch_assoc($resultado))
	{
		/*********DEFINIÇÂO DE FLAGS*****************/
		$flag_operacional = 0;	// diz se a pista que estou testando está em uso
								// e depois diz se todos os auxilios estao ok
		/********************************************/
		
		$procid[$indice] = $linha["procedimento_id"];
		//segundo: ids de procedimento dessa pista e desse aeroporto
		//achar a pista associada com esse procedimento
		$consulta2 = "SELECT pista_id FROM depende_pista WHERE procedimento_id = ".$procid[$indice];
		$resultado2 = mysql_query($consulta2);
		$pista = mysql_result($resultado2, 0, "pista_id");
		//ver se essa pista esta sendo usada
		$consulta3 = "SELECT operacional FROM pista WHERE id = ".$pista;
		$resultado3 = mysql_query($consulta3);
		$pista_operacional = mysql_result($resultado3,0,"operacional");
		if($pista_operacional == 0) //se a pista não esta em uso, sai do laço para testar proximo procedimento
		{
			continue;
		}
		else
		{
			//terceiro: verificar se todos os auxilios dos ids que restaram estao com operacionalidade = 1
			$consulta4 = "SELECT auxilio_id FROM depende_auxilio WHERE procedimento_id = ".$procid[$indice];
			$resultado4 = mysql_query($consulta4);
			$indice2 = 0;
			$flag_operacional = 1;
			while ($linha4 = mysql_fetch_assoc($resultado4))
			{
				//verifica se o auxilio esta ativo
				$auxid[$indice2] = $linha4["auxilio_id"]; //essa variavel tem o id dos auxilios que o procedimento usa
				$consulta5 = "SELECT operacional FROM auxilio WHERE id = ".$auxid[$indice2];
				$resultado5 = mysql_query($consulta5);
				$operacional = mysql_result($resultado5,0,"operacional");
				switch($auxid[$indice2])
				{
					case 21: //rvr 15
						if($operacional==1)
						{
							$flag_rvr = 1;
						}
						else
						{
							$operacional = 1; //para checar o rvr medio (se o proc usar)
						}
						break;
					case 22:
						if($operacional==1)
						{
							$flag_rvr = 1;
						}
						else
						{
							$operacional = 1; //para checar o rvr 33 (se o proc usar)
						}
						break;
					case 23:
						if($operacional==1)
						{
							$flag_rvr = 1;
						}
						break;	
				}
/*				if((($auxid[$indice2]==21) or ($auxid[$indice2]==22) or ($auxid[$indice2]==23)) and $operacional==1)
				{
					$flag_rvr = 1; //o procedimento usa rvr e o rvr esta ativo
					echo $auxid[$indice2];
				}
				elseif($auxid[$indice2]==21) //aqui testa se todos os rvr estao com erro
				{
					//$indice2++;
					//continue;
					$operacional = 1;
				}
				elseif($auxid[$indice2]==22)
				{
					//$indice2++;
					//echo $consulta5;
					//continue;
					$operacional = 1;
				}
				*/
				if(($auxid[$indice2]==5) and $operacional==1)
				{
					$flag_als = 1;
				}
				if($operacional == 0)
				{
					$flag_operacional = 0;
					break;
				}
				//
				$indice2++;
			}
			if($flag_operacional == 1) //todos os auxilios requeridos estão ok
			{
				$consultaprocedimento = "SELECT nome, obs, vmin, tmin, rvrmin, alsmin, rvralsmin FROM procedimento WHERE id=".$procid[$indice];
				$resultadoprocedimento = mysql_query($consultaprocedimento);
				
				$nomeproc = mysql_result($resultadoprocedimento,0,"nome");
				$obs = mysql_result($resultadoprocedimento,0,"obs");
				$vismin = mysql_result($resultadoprocedimento,0,"vmin");
				$tetomin = mysql_result($resultadoprocedimento,0,"tmin");
				$rvrmin = mysql_result($resultadoprocedimento,0,"rvrmin");
				$alsmin = mysql_result($resultadoprocedimento,0,"alsmin");
				$rvralsmin = mysql_result($resultadoprocedimento,0,"rvralsmin");
				$menor = 0; //menor valor de visibilidade do procedimento

				if($tetomin>$tetoaeroporto)
				{
					break;
				}
				if(($flag_rvr==1) and ($flag_als==1))
				{
					$menor = $rvralsmin;
					if($rvralsmin>$visibilidadeaeroporto)
					{
						break;
					}
				}
				if(($flag_rvr==1) and ($flag_als==0))
				{
					$menor = $rvrmin;
					if($rvrmin>$visibilidadeaeroporto)
					{
						break;
					}
				}
				if(($flag_rvr==0) and ($flag_als==1))
				{
					$menor = $alsmin;
					if($alsmin>$visibilidadeaeroporto)
					{
						break;
					}
				}
				if(($flag_rvr==0) and ($flag_als==0))
				{
					$menor = $vismin;
					if($vismin>$visibilidadeaeroporto)
					{
						break;
					}
				}
/*				$consultanome = "SELECT nome FROM procedimento WHERE id = ".$procid[$indice];
				$resultadonome = mysql_query($consultanome);
				$nomeproc = mysql_result($resultadonome,0,"nome");*/
				//echo $flag_als;
				//echo $flag_rvr;
				echo ("<tr>");
				echo ("<td>".$nomeproc."</td>");
				echo ("<td>".$menor."</td>");
				echo ("<td>".$tetomin."</td>");
				echo ("<td>".$obs."</td>");
				echo ("</tr>");
			}
			else
			{
				//echo ("algum auxilio requerido esta com erro");
			}
			$indice++;
		}
	}
			
	//quarto: os ids restantes verificar se o teto minimo é menor ou igual ao teto do aeroporto e visibilidade mínima é menor ou  igual ao do aeroporto
	?></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="atualizar" id="atualizar" value="Atualizar" /></td>
    </tr>
</table>
<p>&nbsp;</p>
</form>
</div>
</body>
</html>