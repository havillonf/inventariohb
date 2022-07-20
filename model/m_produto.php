<?php

	class m_produto{
		
		private $pro_id;
		private $pro_nome;
		private $pro_preco;
		private $pro_quantidade;
		private $ef_id;

		function __construct($pro_id, $pro_nome, $pro_preco, $pro_quantidade, $ef_id){
			$this->pro_id = $pro_id;
			$this->pro_nome = $pro_nome;
			$this->pro_quantidade = $pro_quantidade;
			$this->pro_preco = $pro_preco;
			$this->ef_id = $ef_id;
		} 

		public function get_pro_id(){
			return $this->pro_id;
		}

		public function set_pro_id($pro_id){
			$this->pro_id = $pro_id;
		}
	
		public function get_pro_nome(){
			return $this->pro_nome;
		}

		public function set_pro_nome($pro_nome){
			$this->pro_nome = $pro_nome;
		}
		
		public function get_pro_preco(){
			return $this->pro_preco;
		}

		public function set_pro_preco($pro_preco){
			$this->pro_preco = $pro_preco;
		}
		
		public function get_pro_quantidade(){
			return $this->pro_quantidade;
		}

		public function set_pro_quantidade($pro_quantidade){
			$this->pro_quantidade = $pro_quantidade;
		}

		public function get_ef_id(){
			return $this->ef_id;
		}

		public function set_ef_id($ef_id){
			$this->ef_id = $ef_id;
		}

	}

?>