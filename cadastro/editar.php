<?php
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
$re    = mysql_query("select count(*) as total from usuarios where id_usuario = $id");	
$total = mysql_result($re, 0, "total");

if($total == 1) {
	$re    = mysql_query("select * from usuarios, estados where estados.id_estado = usuarios.fk_estado and usuarios.id_usuario = $id");
	$dados = mysql_fetch_array($re);		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cadastro</title>
<style>
<!--
.textBox { border:1px solid gray; width:200px;} 
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="salvar_edicao.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
  <table width="400" border="0" align="center">
    <tr>
      <td width="145">Nome</td>
      <td width="245"><input name="nome" type="text" id="nome" maxlength="45" class="textBox" value="<?php echo $dados["nome"]; ?>" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="email" type="text" id="email" maxlength="64" class="textBox" value="<?php echo $dados["email"]; ?>" /></td>
    </tr>
    <tr>
      <td>Data Nascimento</td>
      <td>
		<?php			
			$arr = explode("-", $dados["data_nascimento"]);
			
			echo Seleciona_Item($arr[2], monta_select("dia", 1, 31));	
			echo Seleciona_Item($arr[1], monta_select("mes", 1, 12));	
			echo Seleciona_Item($arr[0], monta_select("ano", 1940, 1988));	
		?>	
	</td>
    </tr>
    <tr>
      <td>Sexo</td>
      <td><input name="sexo" type="radio" value="M" <?php echo $dados["sexo"] == "M" ? "checked=\"checked\"" : ""; ?> /><label>Masculino</label> 
      <input name="sexo" type="radio" value="F" <?php echo $dados["sexo"] == "F" ? "checked=\"checked\"" : ""; ?> /> <label>Feminino</label></td>
    </tr>
    <tr>
      <td>Preferencias de Filmes </td>
      <td><select name="preferencias[]" class="textBox" multiple="multiple" id="preferencias">
<?php
$combo = "<option value=\"R\">Romance</option>
        <option value=\"S\">Suspense</option>
        <option value=\"P\">Policial</option>
        <option value=\"F\">Ficção</option>";
		
$arr = explode(",", $dados["preferencias"]);
for($i = 0; $i < count($arr); $i++) {
	$combo = preg_replace("#<option value=\"{$arr[$i]}\">#is", "<option value=\"{$arr[$i]}\" selected=\"selected\">", $combo);
}	
echo $combo;
?>        		

      </select>
      </td>
    </tr>
    <tr>
      <td>Salario</td>
      <td><input name="salario" type="text" id="salario" maxlength="5" class="textBox" /></td>
    </tr>
    <tr>
      <td>Endereco</td>
      <td><input name="endereco" type="text" id="endereco" maxlength="30" class="textBox" /></td>
    </tr>
    <tr>
      <td>Bairro</td>
      <td><input name="bairro" type="text" id="bairro" maxlength="20" class="textBox" /></td>
    </tr>
    <tr>
      <td>Cidade</td>
      <td><input name="cidade" type="text" id="cidade" maxlength="45" class="textBox" /></td>
    </tr>
    <tr>
      <td>Estado</td>
      <td><select name="estados" id="estados" class="textBox" >
	  	<option value="0">Selecione</option>
<?php
$re = mysql_query("select * from estados order by estado");
if(mysql_errno() != 0) {
	if(!isset($erros)) {
		echo "Erro o arquivo init.php foi auterado, nao existe $erros";
		exit;
	}
	echo $erros[mysql_errno()];
	exit;
}
while($l = mysql_fetch_array($re)) {
	$id     = $l["id_estado"];
	$estado = $l["estado"];
	$uf     = $l["uf"];			
	echo Seleciona_Item($dados["id_estado"], "<option value=\"$id\">$uf - $estado</option>");
	
}
@mysql_close();
		
?>
      </select>      </td>
    </tr>
    <tr>
      <td>Login</td>
      <td><input name="login" type="text" id="login" maxlength="40" class="textBox" /></td>
    </tr>
    <tr>
      <td>Senha</td>
      <td><input name="senha" type="password" id="senha" maxlength="10" class="textBox" /></td>
    </tr>
    <tr>
      <td> </td>
      <td><input type="submit" name="Submit" value="Salvar" style="cursor:pointer;" /></td>
    </tr>
  </table>
</form>
</body>
</html>