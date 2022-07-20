<?php

	require_once('../model/m_empresa.php');
	require_once('../model/conexao.php');
	class c_empresa{

		private $empresa;
		private $con;

		function __construct(){
			$this->empresa = new m_empresa(null, null, null, null);
			$this->con = new conexao();
		}

		function inserir($emp_nome, $emp_cnpj, $emp_senha){
			$this->empresa->set_emp_nome($emp_nome);
			$this->empresa->set_emp_cnpj($emp_cnpj);
			$this->empresa->set_emp_senha($emp_senha);

			$valida = $this->con->executar(
				"INSERT INTO 
				tb_empresa (emp_nome, emp_cnpj, emp_senha) 
				VALUES 
				('$emp_nome', '$emp_cnpj', '$emp_senha')"
			);
			$this->con->desconectar();
			return $valida;
		}

		function pesquisar($query){
			$sql = $this->con->executar($query);
			return $sql;
		}

		function validar_login($emp_cnpj, $emp_senha){
			$query = "SELECT * FROM tb_empresa WHERE emp_cnpj = '$emp_cnpj' AND emp_senha = '$emp_senha'";
			$array = $this->pesquisar($query);
			$verificar = null;
			while($login = mysqli_fetch_assoc($array)){
				$verificar = $login;
			}
			if ($verificar != null) {
				return true;
			}else{
				return false;
			}
		}
	}

?>