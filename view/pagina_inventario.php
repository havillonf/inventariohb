<?php
	session_start();
	if(!isset($_SESSION['emp_cnpj'])){
		echo "<script>window.location.href = '../index.php'</script>";
	}else{
		$cnpj = $_SESSION['emp_cnpj'];
	}
	require_once '../controller/c_produto.php';
	require_once '../controller/c_fornecedor.php';
	$c_fornecedor = new c_fornecedor();
	$c_produto = new c_produto();
	$up_nome = '';
	$up_preco = '';
	$up_quantidade = '';
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
<!-- 		<script>
			$("document").ready(function(){
				$(".a-editar").click(function(){
					$("#editar").show();
				});
			});
		</script> -->
	</head>
	<body >
		<?php
			require_once 'navbar.php';
		?>

		<div class="container cc ">
			<p class="h1 py-3 font-weight-normal text-center">Dados - <span class="font-weight-light">Inventário</span></p>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th scope="col">Preço</th>
						<th scope="col">Quantidade</th>
						<th scope="col">Fornecedor</th>
						<th scope="col">Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = $c_fornecedor->pesquisar("SELECT pro_id as id, pro_nome as nome, pro_preco as preco, pro_quantidade as quantidade, tb_emp_for.ef_id FROM tb_produtos INNER JOIN tb_emp_for ON tb_produtos.ef_id = tb_emp_for.ef_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj'");
						while ($resultado = mysqli_fetch_assoc($sql)) {
							$id = $resultado['id'];
							$nome = $resultado['nome'];
							$preco = $resultado['preco'];
							$quantidade = $resultado['quantidade'];
							$ef_id = $resultado['ef_id'];
							$sqll = $c_fornecedor->pesquisar("SELECT for_nome FROM tb_fornecedor INNER JOIN tb_emp_for ON tb_fornecedor.for_id = tb_emp_for.for_id WHERE tb_emp_for.ef_id = $ef_id");

							while ($resultado = mysqli_fetch_assoc($sqll)) {
								$for_nome= $resultado['for_nome'];
							}
							echo "<tr>";
								echo "<th scope='row'>$id</th>";
								echo "<td>$nome</td>";
								echo "<td>$preco</td>";
								echo "<td>$quantidade</td>";
								echo "<td>$for_nome</td>";
								echo "
									<td>
										<a href='pagina_inventario.php?editar=$id' class='a-editar'>
											<button class='btn btn-success rounded-0' data-toggle='modal' data-target='#modalEditar'>Editar</button>
										</a>
										<a href='pagina_inventario.php?excluir=$id' class='btn btn-danger rounded-0'>Excluir</a>
									</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="w-100 text-center pb-2 pt-3">
			<button class="btn btn-warning rounded-0 text-white m-auto" data-toggle="modal" data-target="#modalCadastrar">Cadastrar</button>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="modalCadastrar">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Cadastro de produtos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="pagina_inventario.php" method="POST">
						<div class="modal-body">
							<input type="text" name="pro_nome" placeholder="Nome..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">
							<input name="pro_preco" placeholder="Preço unitário..." required="" class="mb-4 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" type="number" min="0.00" max="10000.00" step="0.01">
							<input type="number" name="pro_quantidade" placeholder="Quantidade..." required="" class="mb-4 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">
							<select name="pro_fornecedor" class="d-block inputlogin border-top-0 border-left-0 border-right-0 cnpj">
								<?php
									$sql = $c_fornecedor->pesquisar("SELECT tb_fornecedor.for_id as id, for_nome as nome FROM tb_fornecedor INNER JOIN tb_emp_for ON tb_fornecedor.for_id = tb_emp_for.for_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj'");
									while ($resultado = mysqli_fetch_assoc($sql)) {
										$id = $resultado['id'];
										$nome = $resultado['nome'];
										echo "<option value='$nome'>$nome</option>";
									}
								?>
							</select>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-outline-warning rounded-0">
								Salvar 
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		




		<?php
			if (isset($_POST['pro_nome'])) {
				$nome = $_POST['pro_nome'];
				$preco = $_POST['pro_preco'];
				$quantidade = $_POST['pro_quantidade'];
				$fornecedor = $_POST['pro_fornecedor'];
				$sql = $c_fornecedor->pesquisar("SELECT ef_id FROM tb_emp_for INNER JOIN tb_fornecedor ON tb_emp_for.for_id = tb_fornecedor.for_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_fornecedor.for_nome = '$fornecedor' AND tb_empresa.emp_cnpj = '$cnpj'");
				while ($resultado = mysqli_fetch_assoc($sql)) {
					$ef_id = $resultado['ef_id'];
				}
				$teste = $c_produto->inserir($nome, $preco, $quantidade, $ef_id);
				if ($teste) {
					echo "<script>alert('Cadastro efetuado!')</script>";
				}else{
					echo "<script>alert('Erro ao cadastrar!')</script>";
				}
				echo "<script>window.location.href = 'pagina_inventario.php'</script>";
			}


			if (isset($_GET['editar'])) {
				$up_id = $_GET['editar'];
				$sql = $c_fornecedor->pesquisar("SELECT pro_nome as nome, pro_preco as preco, pro_quantidade as quantidade, tb_emp_for.ef_id FROM tb_produtos INNER JOIN tb_emp_for ON tb_produtos.ef_id = tb_emp_for.ef_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_produtos.pro_id = '$up_id'");
				while ($resultado = mysqli_fetch_assoc($sql)) {
					$up_nome = $resultado['nome'];
					$up_preco = $resultado['preco'];
					$up_quantidade = $resultado['quantidade'];
					$up_ef_id = $resultado['ef_id'];
					$sqll = $c_fornecedor->pesquisar("SELECT for_nome FROM tb_fornecedor INNER JOIN tb_emp_for ON tb_fornecedor.for_id = tb_emp_for.for_id WHERE tb_emp_for.ef_id = $ef_id");

					while ($resultado = mysqli_fetch_assoc($sqll)) {
						$for_nome= $resultado['for_nome'];
					}
				}

			?>

			<div class="" id="editar">
			<div class="modal-dialog">
				<div class="modal-content border-0">
					<div class="modal-header">
						<h5 class="modal-title mx-auto">Editar produtos</h5>
						</button>
					</div>
					<form action="pagina_inventario.php?editar=<?php echo $up_id;?>" method="POST">
						<div class="modal-body">
							<input type="text" name="up_pro_nome" placeholder="Nome..." required="" value="<?php echo $up_nome?>" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">
							<input name="up_pro_preco" placeholder="Preço unitário..." required="" value="<?php echo $up_preco?>" class="mb-4 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" type="number" min="0.00" max="10000.00" step="0.01">
							<input type="number" name="up_pro_quantidade" placeholder="Quantidade..." required="" value="<?php echo $up_quantidade?>" class="mb-4 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">
							<select name="up_pro_fornecedor" class="d-block inputlogin border-top-0 border-left-0 border-right-0 cnpj">
								<?php
									$sql = $c_fornecedor->pesquisar("SELECT tb_fornecedor.for_id as id, for_nome as nome FROM tb_fornecedor INNER JOIN tb_emp_for ON tb_fornecedor.for_id = tb_emp_for.for_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj'");
									while ($resultado = mysqli_fetch_assoc($sql)) {
										$nome = $resultado['nome'];
										echo "<option value='$nome'>$nome</option>";
									}
								?>
							</select>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-outline-warning rounded-0 mx-auto">
								Salvar 
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>





			<?php
			}

			if(isset($_GET['excluir'])){
				$ex_id = $_GET['excluir'];
				$valida = $c_produto->excluir($ex_id);
				if ($valida) {
					echo "<script>alert('Deleção efetuada!')</script>";
				}else{
					echo "<script>alert('Erro ao deletar!')</script>";
				}
				echo "<script>window.location.href = 'pagina_inventario.php'</script>";
			}

			if (isset($_POST['up_pro_nome']) && isset($_GET['editar'])) {
				$up_id = $_GET['editar'];
				$up_nome = $_POST['up_pro_nome'];
				$up_preco = $_POST['up_pro_preco'];
				$up_quantidade = $_POST['up_pro_quantidade'];
				$up_fornecedor = $_POST['up_pro_fornecedor'];
				$up_sql = $c_fornecedor->pesquisar("SELECT ef_id FROM tb_emp_for INNER JOIN tb_fornecedor ON tb_emp_for.for_id = tb_fornecedor.for_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_fornecedor.for_nome = '$up_fornecedor' AND tb_empresa.emp_cnpj = '$cnpj'");
				while ($resultado = mysqli_fetch_assoc($up_sql)) {
					$up_ef_id = $resultado['ef_id'];
				}
				$teste = $c_produto->atualizar($up_id, $up_nome, $up_preco, $up_quantidade, $up_ef_id);
				if ($teste) {
					echo "<script>alert('Produto atualizado com sucesso!')</script>";
				}else{
					echo "<script>alert('Erro ao atualizar!')</script>";
				}
				 echo "<script>window.location.href = 'pagina_inventario.php'</script>";
			}

		?>
	</body>
</html>