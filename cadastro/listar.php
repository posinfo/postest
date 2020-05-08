<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL);

mysql_connect("mysql10.000webhost.com", "a7394432_ponto", "webmaster2008");
mysql_select_db("a7394432_ponto");
$resultado = mysql_query("select * from tabela");
mysql_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista de Dados</title>
</head>

<body>
<?php
if(mysql_num_rows($resultado) < 1) {
	
	echo "nenhum valor no banco";
	exit;
	
}
?>
<table width="500" border="1" align="center">
  <tr>
    <th>ID</th>
    <th>NOME</th>
    <th>SOBRENOME</th>
    <th>EMAIL</th>
    <th>SEXO</th>
    <th>EDITAR/EXCLUIR</th>
  </tr>
<?php
while($l = mysql_fetch_array($resultado)) {
	$id        = $l["id_tabela"];
	$nome      = $l["nome"];
	$sobrenome = $l["sobrenome"];
	$email     = $l["email"];
	$sexo      = $l["sexo"] == "M" ? "Masculino" : "Feminino";
	
	echo"
  <tr>
    <td>$id</td>
    <td>$nome</td>
    <td>$sobrenome</td>
    <td>$email</td>
    <td>$sexo</td>
    <td><a href=\"editar.php?id=$id\">[Editar]</a> | <a href=\"excluir.php?id=$id\">[Excluir]</a></td>
  </tr>\n";
}  
?>  
</table>
</body>
</html>