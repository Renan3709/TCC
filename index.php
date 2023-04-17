<!doctype html>
<html lang="pt">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cadastro de Inscri&ccedil;&atilde;o</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type='text/javascript' src='scripts/cep.js'></script>
<script type='text/javascript' src='scripts/script.js'></script>
</head>
<?php
//require "session.php";
//require "functions/functions.php";
?>
<body>
<div class="container">
  <form action="print.php" method="POST" name="insc" role="form">
    
    <!-- TOPO COM AS TURMAS-->
    
    <div class="page-header" >
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label for="esc">Escolaridade:</label>
            <select name="esc" onchange="loadTurno(this.value)" size="1" class="form-control">
              <option value="" selected></option>
              <option value="fundamental">Fundamental</option>
              <option value="medio">M&eacute;dio</option>
            </select>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label for="turno">Turno:</label>
            <select name="turno" size="1" class="form-control" onchange="loadAno(esc.value,turno.value)" >
            </select>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label for="ano">Ano:</label>
            <select name="ano" size="1" class="form-control" onChange="$('#candidato').show(500)">
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
              <input type="text" class="form-control" placeholder="Insira o nome completo do Candidato" name="nome" required maxlength="254">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="dtNasc">Data de Nascimento:</label>
              <input type="date" class="form-control" placeholder="" name="dtNasc" required max="<?php echo (date("Y")-6);?>-01-01">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="dtNasc">Nome da Escola Atual:</label>
              <input type="text" class="form-control" placeholder="Ex: La Salle Abel" name="escAtual" maxlength="150">
            </div>
          </div>
        </div>
        <!-- SEGUNDA LINHA(ENDEREÇO)-->
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label for="nome">Cep:</label>
              <input type="text" placeholder="Ex: 24230150" name="cep" id="cep" class="form-control" required maxlength="8">
              <img src="http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_350.gif" width="15px" alt="" id="load" hidden> </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="nome">Rua:</label>
              <input type="text" placeholder="Ex: Av. Roberto Silveira" name="rua" id="rua" class="form-control" required maxlength="254">
            </div>
          </div>
          <div class="col-sm-1">
            <div class="form-group">
              <label for="nome">N&uacute;mero:</label>
              <input type="number" placeholder="29" name="nCasa" id="numero" class="form-control" required maxlength="5">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="nome">Complemento:</label>
              <input type="text" placeholder="Ex: Apto 301" name="comp" id="comp" class="form-control" maxlength="29">
            </div>
          </div>
        </div>
        <!-- TERCEIRA LINHA(FIM ENDEREÇO)-->
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label for="nome">Bairro:</label>
              <input type="text" placeholder="Ex: Icaraí" name="bairro" id="bairro" class="form-control" required maxlength="100">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="nome">Cidade:</label>
              <input type="text" placeholder="Ex: Niterói" name="cidade" id="cidade" class="form-control" required maxlength="100">
            </div>
          </div>
          <div class="col-sm-1">
            <div class="form-group">
              <label for="estado">Estado:</label>
              <input type="text" placeholder="Ex: RJ" name="estado" id="estado" class="form-control" required maxlength="2">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="nome">Telefone:</label>
              <input type="text" placeholder="2121959800" name="candTel" id="candTel" class="form-control" maxlength="29">
            </div>
          </div>
        </div>
        <!-- QUARTA LINHA (ATEND.ESP E ETC)-->
        <div class="row">
          <div class="col-sm-2">
            <label class="checkbox-inline">
              <input type="checkbox" value="SIM" onChange="$('#mat').show(500)" name="exAluno" >
              O candidato &eacute; Ex-Aluno?</label>
            <div id="mat" class="form-group">
              <label for="nome">Matricula:</label>
              <input type="number" placeholder="Ex: 26008888" name="matricula" class="form-control" maxlength="11">
            </div>
          </div>
          <div class="col-sm-3">
            <label class="checkbox-inline">
              <input type="checkbox" value="SIM" onChange="$('#aEsp').show(500)" name="chkesp">
              Necessita de atendimentos especiais?</label>
            <div id="aEsp" class="form-group">
              <label for="nome">Quais?</label>
              <input type="text" placeholder="Descreva-os aqui." name="atenEspc" class="form-control" maxlength="150">
            </div>
          </div>
          <div class="col-sm-4">
            <label for="nome">O candidato reside com:</label>
            <br>
            <label class="radio-inline">
              <input type="radio" name="optradio" value="Pai e Mãe" onClick="$('#quem').hide(500);$('#pais').show(500)" required>
              Pai e m&atilde;e</label>
            <label class="radio-inline">
              <input type="radio" name="optradio" value="Pai" onClick="$('#quem').hide(500);$('#pais').show(500)">
              Pai</label>
            <label class="radio-inline">
              <input type="radio" name="optradio" value="Mãe" onClick="$('#quem').hide(500);$('#pais').show(500)">
              M&atilde;e</label>
            <label class="radio-inline">
              <input type="radio" name="optradio" value="Outros" onClick="$('#quem').show(500);$('#pais').show(500)" >
              Outros</label>
            <div id="quem" class="form-group">
              <label for="nome">Quem s&atilde;o?</label>
              <input type="text" placeholder="Descreva-os aqui." name="outros" class="form-control" maxlength="254">
              <label for="nome">Parentesco:</label>
              <input type="text" placeholder="Tio, Avô, Amigo" name="parentesco" class="form-control" maxlength="254">
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
            <input type="date" class="form-control" name="pDtNasc" id="pDtNasc" max="<?php echo (date("Y")-14)?>-01-01">
          </div>
          <div class="col-sm-2">
            <label for="">Naturalidade:</label>
            <input type="text" class="form-control" maxlength="40" onChange="$('#resp').show(500);" name="pNat" id="pNat" maxlength="25" placeholder="Ex: Niterói">
          </div>
          <div class="col-sm-1">
            <label for="">UF:</label>
            <input type="text" class="form-control" maxlength="2" onChange="$('#resp').show(500);" name="pUF" id="pUF" maxlength="2" placeholder="RJ">
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
            <input type="date" class="form-control" name="mDtNasc" id="mDtNasc" max="<?php echo (date("Y")-13)?>-01-01">
          </div>
          <div class="col-sm-2">
            <label for="">Naturalidade:</label>
            <input type="text" class="form-control" name="mNat" maxlength="40" onChange="$('#resp').show(500);" id="mNat" maxlength="25" placeholder="Ex: Niterói">
          </div>
          <div class="col-sm-1">
            <label for="">UF:</label>
            <input type="text" class="form-control" maxlength="2" name="mUF" onChange="$('#resp').show(500);" id="mUF" maxlength="2" placeholder="RJ">
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
        <h3>Dados dos respons&aacute;veis</h3>
        <br>
        <h4>Respos&aacute;vel Acad&ecirc;mico</h4>
        <div class="row">
          <div class="col-sm-4">
            <label for="">Nome:</label>
            <input type="text" class="form-control" required name="acaNome" maxlength="254" placeholder="Nome completo do Resp. Acadêmico">
          </div>
          <div class="col-sm-2">
            <label for="">Data de Nascimento:</label>
            <input type="date" class="form-control" required name="acaDtNasc" id="acaDtNasc" max="<?php echo (date("Y")-13)?>-01-01">
          </div>
          <div class="col-sm-2">
            <label for="">Naturalidade:</label>
            <input type="text" class="form-control" name="acaNat" id="acaNat" maxlength="25" placeholder="Ex: Niterói">
          </div>
          <div class="col-sm-1">
            <label for="">UF:</label>
            <input type="text" class="form-control" required maxlength="2" name="acaUF" id="acaUF" placeholder="Rj">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <label for="">Telefone:</label>
            <input type="number" class="form-control" required name="acaTel" maxlength="11" placeholder="2121959800">
          </div>
          <div class="col-sm-4">
            <label for="">E-mail:</label>
            <input type="email" class="form-control" required name="acaEmail" maxlength="254" placeholder="Ex: seuemail@seuemail.com">
          </div>
        </div>
        <br>
        <h4>Respos&aacute;vel Financeiro</h4>
        <div class="row">
          <div class="col-sm-4">
            <label for="">Nome:</label>
            <input type="text" class="form-control" required name="finNome" maxlength="254" placeholder="Nome completo do Resp. Financeiro">
          </div>
          <div class="col-sm-2">
            <label for="">Data de Nascimento:</label>
            <input type="date" class="form-control" required name="finDtNasc" id="finDtNasc" max="<?php echo (date("Y")-13)?>-01-01">
          </div>
          <div class="col-sm-2">
            <label for="">Naturalidade:</label>
            <input type="text" class="form-control" name="finNat" id="finNat" maxlength="25" placeholder="Ex: Niterói">
          </div>
          <div class="col-sm-1">
            <label for="">UF:</label>
            <input type="text" class="form-control" required maxlength="2" name="finUF" id="finUF" placeholder="Rj">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <label for="">Telefone:</label>
            <input type="number" class="form-control" required placeholder="2121959800" name="finTel" maxlength="11">
          </div>
          <div class="col-sm-4">
            <label for="">E-mail:</label>
            <input type="email" class="form-control" required name="finEmail" maxlength="254" placeholder="seuemail@seuemail.com">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <label for="">CPF:</label>
            <input type="number" class="form-control" required onBlur="validaCPF()" name="finCPF" id="cpf" maxlength="11" placeholder="12345678901">
          </div>
          <div class="col-sm-2">
            <label for="">RG:</label>
            <input type="text" class="form-control" required name="finRG" id="rg" maxlength="9" placeholder="123456789">
          </div>
          <div class="col-sm-3">
            <label for=""style="visibility:hidden"> <br>
              <input type="checkbox" class="radio-inline" name="bolsa" value="SIM" disabled style="visibility:hidden">
              Bolsa Social</label>
            <br>
            <label for=""style="visibility:hidden">
              <input type="checkbox" class="radio-inline" name="desconto" value="SIM" disabled style="visibility:hidden">
              Descontos comerciais</label>
          </div>
        </div>
      </div>
    </div>
    <input type="submit" value="Gravar Dados" name="saveCandidato" class="btn-lg btn-default">
    <div class="modal fade" id="mymodal" role="dialog"> </div>
  </form>
  <br>
  <br>
</div>
</body>
</html>
