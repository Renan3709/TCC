<?php
	
	include('../functions/conexao.php');
	include('session.php');
	if((isset ($_SESSION['usuario']) == true)){
		if($_SESSION['id']!=$_REQUEST['id']){
			$id = $_REQUEST['id'];
			$sql = "DELETE FROM USUARIO WHERE id=".$id;
			$conn = conectar();
			if($conn->query($sql)==true)
				echo '<script>alert("Usuário apagado com sucesso!"); location.href="menu.php";</script>';
		}
		else
			echo '<script>alert("*********ERRO!*********\nVocê não pode se excluir!"); location.href="menu.php";</script>';
	}
	//$recordset = mysqli_query($query,$conn);
	//header("Location:usuario.php");
?>	