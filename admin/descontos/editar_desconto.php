<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_descontos.class.php');
	require_once($path_relative.'verifica.php');
	$objDescontos     = new fla_descontos();
	
	if (isset($_GET['cod_desconto'])) {
		$cod_desconto = $_GET["cod_desconto"];
	} else {
		$cod_desconto = 0;
	}

	if (!empty($_POST)) {
		$cod_desconto = $_POST['cod_desconto'];
		$des_desconto = $_POST['des_desconto'];
		$val_desconto = $_POST['val_desconto'];
		if (isset($_POST['ind_disponivel'])) {
			$ind_disponivel    = $_POST['ind_disponivel'];
		} else {
		    $ind_disponivel    = 0;
		}
		
		$objDescontos->set_cod_desconto($cod_desconto);
		$objDescontos->set_des_desconto($des_desconto);
		$objDescontos->set_ind_disponivel($ind_disponivel);
		$objDescontos->set_val_desconto($val_desconto);
		
		if (empty($cod_desconto)) {
			$objDescontos->insereDescontos($objDescontos);
			$msgRetorno = 'Desconto cadastrado com sucesso!';
		} else {
			$objDescontos->editaDescontos($objDescontos);
			$msgRetorno = 'Dados atualizados com sucesso!';
		}
?>
	<script language="javascript">
		alert('<?php echo $msgRetorno; ?>');
		window.location = 'index.php';
	</script>
<?php		
		
	}
	
	if ($cod_desconto > 0) {
		$objDescontos->set_cod_desconto($cod_desconto);
		$arrDesconto = $objDescontos->buscaDescontos($objDescontos);
	}

?>
<html>
	<head>
		<title>Cadastro de descontos - Administra��o - Flanela Sys</title>
		<link href="../../images/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>
		<script type="text/javascript">
			jQuery(function($){   
				$("#val_desconto").mask("99.99");

			
			$("#btnSalvar").click(function() {
				var msg = '';
				if($("#des_desconto").val() == "") {
					msg += 'Informe a descri��o do desconto. \n';
				} 
				
				if($("#val_desconto").val() == "" || $("#val_desconto").val() == 0) {
					msg += 'Informe o valor de desconto. \n';
				}
				
				if (msg != '')
					alert('Por favor: \n'+msg);
				else
					$("#frm").submit();
			});			
			
			});	
		</script>		
	</head>
	<body>
		<div class="content">
<?php
			include_once("../../cabecalho.php");
?>
			<form method="POST" actio05.00n="" id="frm">
			<div class="data">
				<h1> M�dulo de descontos </h1>				
					<table>
						<tr>
							<td width="30%"> Descri��o </td>
							<td> <input class="text" type="text" value="<?php echo $arrDesconto[0]['des_desconto']; ?>" id="des_desconto" name="des_desconto"></td>
						</tr>
						
						<tr>
							<td> Valor R$ </td>
							<td> <input class="text" type="text" value="<?php echo str_pad($arrDesconto[0]['val_desconto'], 5, "0", STR_PAD_LEFT);  ?>" id="val_desconto" name="val_desconto"></td>
						</tr>		

						<tr>
							<td> Dispon�vel </td>
							<td> <input class="text" type="checkbox" value="1" id="ind_disponivel" name="ind_disponivel" <?php echo $arrDesconto[0]['ind_disponivel'] == 1 ? 'checked' : ''; ?>></td>
						</tr>	
						
						<tr>
						    <td>
						        <input type="hidden" name="cod_desconto" value="<?php echo $cod_desconto; ?>">
						        <input type="button" value="Salvar" id="btnSalvar">
						    </td>
						</tr>
					</table>
				</form>	
			</div>
		</div>
	</body>
</html>