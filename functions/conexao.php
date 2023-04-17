<?php
function conectar(){
    $strcon = mysqli_connect("localhost", "root", "", "central");
	mysqli_set_charset($strcon,"utf8");
    if (!$strcon)
        die ('<script type="text/javascript"> alert("Erro de conexão com o banco de dados.");</script>');
	
    return $strcon;
}
function desc(){
    $strcon = mysqli_connect("localhost", "root", "", "central");
    mysqli_close($strcon);
   // echo 'desconectado!';
}