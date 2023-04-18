<?php
function conectar(){
    $strcon = mysqli_connect("@us-cdbr-east-06.cleardb.net", "b294236a090aa0", "0e1bc49b","heroku_addc7054e957021");
	mysqli_set_charset($strcon,"utf8");
    if (!$strcon)
        die ('<script type="text/javascript"> alert("Erro de conexão com o banco de dados.");</script>');
	
    return $strcon;
}
function desc(){
    $strcon = mysqli_connect("@us-cdbr-east-06.cleardb.net", "b294236a090aa0", "0e1bc49b","heroku_addc7054e957021");
    mysqli_close($strcon);
   // echo 'desconectado!';
}