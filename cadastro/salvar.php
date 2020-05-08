<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL);

$nome      = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$email     = $_POST["email"];
$sexo      = $_POST["sexo"]; 

mysql_connect("mysql10.000webhost.com", "a7394432_ponto", "webmaster2008");
mysql_select_db("a7394432_ponto");

mysql_query("INSERT INTO tabela ( id_tabela , nome , sobrenome , email , sexo ) 
			VALUES ( NULL , '$nome', '$sobrenome', '$email', '$sexo')");
mysql_close();
echo "Salvo com sucesso<br />";
?>
<a href="index.html">Voltar</a>