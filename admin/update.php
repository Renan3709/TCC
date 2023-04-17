<!doctype html>
<html lang="pt">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cadastro de Inscri&ccedil;&atilde;o</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--link href="../css/style.css" rel="stylesheet" type="text/css"-->
<script type='text/javascript' src='../scripts/cep.js'></script>
<script type='text/javascript' src='../scripts/script.js'></script>
</head>
<?php
include('../functions/conexao.php');
include('session.php');
	
if(is_numeric($_REQUEST['id']) ==true){
	$sql = 'SELECT * FROM CANDIDATO C, PAIS P, RESPACAD A, RESPFIN F, ENDERECO E, TURMA T 
	WHERE C.NINSC = '.$_REQUEST['id'].' 
	AND C.NINSC = P.CANDIDATO_NINSC 
	AND C.NINSC = A.CANDIDATO_NINSC 
	AND C.NINSC = F.CANDIDATO_NINSC 
	AND C.NINSC = E.CANDIDATO_NINSC 
	AND C.NINSC = T.CANDIDATO_NINSC 
	GROUP BY C.NINSC;';
	
	$conn = conectar();		
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc(); 
			$id =  $_REQUEST['id'];  					
		}
		else 
			echo '<script type="text/javascript"> alert("Nenhum resultado encontrado..."); location.href="menu.php";</script>';
		desc();
}
else
	echo '<script type="text/javascript"> alert("Nenhum resultado encontrado..."); location.href="menu.php";</script>';


if (isset($_POST['updateCandidato'])){
	$matricula = $_POST['matricula'];
	if($matricula==0)
		$matricula = '';
	else
		$matricula = $_POST['matricula'];
	
$ano = $_POST['ano'];
$gEnsino = ucwords($_POST['esc']);
$turno = $_POST['turno'];
$exAluno = $_POST['exAluno'];
$nome = $_POST['nome'];
$dtNasc = $_POST['dtNasc'];
$escAtual = $_POST['escAtual'];


//Endereço
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$nCasa = $_POST['nCasa'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$comp = $_POST['comp'];
$atendEsp = $_POST['chkesp'];
$atendEspQual = $_POST['atenEspc'];
$reside = $_POST['optradio'];
$outros = $_POST['outros'];
$parentesco = $_POST['parentesco'];

//Dados dos Pais
//Dados do Pai
$pDtNasc = $_POST['pDtNasc'];
$pNat = $_POST['pNat'];
$pUF = $_POST['pUF'];

//Dados da Mãe
$mDtNasc = $_POST['mDtNasc'];
$mNat = $_POST['mNat'];
$mUF = $_POST['mUF'];

//Dados do Resposável Academico
$acaNome = $_POST['acaNome'];
$acaDtNasc = $_POST['acaDtNasc'];
$acaNat = $_POST['acaNat'];
$acaUf = $_POST['acaUF'];
$acaTel = $_POST['acaTel'];
$acaEmail = $_POST['acaEmail'];

//Dados do Resposável Financeiro

$FinNome = $_POST['finNome'];
$bolsa = $_POST['bolsa'];
$dc = $_POST['desconto'];
$FinNasc = $_POST['finDtNasc'];
$FinNat = $_POST['finNat'];
$FinUF = $_POST['finUF'];
$FinTel = $_POST['finTel'];
$FinEmail = $_POST['finEmail'];
$FinCPF = $_POST['finCPF'];
$FinRG = $_POST['finRG'];


$con = conectar();
$sql = 'UPDATE CANDIDATO C, ENDERECO E, PAIS P, RESPACAD A, RESPFIN F, TURMA T SET 

C.NOME = (?), 
C.MATRICULA = (?),
C.ESCATUAL = (?),
C.DTNASC = (?),
C.DC = (?),
C.AESPECIAIS = (?),
C.SOCIAL = (?),


E.RUA = (?), 
E.BAIRRO = (?), 
E.CEP = (?), 
E.CIDADE = (?),
E.COMP = (?), 
E.ESTADO = (?), 
E.NUM = (?), 
E.RESIDE = (?), 
E.RESIDENOME = (?), 
E.RESIDEPARENTE = (?), 

P.MDTNASC = (?), 
P.MNAT = (?), 
P.MUF = (?), 
P.PDTNASC = (?), 
P.PNAT = (?), 
P.PUF = (?), 

A.ADTNASC = (?),
A.ANAT = (?),
A.AEMAIL = (?),
A.ANOME = (?),
A.ATEL = (?),
A.AUF = (?),

F.CPF = (?),
F.FDTNASC = (?),
F.FEMAIL = (?),
F.FNAT = (?),
F.FNOME = (?),
F.FRG = (?),
F.FTEL = (?),
F.FUF = (?),

T.ANO = (?),
T.ESCOLARIDADE = (?),
T.TURNO = (?)


WHERE C.NINSC = '.$id.' 
AND E.CANDIDATO_NINSC = C.NINSC
AND P.CANDIDATO_NINSC = C.NINSC
AND A.CANDIDATO_NINSC = C.NINSC
AND F.CANDIDATO_NINSC = C.NINSC
AND T.CANDIDATO_NINSC = C.NINSC';

$stmt = $con->prepare($sql);
$ok   = $stmt->bind_param("sisssssssisssssssssssssssssisisssssissss", $nome, $matricula, $escAtual, $dtNasc, $dc ,$atendEspQual, $bolsa, $rua, $bairro, $cep, $cidade, $comp, $estado, $nCasa, $reside, $outros, $parentesco, $mDtNasc, $mNat, $mUF, $pDtNasc, $pNat,$pUF,$acaDtNasc, $acaNat, $acaEmail, $acaNome, $acaTel, $acaUf,$FinCPF, $FinNasc, $FinEmail, $FinNat, $FinNome, $FinRG, $FinTel, $FinUF,$ano, $gEnsino, $turno);
		if ($ok && $stmt->execute()){
			echo '<script type="text/javascript"> alert("Candidato alterado com sucesso!"); location.href="menu.php";</script>';
		}
    	else
        	echo '<script type="text/javascript"> alert("Erro ao inserir dados do candidato.'.$con->error.'");</script>';
		}		
?>
<body style="background-color:#014492; color:#FFFFFF">
<div class="container">
<form action="<?php $PHP_SELF ?>" method="POST" name="insc" role="form">
  
  <!-- TOPO COM AS TURMAS-->
  
  <div class="page-header" >
    <div class="row">

      <div class="col-sm-2">
        <div class="form-group">
          <label for="esc">Escolaridade:</label>
          <select name="esc" onchange="loadTurno(this.value)" size="1" class="form-control">
            <option value="<?php echo $row['ESCOLARIDADE'];?>" selected> <?php echo $row['ESCOLARIDADE'];?> </option>
            <option value="fundamental">Fundamental</option>
            <option value="medio">M&eacute;dio</option>
          </select>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="turno">Turno:</label>
          <select name="turno" size="1" class="form-control" onchange="loadAno(esc.value,turno.value)" >
          	<option value="<?php echo $row['TURNO'] ?>" selected><?php echo $row['TURNO'] ?></option>
          </select>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="ano">Ano:</label>
          <select name="ano" size="1" class="form-control" onChange="$('#candidato').show(500)">
          	<option value="<?php echo $row['ANO'] ?>" selected><?php echo $row['ANO'] ?></option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <!-- DADOS DO CANDIDATO-->
  <div id="candidato">
    <div class="page-header" > 
      <!-- PRIMEIRA LINHA (NOME/DTNASC)-->
      <div class="row">
        <h3>Dados do Candidato</h3>
        <div class="col-sm-5">
          <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" class="form-control" placeholder="Insira o nome completo do Candidato" name="nome" required maxlength="254" value="<?php echo $row['NOME'] ?>">
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label for="dtNasc">Data de Nascimento:</label>
            <input type="date" class="form-control" placeholder="" name="dtNasc" required max="<?php echo (date("Y")-6);?>-01-01" value="<?php echo $row['DTNASC'] ?>">
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="dtNasc">Nome da Escola Atual:</label>
            <input type="text" class="form-control" placeholder="Ex: La Salle Abel" name="escAtual" maxlength="150" value="<?php echo $row['ESCATUAL'] ?>">
          </div>
        </div>
      </div>
      <!-- SEGUNDA LINHA(ENDEREÇO)-->
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label for="nome">Cep:</label>
            <input type="text" placeholder="Ex: 24230150" name="cep" id="cep" class="form-control" required maxlength="8" value="<?php echo $row['CEP'] ?>">
            <img src="http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_350.gif" width="15px" alt="" id="load" hidden> 
            </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label for="nome">Rua:</label>
            <input type="text" placeholder="Ex: Av. Roberto Silveira" name="rua" id="rua" class="form-control" required maxlength="254" value="<?php echo $row['RUA'] ?>">
          </div>
        </div>
        <div class="col-sm-1">
          <div class="form-group">
            <label for="nome">N&uacute;mero:</label>
            <input type="number" placeholder="29" name="nCasa" id="numero" class="form-control" required maxlength="5" value="<?php echo $row['NUM'] ?>">
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label for="nome">Complemento:</label>
            <input type="text" placeholder="Ex: Apto 301" name="comp" id="comp" class="form-control" maxlength="29" value="<?php echo $row['COMP'] ?>">
          </div>
        </div>
      </div>
      <!-- TERCEIRA LINHA(FIM ENDEREÇO)-->
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label for="nome">Bairro:</label>
            <input type="text" placeholder="Ex: Icaraí" name="bairro" id="bairro" class="form-control" required maxlength="100" value="<?php echo $row['BAIRRO'] ?>">
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label for="nome">Cidade:</label>
            <input type="text" placeholder="Ex: Niterói" name="cidade" id="cidade" class="form-control" required maxlength="100" value="<?php echo $row['CIDADE'] ?>">
          </div>
        </div>
        <div class="col-sm-1">
          <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" placeholder="Ex: RJ" name="estado" id="estado" class="form-control" required maxlength="2" value="<?php echo $row['ESTADO'] ?>">
          </div>
        </div>
      </div>
      <!-- QUARTA LINHA (ATEND.ESP E ETC)-->
      <div class="row">
        <div class="col-sm-2">
          <label class="checkbox-inline">
            <input type="checkbox" value="SIM" onChange="$('#mat').show(500)" name="exAluno" <?php if(strlen($row['MATRICULA'])>0){ echo 'checked';} ?>>
            O candidato &eacute; Ex-Aluno?</label>
          <div id="mat" class="form-group">
            <label for="nome">Matricula:</label>
            <input type="number" placeholder="Ex: 26008888" name="matricula" class="form-control" maxlength="11" value="<?php echo $row['MATRICULA'] ?>">
          </div>
        </div>
        <div class="col-sm-3">
          <label class="checkbox-inline">
            <input type="checkbox" value="SIM" onChange="$('#aEsp').show(500)" name="chkesp" <?php if(strlen($row['AESPECIAIS'])>0){ echo 'checked';} ?>>
            Necessita de atendimentos especiais?</label>
          <div id="aEsp" class="form-group">
            <label for="nome">Quais?</label>
            <input type="text" placeholder="Descreva-os aqui." name="atenEspc" class="form-control" maxlength="150" value="<?php echo $row['AESPECIAIS'] ?>">
          </div>
        </div>
        <div class="col-sm-4">
          <label for="nome">O candidato reside com:</label> <br>
<label class="radio-inline">
  <input type="radio" name="optradio" value="Pai e Mãe" onClick="$('#quem').hide(500);$('#pais').show(500)" required 
  <?php 
  if(strcmp($row['RESIDE'], 'Pai e Mãe')==0){ 
  	echo 'checked';
	} ?>
    >
            Pai e m&atilde;e</label>
          <label class="radio-inline">
            <input name="optradio" type="radio" onClick="$('#quem').hide(500);$('#pais').show(500)" value="Pai"
            <?php 
  if(strcmp($row['RESIDE'], 'Pai')==0){ 
  	echo 'checked';
	} ?>
            >
            Pai</label>
          <label class="radio-inline">
            <input type="radio" name="optradio" value="Mãe" onClick="$('#quem').hide(500);$('#pais').show(500)"
            <?php 
  if(strcmp($row['RESIDE'], 'Mãe')==0){ 
  	echo 'checked';
	} ?>
            >
            M&atilde;e</label>
          <label class="radio-inline">
            <input type="radio" name="optradio" value="Outros" onClick="$('#quem').show(500);$('#pais').show(500)" 
            <?php 
  if(strcmp($row['RESIDE'], 'Outros')==0){ 
  	echo 'checked';
	} ?>
            >
            Outros</label>
            <div id="quem" class="form-group" 
<?php 
  if(strcmp($row['RESIDE'], 'Outros')!=0){ 
  	echo 'style="display:none"';
	} ?>
>
            <label for="nome">Quem s&atilde;o?</label>
            <input type="text" placeholder="Descreva-os aqui." name="outros" class="form-control" maxlength="254" value="<?php echo $row['RESIDENOME'] ?>">
            <label for="nome">Parentesco:</label>
            <input type="text" placeholder="Tio, Avô, Amigo" name="parentesco" class="form-control" maxlength="254" value="<?php echo $row['RESIDEPARENTE'] ?>">
          </div>
        </div>
      </div>
      <!-- QUARTA LINHA (DADOS DOS PAIS)-->      
    </div>
  </div>
  <div id="pais">
   <div class="page-header" >
  <h3>Dados dos Pais</h3>
  <h4>Pai</h4>
  <div class="row">
  <div class="col-sm-2">  
  <label for="">Data de Nascimento:</label>
  <input type="date" class="form-control" name="pDtNasc" id="pDtNasc" max="<?php echo (date("Y")-14)?>-01-01" value="<?php echo $row['PDTNASC'] ?>">
  </div>
  <div class="col-sm-2">  
  <label for="">Naturalidade:</label>
  <input type="text" class="form-control" maxlength="40" onChange="$('#resp').show(500);" name="pNat" id="pNat" maxlength="25" placeholder="Ex: Niterói" value="<?php echo $row['PNAT'] ?>">
  </div>
  <div class="col-sm-1">  
  <label for="">UF:</label>
  <input type="text" class="form-control" maxlength="2" onChange="$('#resp').show(500);" name="pUF" id="pUF" maxlength="2" placeholder="RJ" value="<?php echo $row['PUF'] ?>">
  </div>  
  <div class="col-sm-2">  
  	<input type="button" name="paifin" id="paifin" value="Resp. Financeiro"  class="btn-sm btn-default">
	<input type="button" name="paiaca" id="paiaca" value="Resp. Acad&ecirc;mico"  class="btn-sm btn-default">
  </div>  
  </div>
  <br>
  <h4>M&atilde;e</h4>
  <div class="row">
  <div class="col-sm-2">  
  <label for="">Data de Nascimento:</label>
  <input type="date" class="form-control" name="mDtNasc" id="mDtNasc" max="<?php echo (date("Y")-13)?>-01-01" value="<?php echo $row['MDTNASC'] ?>">
  </div>
  <div class="col-sm-2">  
  <label for="">Naturalidade:</label>
  <input type="text" class="form-control" name="mNat" maxlength="40" onChange="$('#resp').show(500);" id="mNat" maxlength="25" placeholder="Ex: Niterói" value="<?php echo $row['MNAT'] ?>">
  </div>
  <div class="col-sm-1">  
  <label for="">UF:</label>
  <input type="text" class="form-control" maxlength="2" name="mUF" onChange="$('#resp').show(500);" id="mUF" maxlength="2" placeholder="RJ" value="<?php echo $row['MUF'] ?>">
  </div> 
  <div class="col-sm-2">    	
  	<input type="button" name="maefin" id="maefin" value="Resp. Financeiro"  class="btn-sm btn-default">
	<input type="button" name="maeaca" id="maeaca" value="Resp. Acad&ecirc;mico" class="btn-sm btn-default">
  </div> 
  </div>
  
  </div>
  </div>
  
  <div id="resp">
  <div class="page-header">
  <h3>Dados dos respons&aacute;veis</h3> <br>
  <h4>Respos&aacute;vel Acad&ecirc;mico</h4>
  <div class="row">
  <div class="col-sm-4">
  <label for="">Nome:</label>
  <input type="text" class="form-control" required name="acaNome" maxlength="254" placeholder="Nome completo do Resp. Acadêmico" value="<?php echo $row['ANOME'] ?>">
  </div>
  <div class="col-sm-2">
  <label for="">Data de Nascimento:</label>
  <input type="date" class="form-control" required name="acaDtNasc" id="acaDtNasc" max="<?php echo (date("Y")-13)?>-01-01" value="<?php echo $row['ADTNASC']?>">
  </div>
  <div class="col-sm-2">
  <label for="">Naturalidade:</label>
  <input type="text" class="form-control" name="acaNat" id="acaNat" maxlength="25" placeholder="Ex: Niterói" value="<?php echo $row['ANAT'] ?>">
  </div>
  <div class="col-sm-1">
  <label for="">UF:</label>
  <input type="text" class="form-control" required maxlength="2" name="acaUF" id="acaUF" placeholder="Rj" value="<?php echo $row['AUF'] ?>">
  </div>  
  </div>
  <div class="row">
  <div class="col-sm-2">
  <label for="">Telefone:</label>
  <input type="number" class="form-control" required name="acaTel" maxlength="11" placeholder="2121959800" value="<?php echo $row['ATEL'] ?>">
  </div>
  <div class="col-sm-4">
  <label for="">E-mail:</label>
  <input type="email" class="form-control" required name="acaEmail" maxlength="254" placeholder="Ex: seuemail@seuemail.com" value="<?php echo $row['AEMAIL'] ?>">
  </div>
  </div>
  <br>
    <h4>Respos&aacute;vel Financeiro</h4>
  <div class="row">
  <div class="col-sm-4">
  <label for="">Nome:</label>
  <input type="text" class="form-control" required name="finNome" maxlength="254" placeholder="Nome completo do Resp. Financeiro" value="<?php echo $row['FNOME'] ?>">
  </div>
  <div class="col-sm-2">
  <label for="">Data de Nascimento:</label>
  <input type="date" class="form-control" required name="finDtNasc" id="finDtNasc" max="<?php echo (date("Y")-13)?>-01-01" value="<?php echo $row['FDTNASC']?>" >
  </div>
  <div class="col-sm-2">
  <label for="">Naturalidade:</label>
  <input type="text" class="form-control" name="finNat" id="finNat" maxlength="25" placeholder="Ex: Niterói" value="<?php echo $row['FNAT'] ?>">
  </div>
  <div class="col-sm-1">
  <label for="">UF:</label>
  <input type="text" class="form-control" required maxlength="2" name="finUF" id="finUF" placeholder="Rj" value="<?php echo $row['FUF'] ?>">
  </div>  
  </div>
  <div class="row">
  <div class="col-sm-2">
  <label for="">Telefone:</label>
  <input type="number" class="form-control" required placeholder="2121959800" name="finTel" maxlength="11" value="<?php echo $row['FTEL'] ?>">
  </div>
  <div class="col-sm-4">
  <label for="">E-mail:</label>
  <input type="email" class="form-control" required name="finEmail" maxlength="254" placeholder="seuemail@seuemail.com" value="<?php echo $row['FEMAIL'] ?>">
  </div>
  </div>
  <div class="row">
    <div class="col-sm-2">
  <label for="">CPF:</label>
  <input type="number" class="form-control" required onBlur="validaCPF()" name="finCPF" id="cpf" maxlength="11" placeholder="12345678901" value="<?php echo $row['CPF'] ?>">
  </div>
  <div class="col-sm-2">
  <label for="">RG:</label>
  <input type="text" class="form-control" required name="finRG" id="rg" maxlength="9" placeholder="123456789" value="<?php echo $row['FRG'] ?>">
  </div>
  <div class="col-sm-2">
  <label for=""> <br>
  <input name="bolsa" type="checkbox" class="radio-inline" value="SIM" <?php if(strcmp($row['SOCIAL'],'SIM')==0){ echo 'checked';} ?>> Bolsa Social</label> <br>
  <label for="">
  <input type="checkbox" class="radio-inline" name="desconto" value="SIM" <?php if(strcmp($row['DC'],'SIM')==0){ echo 'checked';} ?>> Descontos comerciais</label>
  </div>
  </div>
  
  
  </div>
  </div>
  <input type="submit" value="Gravar Dados" name="updateCandidato" class="btn-lg btn-default">  
  <div class="modal fade" id="mymodal" role="dialog">
  </div>
</form>
<br><br>
</div>
</body>
</html>
