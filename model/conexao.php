<?php
	class conexao{
		private $servidor = 'localhost';
		private $usuario = 'root';
		private $senha = '';
		private $banco = 'inventario';

		private $con;

		function __construct(){
			$this->conectar();	
		}

		function conectar(){
			$this->con = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
		}

		function desconectar(){
			mysqli_close($this->con);
		}

		function executar($query){
			$sql = mysqli_query($this->con, $query);
			return $sql;
		}
	}
?>