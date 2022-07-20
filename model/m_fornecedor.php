<?php

	class m_fornecedor{

		private $for_id;
		private $for_nome;
		private $for_cidade;
		private $for_bairro;
		private $for_logradouro;
		private $for_endereco;
		private $for_numero;
		private $for_complemento;
		private $for_cnpj;

		function __construct($for_id, $for_nome, $for_cidade, $for_bairro, $for_logradouro, $for_endereco, $for_numero, $for_complemento, $for_cnpj){
			$this->for_id = $for_id;
			$this->for_nome = $for_nome;
			$this->for_cidade = $for_cidade;
			$this->for_bairro = $for_bairro;
			$this->for_logradouro = $for_logradouro;
			$this->for_endereco = $for_endereco;
			$this->for_numero = $for_numero;
			$this->for_complemento = $for_complemento;
			$this->for_cnpj = $for_cnpj;
		} 

		public function get_for_id(){
			return $this->for_id;
		}

		public function set_for_id($for_id){
			$this->for_id = $for_id;
		}
	
		public function get_for_nome(){
			return $this->for_nome;
		}

		public function set_for_nome($for_nome){
			$this->for_nome = $for_nome;
		}
		
		public function get_for_cidade(){
			return $this->for_cidade;
		}

		public function set_for_cidade($for_cidade){
			$this->for_cidade = $for_cidade;
		}

		public function get_for_bairro(){
			return $this->for_bairro;
		}

		public function set_for_bairro($for_bairro){
			$this->for_bairro = $for_bairro;
		}

		public function get_for_logradouro(){
			return $this->for_logradouro;
		}

		public function set_for_logradouro($for_logradouro){
			$this->for_logradouro = $for_logradouro;
		}

		public function get_for_endereco(){
			return $this->for_endereco;
		}

		public function set_for_endereco($for_endereco){
			$this->for_endereco = $for_endereco;
		}

		public function get_for_numero(){
			return $this->for_numero;
		}

		public function set_for_numero($for_numero){
			$this->for_numero = $for_numero;
		}

		public function get_for_complemento(){
			return $this->for_complemento;
		}

		public function set_for_complemento($for_complemento){
			$this->for_complemento = $for_complemento;
		}

		public function get_for_cnpj(){
			return $this->for_cnpj;
		}

		public function set_for_cnpj($for_cnpj){
			$this->for_cnpj = $for_cnpj;
		}

	}
	

?>