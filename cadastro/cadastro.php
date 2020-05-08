<?php
//Verifico se o arquivo existe
if(file_exists("init.php")) {
	require "init.php";		
} else {
	echo "Arquivo init.php nao foi encontrado";
	exit;
}
//verifico se a função que eu criei existe, vai que alguem pegou meu script e apagou ela = )
if(!function_exists("Abre_Conexao")) {
	echo "Erro o arquivo init.php foi auterado, nao existe a função Abre_Conexao";
	exit;
}

Abre_Conexao();
$re = mysql_query("select * from estados order by estado");
//verifico se nao deu erro de mysql
if(mysql_errno() != 0) {
                //verifico se a $errros existe, mesma coisa vai que alguem meche no script e apagou ela
	if(!isset($erros)) {
		echo "Erro o arquivo init.php foi auterado, nao existe \$erros";
		exit;
	}
	echo $erros[mysql_errno()];
	exit;
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
<form id="form1" name="form1" method="post" action="salvar.php">
  <table width="400" border="0" align="center">
    <tr>
      <td width="145">Nome</td>
      <td width="245"><input name="nome" type="text" id="nome" maxlength="45" class="textBox" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="email" type="text" id="email" maxlength="64" class="textBox" /></td>
    </tr>
    <tr>
      <td>Data Nascimento</td>
      <td>
		<?php	
                                                /*aqui eu criei uma função para montar o combo para mim, na propria função a seguir eu explico como ela funciona*/		
			echo monta_select("dia", 1, 31);	
			echo monta_select("mes", 1, 12);	
			echo monta_select("ano", 1940, 1988);
		?>	
	</td>
    </tr>
    <tr>
      <td>Sexo</td>
      <td><input name="sexo" type="radio" value="M" checked="checked" /><label>Masculino</label> 
      <input name="sexo" type="radio" value="F" /> <label>Feminino</label></td>
    </tr>
    <tr>
      <td>Preferencias de Filmes </td>
      <td><select name="preferencias[]" class="textBox" multiple="multiple" id="preferencias">
        <option value="R">Romance</option>
        <option value="S">Suspense</option>
        <option value="P">Policial</option>
        <option value="F">Ficção</option>
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
<?php
//pego os dados do banco para montar o combo do estados
while($l = mysql_fetch_array($re)) {
	$id     = $l["id_estado"];
	$estado = $l["estado"];
	$uf     = $l["uf"];				
	echo "<option value=\"$id\">$uf - $estado</option>\n";
}
//fecho a conexao com o banco
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
</html></div>