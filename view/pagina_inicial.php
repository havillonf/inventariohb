<?php
	session_start();
	if(!isset($_SESSION['emp_cnpj'])){
		echo "<script>window.location.href = '../index.php'</script>";
	}else{
		$cnpj = $_SESSION['emp_cnpj'];
	}
	require_once '../controller/c_produto.php';
	require_once '../controller/c_fornecedor.php';
	$c_produto = new c_produto();
	$c_fornecedor = new c_fornecedor();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="../css/main.css">
	    <title>Inventário</title>
	    <link rel="icon" href="../img/logo.png">
		<script src="../js/jquery.js"></script>
		<script src="../js/popper.js"></script>
		<script src="../js/bootstrap.js"></script>
	</head>
	<body>
		<?php
			require_once 'navbar.php';
		?>

		<section id="dados w-100">
			<p class="h1 text-center pt-3 pb-2 font-weight-normal">Dados - <span class="font-weight-light">Empresa</span></p>
			<hr class="w-75">
			<div class="container mt-4">
				<div class="row">
					<div class="col-4 div-dados mb-1">
						<div class="w-100 h-100 shadow">
							<p class="text-center mx-auto pt-3">Valor total do inventário</p>
							<hr class="w-75">
							<p class="text-center h3">- R$ 
								<?php
									$sql = $c_produto->pesquisar("SELECT sum(pro_preco * pro_quantidade) as valor FROM tb_produtos INNER JOIN tb_emp_for ON tb_produtos.ef_id = tb_emp_for.ef_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj'");
									while($valor = mysqli_fetch_assoc($sql)){
										echo $valor['valor'];
									}
							 	?> 
							-</p>
						</div>
					</div>
					<div class="col-4 div-dados mb-1">
						<div class="w-100 h-100 shadow">
							<p class="text-center mx-auto pt-3">Quantidade de produtos</p>
							<hr class="w-75">
							<p class="text-center h3">- 
								<?php
									$sql = $c_produto->pesquisar("SELECT count(pro_id) as quantidade FROM tb_produtos INNER JOIN tb_emp_for ON tb_produtos.ef_id = tb_emp_for.ef_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj'");
									while($quantidade = mysqli_fetch_assoc($sql)){
										echo $quantidade['quantidade'];
									}
							 	?>  
							-</p>
						</div>
					</div>
					<div class="col-4 div-dados mb-1">
						<div class="w-100 h-100 shadow">
							<p class="text-center mx-auto pt-3">Quantidade de fornecedores</p>
							<hr class="w-75">
							<p class="text-center h3">- 
								<?php
							 		$sql = $c_fornecedor->pesquisar("SELECT count(tb_fornecedor.for_id) as quantidade FROM tb_fornecedor INNER JOIN tb_emp_for ON tb_fornecedor.for_id = tb_emp_for.for_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj'");
									while($quantidade = mysqli_fetch_assoc($sql)){
										echo $quantidade['quantidade'];
									}
							 	?> 
							-</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
			require_once 'footer-bottom.php';
		?>
	</body>
</html>