<?php
	session_start();
	if (isset($_SESSION['emp_cnpj'])) {
		echo "<script>window.location.href = 'pagina_inicial.php';</script>";
	}
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
	    		$(".cnpj").mask("99.999.999/9999-99");
				$(".a-cadastrar").click(function(){
					$(".login").hide();
					$(".cadastro").show();
				});
				$(".a-login").click(function(){
					$(".cadastro").hide();
					$(".login").show();
				});
			});
	    </script>
	</head>
	<?php
		require_once '../controller/c_empresa.php';
	?>
	<body class="bg-warning">
		<div class="container">
			<form class="col-xl-4 col-lg-6 mx-auto formulario shadow-lg login" action="login_cadastro.php" method="POST">
				<p class="display-4 mb-5 text-center text-warning border-left border-right border-warning">Login</p>
				<div class="form-group pb-4">
					<input type="text" class="d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" required placeholder="CPNJ:" name="log_emp_cnpj">
				</div>
				<div class="form-group pb-5">
					<input type="password" class="d-block border-top-0 border-left-0 border-right-0 inputlogin  senha" required placeholder="Senha:" name="log_emp_senha">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-warning text-white inputlogin rounded">Login</button>
					<a class="bg-white mx-auto nav-hover btn border-top-0 border-left-0 border-right-0 rounded-0 inputlogin mt-4 a-cadastrar ">Cadastrar</a>
				</div>
			</form>
			<form class="col-xl-4 col-lg-6 mx-auto formulario shadow-lg cadastro" action="login_cadastro.php" method="POST" style="display: none;">
				<p class="display-4 mb-5 text-center text-warning border-left border-right border-warning">Cadastro</p>
				<div class="form-group pb-4">
					<input type="text" class="d-block border-top-0 border-left-0 border-right-0 inputlogin senha" 
					required="" placeholder="Nome:" autofocus="" name="cad_emp_nome">
				</div>
				<div class="form-group pb-4">
					<input type="text" class="d-block border-top-0 border-left-0 border-right-0 inputlogin cnpj" 
					required="" placeholder="CPNJ:" autofocus="" name="cad_emp_cnpj">
				</div>
				<div class="form-group pb-5">
					<input type="password" class="d-block border-top-0 border-left-0 border-right-0 inputlogin senha" required placeholder="Senha:" name="cad_emp_senha">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-warning text-white inputlogin rounded">Cadastrar</button>
					<a class="bg-white mx-auto nav-hover btn border-top-0 border-left-0 border-right-0 rounded-0 inputlogin mt-4 a-cadastrar ">Login</a>
				</div>
			</form>
		</div>
		<?php
			$c_empresa = new c_empresa();
			if(isset($_POST['log_emp_cnpj']) && isset($_POST['log_emp_senha'])){
				$log_emp_cnpj = $_POST['log_emp_cnpj'];
				$log_emp_senha = $_POST['log_emp_senha'];
				$validar_login = $c_empresa->validar_login($log_emp_cnpj, $log_emp_senha);
				if ($validar_login) {
					$_SESSION['emp_cnpj'] = $log_emp_cnpj;
					$sql = $c_empresa->pesquisar("SELECT emp_nome FROM tb_empresa WHERE emp_cnpj = '$log_emp_cnpj'");
					while ($nome = mysqli_fetch_assoc($sql)) {
						$_SESSION['emp_nome'] = $nome['emp_nome'];	
					}
					echo "<script>alert('Login efetuado com sucesso!!'); window.location.href = 'pagina_inicial.php';</script>";	
				}else{
					echo "<script>alert('Dados incorretos!!'); window.location.href = '../index.php';</script>";
				}
			} 

			if (isset($_POST['cad_emp_nome']) && isset($_POST['cad_emp_cnpj']) && isset($_POST['cad_emp_senha'])) {
				$cad_emp_nome = $_POST['cad_emp_nome'];
				$cad_emp_cnpj = $_POST['cad_emp_cnpj'];
				$cad_emp_senha = $_POST['cad_emp_senha'];
				$validar_cadastro = $c_empresa->inserir($cad_emp_nome, $cad_emp_cnpj, $cad_emp_senha);
				if ($validar_cadastro) {
					$_SESSION['emp_cnpj'] = $cad_emp_cnpj;
					$_SESSION['emp_nome'] = $cad_emp_nome;
					echo "<script>alert('Cadastro efetuado com sucesso!!'); window.location.href = 'pagina_inicial.php';</script>";
				}else{
					echo "<script>alert('Esse cnpj já está cadastrado!!'); window.location.href = '../index.php';</script>";
				}
			}
		?>
		
	</body>
</html>