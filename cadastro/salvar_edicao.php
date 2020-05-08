<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
$id           = $_POST["id"];
$nome         = $_POST["nome"];
$email        = $_POST["email"];
$data         = "{$_POST["ano"]}-{$_POST["mes"]}-{$_POST["dia"]}";
$sexo         = $_POST["sexo"];
$preferencias = isset($_POST["preferencias"]) ? implode(",", $_POST["preferencias"]) : "";
$salario      = $_POST["salario"];
$endereco     = $_POST["endereco"];
$bairro       = $_POST["bairro"];
$cidade       = $_POST["cidade"];
$estados      = $_POST["estados"];
$login        = $_POST["login"];
$senha        = $_POST["senha"];

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

Abre_Conexao();
if(@mysql_query("UPDATE usuarios SET nome = '$nome',
	email = '$email',
	sexo = '$sexo',
	preferencias = '$preferencias',
	salario = '$salario',
	endereco = '$endereco',
	bairro = '$bairro',
	cidade = '$cidade',
	fk_estado = '$estados',
	login = '$login',
	senha = MD5( '$senha' ) WHERE id_usuario = $id")) {

	if(mysql_affected_rows() == 1){
		echo "Registro atualizado com sucesso";
	}	

} else {
	if(mysql_errno() == 1062) {
		echo $erros[mysql_errno()];
		exit;
	} else {	
		echo "Erro nao foi possivel efetuar a edição";
		exit;
	}	
	@mysql_close();
}

}
?>
<a href="listar.php">Voltar</a>
