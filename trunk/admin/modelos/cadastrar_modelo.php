<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
    require_once($path_relative.'verifica.php');
	include_once($path_classes.'fla_modelos.class.php');
	include_once($path_classes.'fla_marcas.class.php');
	
	$objModelos = new fla_modelos();
	$objMarcas  = new fla_marcas();
	
	$des_modelo = "";
	$des_marca  = "";
	$cod_modelo = "";
	$ind_disponivel = 0;
	$ind_popular	= 0;
	
	if ($_POST) {
		$des_modelo = $_POST['des_modelo'];
		$cod_marca  = $_POST['cod_marca'];
		$cod_modelo = $_POST['cod_modelo'];
		
		$ind_disponivel = 0;
		if (isset($_POST['ind_disponivel'])) {
			$ind_disponivel = $_POST['ind_disponivel'];
		}
		
		$ind_popular = 0;
		if (isset($_POST['ind_popular'])) {
			$ind_popular = $_POST['ind_popular'];
		}		
		
		$objModelos->set_des_modelo($des_modelo);
		$objModelos->set_cod_marca($cod_marca);		
		$objModelos->set_cod_modelo($cod_modelo);
		$objModelos->set_ind_disponivel($ind_disponivel);
		$objModelos->set_ind_popular($ind_popular);
		$objModelos->cadastraModelos($objModelos);
		
		$msgRetorno = 'Veiculo cadastrado com sucesso';
	}		
	
	$arrMarcas = $objMarcas->buscaMarcas($objMarcas);		
	
	if ($ind_disponivel == '1') {
		$checked_disponivel = "checked";
	} else {
		$checked_disponivel = "";
	}

	if ($ind_popular == '1') {
		$checked_popular = "checked";
	} else {
		$checked_popular = "";
	}									
?>
<html>
	<head>
		<title>Cadastro de cores - Administra��o - Flanela Sys</title>
		<link href="../../images/style.css" rel="stylesheet" type="text/css" />
		<link href="../images/style.css" rel="stylesheet" type="text/css" />

                <style type="text/css">
                /* menu styles */
                #jsddm
                {	margin: 0;
                        padding: 0}

                        #jsddm li
                        {	float: left;
                                list-style: none;
                                font: 12px Tahoma, Arial}

                        #jsddm li a
                        {	display: block;
                                background: #324143;
                                padding: 5px 12px;
                                text-decoration: none;
                                border-right: 1px solid white;
                                width: 100px;
                                color: #EAFFED;
                                white-space: nowrap}

                        #jsddm li a:hover
                        {	background: #24313C}

                                #jsddm li ul
                                {	margin: 0;
                                        padding: 0;
                                        position: absolute;
                                        visibility: hidden;
                                        border-top: 1px solid white}

                                        #jsddm li ul li
                                        {	float: none;
                                                display: inline}

                                        #jsddm li ul li a
                                        {	width: auto;
                                                background: #A9C251;
                                                color: #24313C}

                                        #jsddm li ul li a:hover
                                        {	background: #8EA344}
                </style>
                <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
				<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>
                <script type="text/javascript">
                var timeout         = 500;
                var closetimer		= 0;
                var ddmenuitem      = 0;

                function jsddm_open()
                {	jsddm_canceltimer();
                        jsddm_close();
                        ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

                function jsddm_close()
                {	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

                function jsddm_timer()
                {	closetimer = window.setTimeout(jsddm_close, timeout);}

                function jsddm_canceltimer()
                {	if(closetimer)
                        {	window.clearTimeout(closetimer);
                                closetimer = null;}}

                $(document).ready(function()
                {	$('#jsddm > li').bind('mouseover', jsddm_open);
                        $('#jsddm > li').bind('mouseout',  jsddm_timer);});

                document.onclick = jsddm_close;
				
				
				function setaModelo(modelo) {
					document.getElementById("codigo_modelo").value = modelo;
				}				
                </script>		
	</head>
	<body>
		<div class="content">
<?php
			include_once("../../cabecalho.php");
?>
			<div class="data">
				<h1> M�dulo de veiculos </h1>				
				<div class="success"> <?php echo $msgRetorno; ?> </div>
				<form method="POST" action="">
					<table>
						<tr>
							<td> Descri��o: <input type="text" name="des_modelo" value="<?php echo $des_modelo; ?>"></td>
						</tr>
						<tr>
							<td colspan="4"> 
								 Marca:
								 <select name="cod_marca" id="cod_marca">
									<option value=""></option>
<?php
									foreach ($arrMarcas as $marca) {
											if ($cod_marca == $marca['cod_marca']) {
												echo sprintf('<option selected="selected" value="%s">%s</option>',$marca['cod_marca'],$marca['des_marca']).chr(10);
											} else {
												echo sprintf('<option value="%s">%s</option>',$marca['cod_marca'],$marca['des_marca']).chr(10);
											}
									}									
?>								 
								 </select>
							</td>
						</tr>
						<tr>
							<td>
								Disponivel: <input type="checkbox" <?php echo $checked_disponivel; ?> value="1" name="ind_disponivel" id="ind_disponivel">
							</td>
						</tr>						
						<tr>						
						
						<tr>
							<td>
								Carro popular: <input type="checkbox" <?php echo $checked_popular; ?> value="1" name="ind_popular" id="ind_popular">
							</td>
						</tr>			
						</tr>
						<tr>
							<td>
								<input type="submit" name="_submit" id="_submit" value="Salvar">
							</td>
						</tr>
						<tr>
							<td>
								<a href="listar_modelo.php"> Voltar </a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>
					