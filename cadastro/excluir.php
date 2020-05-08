<?php
if($_SERVER["REQUEST_METHOD"] == "GET") {
if(file_exists("init.php")) {
	require "init.php";		
} else {
	echo "Arquivo init.php nao foi encontrado";
	exit;
}

if(!function_exists("Abre_Conexao")) {
	echo "Erro o arquivo init.php foi auterado, nao existe a função Abre_Conexao";
	exit;
}
$id = $_GET["id"];

Abre_Conexao();
if(mysql_query("delete from usuarios where id_usuario = $id")) {
	if(mysql_affected_rows() == 1){
		echo "Registro deletado com sucesso<br />";
	}	
}	
}

?>
<a href="listar.php">Voltar</a>