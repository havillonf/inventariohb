<?php

	require_once('../model/m_produto.php');
	require_once('../model/conexao.php');

	class c_produto{

		private $produto;
		private $con;


		

		function __construct(){
			$this->produto = new m_produto(null, null, null, null, null);
			$this->con = new conexao();
		}

		public function inserir($pro_nome, $pro_preco, $pro_quantidade, $ef_id){
			$this->produto->set_pro_nome($pro_nome);
			$this->produto->set_pro_preco($pro_preco);
			$this->produto->set_pro_quantidade($pro_quantidade);
			$this->produto->set_ef_id($ef_id);

			$valida = $this->con->executar(
				"INSERT INTO 
				tb_produtos	(pro_nome, pro_preco, pro_quantidade, ef_id) 
				VALUES 
				('$pro_nome', '$pro_preco', '$pro_quantidade', '$ef_id')"
			);
			return $valida;
		}

		public function atualizar($pro_id, $pro_nome, $pro_preco, $pro_quantidade, $ef_id){
			$this->produto->set_pro_id($pro_id);
			$this->produto->set_pro_nome($pro_nome);
			$this->produto->set_pro_preco($pro_preco);
			$this->produto->set_pro_quantidade($pro_quantidade);
			$this->produto->set_ef_id($ef_id);
			$valida = $this->con->executar(
				"UPDATE 
				tb_produtos 
				SET 
				pro_nome = '$pro_nome', pro_preco = '$pro_preco', pro_quantidade = '$pro_quantidade', ef_id = '$ef_id' WHERE pro_id = '$pro_id'"
			);
			return $valida;
		}

		function pesquisar($query){
			$sql = $this->con->executar($query);
			return $sql;
		}
 
		public function excluir($pro_id){
			$this->produto->set_pro_id($pro_id);
			$valida = $this->con->executar("DELETE FROM tb_produtos WHERE pro_id = '$pro_id'");
			return $valida;
		}
	}

?>