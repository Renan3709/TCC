<?php 
session_start(); 
if((!isset ($_SESSION['usuario']) == true)){
	unset($_SESSION['usuario']);
	unset($_SESSION['id']);
	session_destroy();
	header("Location:index.php");
	} 
?>