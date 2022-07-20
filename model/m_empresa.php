<?php

	class m_empresa{

		private $emp_id;
		private $emp_nome;
		private $emp_cnpj;
		private $emp_senha;

		function __construct($emp_id, $emp_nome, $emp_cnpj, $emp_senha){
			$this->emp_id = $emp_id;
			$this->emp_nome = $emp_nome;
			$this->emp_cnpj = $emp_cnpj;
			$this->emp_senha = $emp_senha;
		}

		public function get_emp_id(){
			return $this->emp_id;
		}

		public function set_emp_id($emp_id){
			$this->emp_id = $emp_id;
		}

		public function get_emp_nome(){
			return $this->emp_nome;
		}

		public function set_emp_nome($emp_nome){
			$this->emp_nome = $emp_nome;
		}
	
		public function get_emp_cnpj(){
			return $this->emp_cnpj;
		}

		public function set_emp_cnpj($emp_cnpj){
			$this->emp_cnpj = $emp_cnpj;
		}

		public function get_emp_senha(){
			return $this->emp_senha;
		}

		public function set_emp_senha($emp_senha){
			$this->emp_senha = $emp_senha;
		}
	}
	

?>