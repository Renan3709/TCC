<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>.::Administração Central::.</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>
<?php
include('../functions/conexao.php');
$con = conectar();
if(isset($_POST['Entrar'])){
	$usuario = mysqli_real_escape_string($con,$_POST['usuario']);
	$senha = mysqli_real_escape_string($con,md5($_POST['senha']));	
	$sql = "SELECT * FROM USUARIO WHERE USUARIO='$usuario' AND SENHA = '$senha' ";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
    	$row = $result->fetch_assoc();
		session_start();
		$_SESSION['usuario'] = $row["USUARIO"];
		$_SESSION['id'] = $row["ID"];
		echo '<script>alert("Bem vindo '. $row["USUARIO"].'."); location.href="menu.php";</script>';  
		  
	} else {
		echo '<div class="alert alert-danger" align="center">
  			<strong>ERRO!</strong> Usuário ou senha inválidos.
		</div>';
    	//echo "<script>alert('Usuário ou senha inválido, tente novamente.')<//script>";
	}	
	
	
	/*$sel_user = "SELECT * FROM USUARIO WHERE USUARIO='$usuario' AND SENHA = '$senha' ";
	echo $sel_user;
	$run_user = mysqli_query($con, $sel_user);
	$check_user = mysqli_num_rows($run_user);
	if($check_user>0){
		echo "<script>alert('AEEEE!')</script>";
	}
	else {
		echo "<script>alert('Email ou password incorreto, tente novamente')</script>";
	}*/
desc();
}
?>
<!--
<form action="" method="post">
<div class="container" align="center" style="margin-top:200px;">
<table class="table-responsive">
<tr>
	<th>Usuário: </th>
    <th><input type="text" class="form-control" required name="usuario" id="usuario" maxlength="150"> </th>
</tr>
<tr>
	<th>Senha:</th>
    <th><input type="password" class="form-control" required name="senha" id="senha"> </th>
</tr>
<tr>
<th></th>
<th><input type="submit" class="btn-default" value="Entrar" name="Entrar"></th>
</tr>
</table>
</form>
</div>
-->
<div class="container droppedHover" style="margin-top: 15%">
    <form class="form-signin" role="form" action="<?php $PHP_SELF ?>" method="post">
         <h2 class="form-signin-heading" contenteditable="false">Por favor, forneça:</h2>
        <input type="text" class="form-control" placeholder="Nome de Usuário" required="" autofocus contenteditable="false" name="usuario" id="usuario">
        <input type="password" class="form-control" placeholder="Senha" required="" contenteditable="false" required name="senha" id="senha">        
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar" name="Entrar">Login</button>
    </form>    
</div>

</body>
</html>