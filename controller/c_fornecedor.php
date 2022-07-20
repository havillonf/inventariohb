<?php

	require_once('../model/m_fornecedor.php');
	require_once('../model/conexao.php');

	class c_fornecedor{

		private $fornecedor;
		private $con;

		function __construct(){
			$this->fornecedor = new m_fornecedor(null, null, null, null, null, null, null, null, null);
			$this->con = new conexao();
		}

		public function inserir($for_nome, $for_cidade, $for_bairro, $for_logradouro, $for_endereco, $for_numero, $for_cnpj){
			
			$this->fornecedor->set_for_nome($for_nome);
			$this->fornecedor->set_for_cidade($for_cidade);
			$this->fornecedor->set_for_bairro($for_bairro);
			$this->fornecedor->set_for_logradouro($for_logradouro);
			$this->fornecedor->set_for_endereco($for_endereco);
			$this->fornecedor->set_for_numero($for_numero);
			$this->fornecedor->set_for_cnpj($for_cnpj);
			$valida = $this->con->executar("INSERT INTO tb_fornecedor (for_nome, for_cidade, for_bairro, for_logradouro, for_endereco, for_numero, for_cnpj) VALUES ('$for_nome', '$for_cidade', '$for_bairro', '$for_logradouro', '$for_endereco', '$for_numero', '$for_cnpj')"
			);
			return $valida;
		}

		public function atualizar($for_id, $for_nome, $for_cidade, $for_bairro, $for_logradouro, $for_endereco, $for_numero, $for_cnpj){
			$this->fornecedor->set_for_id($for_id);
			$this->fornecedor->set_for_nome($for_nome);
			$this->fornecedor->set_for_cidade($for_cidade);
			$this->fornecedor->set_for_bairro($for_bairro);
			$this->fornecedor->set_for_logradouro($for_logradouro);
			$this->fornecedor->set_for_endereco($for_endereco);
			$this->fornecedor->set_for_numero($for_numero);
			$this->fornecedor->set_for_cnpj($for_cnpj);
			$valida = $this->con->executar("UPDATE 
				tb_fornecedor 
				SET 
				for_nome = '$for_nome', for_cidade = '$for_cidade', for_bairro = '$for_bairro', for_logradouro = '$for_logradouro', for_endereco = '$for_endereco', for_numero = '$for_numero', for_cnpj = '$for_cnpj' 
				WHERE 
				for_id = $for_id"
			);
			return $valida;
		}

		function pesquisar($query){
			$sql = $this->con->executar($query);
			return $sql;
		}
	}

?>