<?php
	session_start();
	if(!isset($_SESSION['emp_cnpj'])){
		echo "<script>window.location.href = '../index.php'</script>";
	}else{
		$cnpj = $_SESSION['emp_cnpj'];
	}
	require_once '../controller/c_fornecedor.php';
	$c_fornecedor = new c_fornecedor();
	$up_nome = "";
	$up_cidade = "";
	$up_bairro = "";
	$up_logradouro = "";
	$up_endereco = "";
	$up_numero = "";
	$up_cnpj = "";
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
		<script src="../js/jquery.pack.js"></script>
		<script src="../js/jquery.maskedinput.pack.js"></script>
	    <script type="text/javascript">
	    	$(document).ready(function(){
	    		$(".cnpj-input").mask("99.999.999/9999-99");
			});
	    </script>
	</head>
	<body>
		<?php
			require_once 'navbar.php';
		?>

		<div class="container cc">
			<p class="h1 py-3 font-weight-normal text-center">Dados - <span class="font-weight-light">Fornecedores</span></p>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th scope="col">Cidade</th>
						<th scope="col">Bairro</th>
						<th scope="col">Logradouro</th>
						<th scope="col">Endereço</th>
						<th scope="col">Número</th>
						<th scope="col">CNPJ</th>
						<th scope="col">Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = $c_fornecedor->pesquisar("SELECT tb_fornecedor.for_id as id, for_nome as nome, for_cidade as cidade, for_bairro as bairro, for_logradouro as logradouro, for_endereco as endereco, for_numero as numero, for_complemento, for_cnpj as cnpj FROM tb_fornecedor INNER JOIN tb_emp_for ON tb_fornecedor.for_id = tb_emp_for.for_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj'");
						while ($resultado = mysqli_fetch_assoc($sql)) {
							$sel_id = $resultado['id'];
							$sel_nome = $resultado['nome'];
							$sel_cidade = $resultado['cidade'];
							$sel_bairro = $resultado['bairro'];
							$sel_logradouro = $resultado['logradouro'];
							$sel_endereco = $resultado['endereco'];
							$sel_numero = $resultado['numero'];
							$sel_cnpj = $resultado['cnpj'];
							echo "<tr>";
								echo "<th scope='row'>$sel_id</th>";
								echo "<td>$sel_nome</td>";
								echo "<td>$sel_cidade</td>";
								echo "<td>$sel_bairro</td>";
								echo "<td>$sel_logradouro</td>";
								echo "<td>$sel_endereco</td>";
								echo "<td>$sel_numero</td>";
								echo "<td>$sel_cnpj</td>";
								echo "
									<td>
										<a href='pagina_fornecedor.php?editar=$sel_id' class='a-editar'>
											<button class='btn btn-success rounded-0' data-toggle='modal' data-target='#modalEditar'>Editar</button>
										</a>
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
						<h5 class="modal-title">Cadastro de fornecedores</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="pagina_fornecedor.php" method="POST">
						<div class="modal-body">
							<input type="text" name="for_nome" placeholder="Nome..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">

							<input type="text" name="for_cidade" placeholder="Cidade..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">

							<input type="text" name="for_bairro" placeholder="Bairro..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">

							<input type="text" name="for_logradouro" placeholder="Logradouro..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">

							<input type="text" name="for_endereco" placeholder="Endereco..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">

							<input type="number" name="for_numero" placeholder="Número..." required="" class="mb-4 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj">

							<input type="text" name="for_cnpj" placeholder="CNPJ..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj cnpj-input">
							
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
			if(isset($_POST['for_nome'])){
				$for_nome = $_POST['for_nome'];
				$for_cidade = $_POST['for_cidade'];
				$for_bairro = $_POST['for_bairro'];
				$for_logradouro = $_POST['for_logradouro'];
				$for_endereco = $_POST['for_endereco'];
				$for_numero = $_POST['for_numero'];
				$for_cnpj = $_POST['for_cnpj'];

				$valida = $c_fornecedor->inserir($for_nome, $for_cidade, $for_bairro, $for_logradouro, $for_endereco, $for_numero, $for_cnpj);
				if ($valida) {
					$sqlw = $c_fornecedor->pesquisar("SELECT emp_id FROM tb_empresa WHERE emp_cnpj = '$cnpj'");
					while ($resultadow = mysqli_fetch_assoc($sqlw)) {
						$emp_id = $resultadow['emp_id'];
					}
					$sql = $c_fornecedor->pesquisar("SELECT for_id FROM tb_fornecedor WHERE for_cnpj = '$for_cnpj'");
					while ($resultado = mysqli_fetch_assoc($sql)) {
						$for_id = $resultado['for_id'];
					}
					$c_fornecedor->pesquisar("INSERT INTO tb_emp_for (emp_id, for_id) VALUES ($emp_id, $for_id)");
					echo "<script>alert('Cadastro efetuado!')</script>";
				}else{
					echo "<script>alert('CNPJ já cadastrado!')</script>";
				}
				echo "<script>window.location.href = 'pagina_fornecedor.php';</script>";
			}


			if (isset($_GET['editar'])) {
				$up_id = $_GET['editar'];
				$sql = $c_fornecedor->pesquisar("SELECT for_nome, for_cidade, for_bairro, for_logradouro, for_endereco, for_numero, for_cnpj FROM tb_fornecedor INNER JOIN tb_emp_for ON tb_fornecedor.for_id = tb_emp_for.for_id INNER JOIN tb_empresa ON tb_emp_for.emp_id = tb_empresa.emp_id WHERE tb_empresa.emp_cnpj = '$cnpj' AND tb_fornecedor.for_id = '$up_id'");
				while ($resultado = mysqli_fetch_assoc($sql)) {
					$up_nome = $resultado['for_nome'];
					$up_cidade = $resultado['for_cidade'];
					$up_bairro = $resultado['for_bairro'];
					$up_logradouro = $resultado['for_logradouro'];
					$up_endereco = $resultado['for_endereco'];
					$up_numero = $resultado['for_numero'];
					$up_cnpj = $resultado['for_cnpj'];
				}

			?>

			<div class="" id="editar">
			<div class="modal-dialog">
				<div class="modal-content border-0">
					<div class="modal-header">
						<h5 class="modal-title mx-auto">Editar fornecedores</h5>
						</button>
					</div>
					<form action="pagina_fornecedor.php?editar=<?php echo $up_id;?>" method="POST">
						<div class="modal-body">
							<input type="text" name="up_for_nome" placeholder="Nome..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" value="<?php echo $up_nome;?>">

							<input type="text" name="up_for_cidade" placeholder="Cidade..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" value="<?php echo $up_cidade;?>">

							<input type="text" name="up_for_bairro" placeholder="Bairro..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" value="<?php echo $up_bairro;?>">

							<input type="text" name="up_for_logradouro" placeholder="Logradouro..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" value="<?php echo $up_logradouro;?>">

							<input type="text" name="up_for_endereco" placeholder="Endereco..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" value="<?php echo $up_endereco;?>">

							<input type="number" name="up_for_numero" placeholder="Número..." required="" class="mb-4 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" value="<?php echo $up_numero;?>">

							<input type="text" name="up_for_cnpj" placeholder="CNPJ..." required="" class="mb-4 mt-2 d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj cnpj-input" value="<?php echo $up_cnpj;?>">
							
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

		if(isset($_POST['up_for_nome']) && isset($_GET['editar'])){
			$up_for_id = $_GET['editar'];
			$up_for_nome = $_POST['up_for_nome'];
			$up_for_cidade = $_POST['up_for_cidade'];
			$up_for_bairro = $_POST['up_for_bairro'];
			$up_for_logradouro = $_POST['up_for_logradouro'];
			$up_for_endereco = $_POST['up_for_endereco'];
			$up_for_numero = $_POST['up_for_numero'];
			$up_for_cnpj = $_POST['up_for_cnpj'];
			$valida = $c_fornecedor->atualizar($up_for_id, $up_for_nome, $up_for_cidade, $up_for_bairro, $up_for_logradouro, $up_for_endereco, $up_for_numero, $up_for_cnpj);
			if ($valida) {
					echo "<script>alert('Fornecedor atualizado com sucesso!')</script>";
				}else{
					echo "<script>alert('Erro ao atualizar!')</script>";
				}
				echo "<script>window.location.href = 'pagina_fornecedor.php'</script>";
		}


		
		?>
	</body>
</html>